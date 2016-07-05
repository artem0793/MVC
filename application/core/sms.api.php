<?php

define('API_SMS_STATUS_ADDED_TO_QUEUE', 0);

function api_sms_send_post_request($url, array $data = array()) {
    $curl = curl_init();

    if (!empty($data)) {
        $url .= '?' . http_build_query($data);
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    $output = curl_exec($curl);
    curl_close($curl);

    return $output;
}

function api_sms_send($from, $to, $text) {
    $result = api_sms_send_post_request('https://gate.smsclub.mobi/http/', array(
        'username' => variable_get('sms_username', ''),
        'password' => variable_get('sms_password', ''),
        'lifetime' => variable_get('sms_lifetime', 10),
        'from' => $from,
        'to' => $to,
        'text' => $text,
    ));

    return $result;
}
