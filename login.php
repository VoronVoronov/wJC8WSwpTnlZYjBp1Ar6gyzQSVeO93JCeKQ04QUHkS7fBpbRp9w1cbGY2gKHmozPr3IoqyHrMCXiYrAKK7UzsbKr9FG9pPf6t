<?php
  $authCode = $_GET['code'];

  $parameterValues = array(
    'client_id' => 'gyueptk1c7m8m7iaob1u3i6v06rfmj',
    'client_secret' => '80poli2fmnikdouo2d8lnyclnth1k6',
    'grant_type' => 'authorization_code',
    'redirect_uri' => 'https://ipdonate.com/login.php',
    'code' => $authCode
  );

  $postValues = http_build_query($parameterValues, '', '&');

  $ch = curl_init();
    
  curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => 'https://api.twitch.tv/kraken/oauth2/token',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => $postValues
  ));
            
  $response = curl_exec($ch);
  curl_close($ch);

  echo $response;
?>