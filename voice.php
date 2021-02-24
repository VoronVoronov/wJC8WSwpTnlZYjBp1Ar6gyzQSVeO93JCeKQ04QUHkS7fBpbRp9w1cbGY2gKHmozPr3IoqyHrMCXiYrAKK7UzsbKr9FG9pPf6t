<?php
header('Access-Control-Allow-Origin: sdonate.ru');
//header('Access-Control-Allow-Headers: *');
//header('Access-Control-Allow-Methods: *');
//header('Access-Control-Request-Headers: *, x-requested-with ');
$text = $_GET['text'];
//$id = $_GET['widget_id'];
//$user = $_GET['user_name'];
$name = $_GET['name'];

if(isset($text) && isset($name)) {


$url = 'https://translate.google.com.vn/translate_tts?ie=UTF-8&client=tw-ob&q='.urlencode($text).'&tl=ru';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($curl);
curl_close($curl);


file_put_contents(__DIR__ . '/'.$name.'.mp3', $result);

}else{
echo 'Access Denied';
}