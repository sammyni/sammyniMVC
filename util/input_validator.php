<?php

function isValidUsername($user)
{
    return (preg_match("/^[0-9a-zA-Z]*$/",$user) && strlen($user) > 3) ? true : false;
}

function isValidEmail($email)
{
    return (filter_var($email,FILTER_VALIDATE_EMAIL)) ? true : false;
}

function isValidName($name)
{
    return (preg_match("/^([a-zA-Z'-.]{2,}\s?){2,3}$/",$name) && strpos($name," ")) ? true : false;
}

function cleanInput($input)
{
    $val = strip_tags($input);
    $val = trim($val);
    $val = stripslashes($val);
    $val = htmlspecialchars($val);
    return $val;
}

function array_sort_key($array, $on, $order=SORT_DESC)
{
    $new_array = [];
    $sortable_array = [];

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }
        switch ($order) {
            case SORT_ASC:
            asort($sortable_array);
            break;
            case SORT_DESC:
            arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
?>
