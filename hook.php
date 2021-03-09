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
            } /*elseif (!empty($user['user_twitch'])) {
                $url = 'https://api.twitch.tv/helix/streams?user_id=' . $user['user_twitch_id'];
                $headers = array('Authorization: Bearer ' . $user['user_twitch_app_token'],
                    'Client-Id: gyueptk1c7m8m7iaob1u3i6v06rfmj');
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
                $result = curl_exec($curl);
                curl_close($curl);
                $obj = json_decode($result, true);
                echo $result;
                if ($obj['data'][0]['type'] == 'live') {
                    $decode = json_decode($json,true);
                    $explode = explode('{width}',$obj['data'][0]['thumbnail_url']);
                    //echo $explode[0].'150x150.jpg';
                    $webhookurl = "https://discord.com/api/webhooks/818868955087241267/_CR0_ODkBgXcp95KRYgBwWbGKtg9NRCkI082bU9RPNY1ZgoEFfkozRYTCtjBDIb2cbB0";
                    $timestamp = date("c", strtotime("now"));
                    $json_data = json_encode([
                        "content" => '@everyone',
                        "tts" => false,
                        "embeds" => [
                            [
                                "type" => "rich",
                                "description" => $obj['data'][0]['title'],
                                "timestamp" => $timestamp,
                                "color" => hexdec( "3366ff" ),
                                "footer" => [
                                    "text" => "IPDonate",
                                ],
                                "image" => [
                                    "url" => $explode[0].'848x480.jpg'
                                ],
                                "author" => [
                                    "icon_url" => $user['user_avatar'],
                                    "name" => $obj['data'][0]['user_login'],
                                    "url" => "https://www.twitch.tv/".$obj['data'][0]['user_name']
                                ],
                                "fields" => [
                                    [
                                        "name" => "Зрителей",
                                        "value" => $obj['data'][0]['viewer_count'],
                                        "inline" => false
                                    ],
                                    [
                                        "name" => "Игра",
                                        "value" => $obj['data'][0]['game_name'],
                                        "inline" => true
                                    ]
                                ]
                            ]
                        ]

                    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


                    $ch = curl_init( $webhookurl );
                    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
                    curl_setopt( $ch, CURLOPT_POST, 1);
                    curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
                    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt( $ch, CURLOPT_HEADER, 0);
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

                    $response = curl_exec( $ch );
                    // If you need to debug, or find out why you can't send message uncomment line below, and execute script.
                    // echo $response;
                    curl_close( $ch );
                    echo 'ok twitch';
                } else {
                    echo 'no twitch';
                }
            }*/
        }
        break;

    case 'twitchfollows':
        $log_file = fopen($_SERVER['DOCUMENT_ROOT'] . '/twitchhook.txt', 'a+');
        fwrite($log_file, print_r(json_decode(file_get_contents('php://input')), true).PHP_EOL);
        fwrite($log_file, print_r(getallheaders(), true).PHP_EOL);
        fclose($log_file);
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, 1);
        if($data['subscription']['status'] == 'webhook_callback_verification_pending') {
            echo $data['challenge'];
        }elseif($data['subscription']['status'] == 'enabled'){
            $useridsql = $db->query('SELECT * FROM `users` WHERE `user_twitch_id` = '.$data['subscription']['condition']['broadcaster_user_id']);
            while ($user = mysqli_fetch_assoc($useridsql)) {
                $userid = $user['user_id'];
            }
            $followerid = $data['event']['user_id'];
            $followername = $data['event']['user_name'];
            file_get_contents('https://ipdonate.com/cron/followstwitch?params[user_id]='.$userid.'&params[followerid]='.$followerid.'&params[followername]='.$followername);
        }
        break;

    case 'twitchsubscribe':
        $log_file = fopen($_SERVER['DOCUMENT_ROOT'] . '/twitchhook.txt', 'a+');
        fwrite($log_file, print_r(json_decode(file_get_contents('php://input')), true).PHP_EOL);
        fwrite($log_file, print_r(getallheaders(), true).PHP_EOL);
        fclose($log_file);
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, 1);
        if($data['subscription']['status'] == 'webhook_callback_verification_pending') {
            echo $data['challenge'];
        }elseif($data['subscription']['status'] == 'enabled'){
            $useridsql = $db->query('SELECT * FROM `users` WHERE `user_twitch_id` = '.$data['subscription']['condition']['broadcaster_user_id']);
            while ($user = mysqli_fetch_assoc($useridsql)) {
                $userid = $user['user_id'];
            }
            $followerid = $data['event']['user_id'];
            $followername = $data['event']['user_name'];
            file_get_contents('https://ipdonate.com/cron/twitchsubscribe?params[user_id]='.$userid.'&params[followerid]='.$followerid.'&params[followername]='.$followername);
        }
        break;

    case 'streamonline':
        $log_file = fopen($_SERVER['DOCUMENT_ROOT'] . '/twitchhook.txt', 'a+');
        fwrite($log_file, print_r(json_decode(file_get_contents('php://input')), true).PHP_EOL);
        fwrite($log_file, print_r(getallheaders(), true).PHP_EOL);
        fclose($log_file);
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, 1);
        if($data['subscription']['status'] == 'webhook_callback_verification_pending') {
            echo $data['challenge'];
        }elseif($data['subscription']['status'] == 'enabled'){
            $useridsql = $db->query('SELECT * FROM `users` WHERE `user_twitch_id` = '.$data['subscription']['condition']['broadcaster_user_id']);
            while ($user = mysqli_fetch_assoc($useridsql)) {
                $userid = $user['user_id'];
                $url = 'https://api.twitch.tv/helix/streams?user_id=' . $user['user_twitch_id'];
                $headers = array('Authorization: Bearer ' . $user['user_twitch_app_token'],
                    'Client-Id: gyueptk1c7m8m7iaob1u3i6v06rfmj');
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
                $result = curl_exec($curl);
                curl_close($curl);
                $obj = json_decode($result, true);
                $decode = json_decode($json,true);
                $explode = explode('{width}',$obj['data'][0]['thumbnail_url']);
                //echo $explode[0].'150x150.jpg';
                $webhookurl = $user['user_discord_webhook'];
                $timestamp = date("c", strtotime("now"));
                $json_data = json_encode([
                    "content" => '@everyone Хей! '.$user['user_login_show'].' запустил вещание на канале https://www.twitch.tv/'.$data['event']['broadcaster_user_login'],
                    "tts" => false,
                    "embeds" => [
                        [
                            "type" => "rich",
                            "description" => $obj['data'][0]['title'],
                            "timestamp" => $timestamp,
                            "color" => hexdec( "3366ff" ),
                            "footer" => [
                                "text" => "IPDonate",
                            ],
                            "image" => [
                                "url" => $explode[0].'848x480.jpg'
                            ],
                            "author" => [
                                "icon_url" => $user['user_avatar'],
                                "name" => $obj['data'][0]['user_login'],
                                "url" => "https://www.twitch.tv/".$obj['data'][0]['user_name']
                            ],
                            "fields" => [
                                [
                                    "name" => "Зрителей",
                                    "value" => $obj['data'][0]['viewer_count'],
                                    "inline" => false
                                ],
                                [
                                    "name" => "Игра",
                                    "value" => $obj['data'][0]['game_name'],
                                    "inline" => true
                                ]
                            ]
                        ]
                    ]

                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


                $ch = curl_init( $webhookurl );
                curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
                curl_setopt( $ch, CURLOPT_POST, 1);
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
                curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt( $ch, CURLOPT_HEADER, 0);
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

                $response = curl_exec( $ch );
                // If you need to debug, or find out why you can't send message uncomment line below, and execute script.
                // echo $response;
                curl_close( $ch );
            }
            $db->query('INSERT INTO `streams` (`stream_start`, `stream_status`, `user_id`, `stream_platform`, `twitch_id`) VALUES (NOW(), 1, '.$userid.', 1, "'.$data['subscription']['id'].'")');
            $db->query('UPDATE `users` SET `user_stream_status` = 1 WHERE `user_id` = ' . $userid);
        }
        break;

    case 'streamonffline':
        $log_file = fopen($_SERVER['DOCUMENT_ROOT'] . '/twitchhook.txt', 'a+');
        fwrite($log_file, print_r(json_decode(file_get_contents('php://input')), true).PHP_EOL);
        fwrite($log_file, print_r(getallheaders(), true).PHP_EOL);
        fclose($log_file);
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, 1);
        if($data['subscription']['status'] == 'webhook_callback_verification_pending') {
            echo $data['challenge'];
        }elseif($data['subscription']['status'] == 'enabled'){
            $useridsql = $db->query('SELECT * FROM `users` WHERE `user_twitch_id` = '.$data['subscription']['condition']['broadcaster_user_id']);
            while ($user = mysqli_fetch_assoc($useridsql)) {
                $userid = $user['user_id'];
            }
            $db->query('UPDATE `streams` SET `stream_end` = NOW(), `stream_status` = 2 WHERE `stream_status` = 1 AND `twitch_id` = "'.$data['subscription']['id'].'"');
            $time_sql = $db->query('SELECT * FROM `streams` WHERE `user_id` = '.$userid);
            while ($time = mysqli_fetch_assoc($time_sql)) {
                $start = $time['stream_start'];
                $end = $time['stream_end'];
            }
            $time = strtotime($end) - strtotime($start);
            $time = $time / 60;
            $db->query('UPDATE `streams` SET `stream_time` = '.$time.' WHERE  `twitch_id` = "' . $data['subscription']['id'].'"');
            $db->query('UPDATE `users` SET `user_stream_status` = 0 WHERE `user_id` = ' . $userid);
        }
        break;

    default:
        header('Location: /');;
        break;
}
