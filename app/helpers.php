<?php

function vd($dd) {
    echo '<pre>';
    var_dump($dd);
    echo '</pre>';
    exit;
}

function camelCaseToUnderscoreCase($string) {
    return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
}

function addGetVariable(array $data) {

    $url = '?';
    foreach ($data as $key => $value) {
        if (isset($_GET[$key])) {
            unset($_GET[$key]);
        }

        $url .= $key  .'='. $value .'&';
    }

    $url = substr($url, 0, -1);

    if (!empty($_GET)) {

        foreach ($_GET as $key => $value) {
            $url .= '&'. $key .'='. $value;
        }
    }

    return $url;
}