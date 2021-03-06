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

    case 'twitchsubs':

        break;
}
