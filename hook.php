<?php

$config = array(
    'db' => array(
        'host' => "localhost",
        'user' => 'ipdonate.com',
        'pass' => '4G1w2Z1c',
        'base' => 'ipdonate.com',
        'prefix' => 'gd_',
    ),
);

$db = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['base']);
$db->set_charset("utf8");

if ($db->connect_errno) {
    exit('<center>Идут технические работы.</center>');
}

$action = $_GET['action'];
switch ($action) {
    case 'streamStatus':
        $users = $db->query('SELECT * FROM `users`');
        while ($user = mysqli_fetch_assoc($users)) {
            if (!empty($user['user_youtube'])) {
                $url = 'https://www.googleapis.com/youtube/v3/liveBroadcasts?part=status&broadcastStatus=active';
                $headers = array('Authorization: Bearer ' . $user['user_youtube_token'],
                    'Accept: application/json');
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
                $result = curl_exec($curl);
                curl_close($curl);
                $obj = json_decode($result, true);
                if ($obj['items'][0]['status']['recordingStatus'] == "recording") {
                    $db->query('UPDATE `users` SET `user_stream_status` = 1 WHERE `user_id` = ' . $user['user_id']);
                    echo 'ok youtube';
                } else {
                    $db->query('UPDATE `users` SET `user_stream_status` = 0 WHERE `user_id` = ' . $user['user_id']);
                    echo 'no youtube';
                }
            } elseif (!empty($user['user_twitch'])) {
                $url = 'https://api.twitch.tv/helix/streams?user_id=' . $user['user_id'];
                $headers = array('Authorization: Bearer ' . $user['user_twitch_token'],
                    'Accept: application/json');
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
                $result = curl_exec($curl);
                curl_close($curl);
                $obj = json_decode($result, true);
                if ($info->data[0]->type == "live") {
                    $db->query('UPDATE `users` SET `user_stream_status` = 1 WHERE `user_id` = ' . $user['user_id']);
                    echo 'ok twitch';
                } else {
                    $db->query('UPDATE `users` SET `user_stream_status` = 0 WHERE `user_id` = ' . $user['user_id']);
                    echo 'no twitch';
                }
            }
        }
        break;

    case 'twitchfollows':
        $log_file = fopen($_SERVER['DOCUMENT_ROOT'] . '/twitchhook.txt', 'a+');
        fwrite($log_file, print_r(json_decode(file_get_contents('php://input')), true).PHP_EOL);
        fwrite($log_file, print_r(getallheaders(), true).PHP_EOL);
        fclose($log_file);
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, 1);
        $challenge = $data['challenge'];
        $type = $data['subscription']['type'];
        $userid = $data['subscription']['condition']['broadcaster_user_id'];
        $webhookid = $data['subscription']['f1c2a387-161a-49f9-a165-0f21d7a4e1c4'];
        $status = $data['subscription']['status'];
        switch ($status){
            case 'enabled':
                $followerid = $data['event']['user_id'];
                $followername = $data['event']['user_name'];
                file_get_contents('https://ipdonate.com/cron/followstwitch?params[user_id]='.$userid.'&params[followerid]='.$followerid.'&params[followername]='.$followername);
            case 'webhook_callback_verification_pending':
                echo $challenge;
        }

        break;
}
