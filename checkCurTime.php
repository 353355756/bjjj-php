<?php
header('Content-Type: application/json');
/**
 * 查询addcartype，提供服务是否可用
 * 返回json数据
 */
require_once 'curl.php';
require_once 'config.php';
require_once 'curtime.php';

// 读取addcartype状态码信息
$path = 'result';
if (!is_dir($path)) {
    mkdir($path);
}
$path.= '/'.'curtime.json';

$json_status = array('status'=>0, 'timestamp'=>date("Y-m-d H:i:s"));
if (is_file($path)) {
    $json_status = loadConfig($path);
} else {
    saveConfig($path, $json_status);
    // 强制查询
    $json_status['timestamp'] = '';
}
$lastTime = $json_status['timestamp'];
// 每6分钟查询
if (strlen($lastTime) > 0 && strtotime($lastTime) > strtotime('-6 minutes')) {
    // 6分钟以内的查询，直接返回结果
    echo json_encode($json_status);
    return;
}

$result_array = curtime();
// 返回请求状态码
$json_status['status'] = $result_array[0];
$json_status['timestamp'] = date("Y-m-d H:i:s");
// 写文件
saveConfig($path, $json_status);
// 输出结果
echo json_encode($json_status);
?>