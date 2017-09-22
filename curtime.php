<?php
require_once 'curl.php';
require_once 'config.php';

function curtime() {
    global $host;
    global $headers;
    global $page_toVehicleType;
    global $page_curtime;

    // form提交
    $form = array();
    return curl_post($headers, http_build_query($form), $host.$page_curtime, $host.$page_toVehicleType);
}
?>