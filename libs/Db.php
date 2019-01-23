<?php
/**
 *
 */
namespace Lib;

use PDO;

class Db
{
    private $host;
    private $name;
    private $charset;
    private $user;
    private $pwd;

    protected $appRoute;

    protected $con;


    public function __construct($params = [], $use_router = true)
    {

        if($use_router){
            $this->appRoute = App::getRouter()->getRoute();
            $db_param_switch = strtoupper($this->appRoute);
            $db_user_param = 'DB_'.$db_param_switch.'_USER';
            $db_pwd_param = 'DB_'.$db_param_switch.'_PWD';
        }else {
            $db_user_param = 'DB_DEFAULT_USER';
            $db_pwd_param = 'DB_DEFAULT_PWD';
        }

        $this->host = array_key_exists('host', $params) ? $params['host'] : getenv('DB_HOST');
        $this->name = array_key_exists('name', $params) ? $params['name'] : getenv('DB_NAME');
        $this->charset = array_key_exists('charset', $params) ? $params['charset'] : getenv('DB_CHARSET');

        $this->user =  array_key_exists('user', $params) ? $params['user'] : (getenv($db_user_param) ? getenv($db_user_param) : getenv('DB_DEFAULT_USER'));
        $this->pwd =    array_key_exists('pwd', $params) ? $params['pwd'] : (getenv($db_pwd_param) ? getenv($db_pwd_param) : getenv('DB_DEFAULT_PWD'));

        try {
            $this->con = new PDO(
                "mysql:host={$this->host};dbname={$this->name};charset={$this->charset}",
                $this->user, $this->pwd,
                array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (\PDOException $e) {

            throw new \Exception("Database connection failed: ".$e->getMessage(), 500);
        }

    }

    public function table_exists($table, $env_token)
    {
        if ($this->con) {
            if(hash_equals(Config::get('user_agent_token'), $env_token)){
                $qry = $this->con->query("SHOW TABLES LIKE '$table'");
                return empty($qry) ? false : true;
            }else {
                throw new \Exception("Error Processing Request: Unauthorised Request");
            }
        }else {
            throw new \Exception("Database connection failed.");
        }
    }

    public function query($sql, $params = null, $env_token = null)
    {
        if(!$this->con){
            $result = false;
        }

        if (!$params) {
            if($env_token && hash_equals(Config::get('user_agent_token'), $env_token)){
                $result = $this->con->query($sql);
            }else {
                $result = false;
            }
        }else {
            if(!($result = $this->con->prepare($sql))){
                $result = false;
            }else {
                if(!($result->execute($params))){
                    $result = false;
                }
            }
        }
        if (is_bool($result)) {
            return $result;
        }else {
            $data = [];
            while ($a = $result->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $a;
            }
            return $data;
        }
    }

    public function insert($sql, $params)
    {
        if ($this->con) {
            if(!($stm = $this->con->prepare($sql))){
                return false;
            }else {
                if ($stm->execute($params)) {
                    return $this->con->lastInsertId();
                }else {
                    return false;
                }
            }
        }else {
            return false;
        }
    }

    public function selectOne($sql, $params = null, $env_token = null)
    {
        if(!$params){
            if($env_token && hash_equals(Config::get('user_agent_token'), $env_token)){
                $result = $this->con->query($sql);
                return $result->fetch(PDO::FETCH_ASSOC);
            }else {
                return false;
            }
        }else {
            $stm = $this->con->prepare($sql);
            $stm->execute($params);
            return $stm->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function select($sql, $params = null, $env_token = null)
    {
        if(!$params){
            if($env_token && hash_equals(Config::get('user_agent_token'), $env_token)){
                $result = $this->con->query($sql);
                return $result->fetchAll(PDO::FETCH_ASSOC);
            }else {
                return false;
            }
        }else {
            $stm = $this->con->prepare($sql);
            $stm->execute($params);
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function update($sql, $params = null, $env_token = null)
    {
        if(!$params){
            if($env_token && hash_equals(Config::get('user_agent_token'), $env_token)){
                $sql = $this->esc($sql);
                return $this->con->exec($sql);
            }else {
                return false;
            }
        }else {
            $stm = $this->con->prepare($sql);
            $stm->execute($params);
            return $stm->rowCount();
        }
    }

    public function esc($str)
    {
        return $this->con->quote($str);
    }

    public function __destruct()
    {
        if($this->con){
            $this->con = null;
        }
    }
}

?>
