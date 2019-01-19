<?php

$variant = $_REQUEST['variant'];
$typeGet = $_REQUEST['tpget'];
$curl = $_REQUEST['curl'];

switch ($variant)
{
    case 'gp':
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://clients6.google.com/rpc?key=AIzaSyCKSbrvQasunBoV16zDH9R33D88CeLr9gQ");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $curl . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        $curl_results = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($curl_results, true);
        echo (int)$json[0]['result']['metadata']['globalCounts']['count'];
        die;
}

?>

