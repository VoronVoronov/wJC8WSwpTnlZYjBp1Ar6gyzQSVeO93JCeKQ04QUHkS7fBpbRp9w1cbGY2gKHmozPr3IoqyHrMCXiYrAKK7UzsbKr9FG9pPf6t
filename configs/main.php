<?php
/*
|--------------------------------------------------------------------------
| Главный файл конфигурации
|--------------------------------------------------------------------------
|
| Указаны основые данны для работы с системой
| Есть возможность подключить сторонние конфигурационные файлы
|
*/
return [

	// Режим откладки, рекомендуеться использовать во время разработки
	'debug_mode'	=>		true,

	// URL вашего сайта.
	// Будет использовано при формировании URL адреса
	'url'			=>		'https://ipdonate.com/',
	
	// Ключ приложения
	// Будет использоват в шифровке данных
	'app_key'		=>		"empty",

    'token'         =>      "OitQDh8fwQIO0ZaFJZwXuz5R",

    // Язык локализации который бдет использоватся на сайте
    'locale'        =>      'ru',

    // Резервный язык локализации
    'fallback_locale'=>     'ru',

    "unitpay"   =>  [
        "public_key" => "374671-56ad9",
        "secret_key" => "40313a57bce19a186f23c2a14a431517",
    ],

	// Данные Базы Данных
	'db'			=>		[
		
		// Драйвер для работы с БД.
		// По умолчанию MySQL (mysqli).
		'driver'		=>		'mysql',

		// Тип СУБД.
		// По умолчанию поддерживается только СУБД MySQL (mysql).
		'type'			=>		'mysql',
		
		// Хост БД.
		// Пример: localhost, 127.0.0.1, db.example.com и пр.
		'hostname'		=>		'localhost',
		
		// Имя пользователя СУБД.
		'username'		=>		'ipdonate.com',
		
		// Пароль пользователя СУБД.
		'password'		=>		'4G1w2Z1c',
		
		// Название БД.
		'database'		=>		'ipdonate.com',

		// Испльзуемая кодировка
		'charset'   	=> 		'utf8',
		
	],
	
	'vk'		=>		[
		'client_id'		=>		'7239263',
		'client_secret'		=>		'tc2ESM9UWhEfziDQ6qCM',
		'redirect_uri'		=>		'https://ipdonate.com/login/vk',
	],

	'hitbox'	=>		[
		'requestToken'			=>		'kuhKSTMwQg9OFa5o7iPAp1jsnvcyNHWGYUXDetCz',
		'secret'				=>		'FYyM6BQ07fjIcx5rGqUukSzhLPDaKWtbOJCXigA1',
	],

	'twitch'	=>		[
		'client_id' 		=> 'gyueptk1c7m8m7iaob1u3i6v06rfmj',
	    'client_secret' 	=> '80poli2fmnikdouo2d8lnyclnth1k6',
	    'redirect_uri' 		=> 'https://ipdonate.com/login/twitch',
	],

    "youtube"   =>      [
        "client_id" 		=> '888676261813-qughuv0n186hhrrv0vpnejql0d3f2ntn.apps.googleusercontent.com',
        "client_secret" 	=> '0l08deM5aYPY8h9zBaTQ-0_t',
        "redirect_uri" 		=> 'https://ipdonate.com/login/youtube',
        'youtube_api'		=> 'AIzaSyCU5VqW4A7siaifEj05lmA_9HUyFpnb4UA',
    ],

	// Настройки почты
	'mail' 		=> 		[
		
		// E-Mail отправителя.
		// Пример: support@example.com, noreply@example.com
		'mail_from'		=>		'no-reply@ipdonate.com',
		
		// Имя отправителя.
		// Пример: Ivan Petrov
		'mail_sender'		=>		'IPDonate Support',
	],

	// Настройки массовой выплаты
	'masspayment' 		=> 		[
		
		'login'				=>		'info@zholdas.icu',
		
		'secret_key'		=>		'7637382C26D-987D9DF2877-4EBEEDD0F4',
	],
	
	// Настройки qiwi
	'qiwi' 		=> 		[
		
		'public_key'		=>		'48e7qUxn9T7RyYE1MVZswX1FRSbE6iyCj2gCRwwF3Dnh5XrasNTx3BGPiMsyXQFNKQhvukniQG8RTVhYm3iPuakaTjqcMceLC2odGUmgkhfEzGcL6jupmJ4Ucr1CwadWQS3kd2nhHKA2GVJ1GHfwyeJQqgiQejQ8Bpfwof66y6xsA6MwDGvwU9j5GhMax',
		
		'secret_key'		=>		'eyJ2ZXJzaW9uIjoiUDJQIiwiZGF0YSI6eyJwYXlpbl9tZXJjaGFudF9zaXRlX3VpZCI6Im0xemlkci0wMCIsInVzZXJfaWQiOiI3OTY0MzY0MTEwMCIsInNlY3JldCI6IjNjNjk3YmE5NzAzYzNlOWQxYTczMDQyYjhiZjZjMmMxNTk1MDUxYTBmYWFlNzY4OGFlYTgyNDEzNjcwNWVjZTkifX0=',
	],	
	
	// Настройки yoomoney
	'yoomoney' 		=> 		[

		'wallet'			=>		'410014429063545',
		
		'secret_key'		=>		'8gUimObg0EJKQS8/jA3FjU48',
	
	],	
	
	// Настройки webmoney
	'webmoney' 		=> 		[
		'wallet'			=>		'P050915098697',
		'secret_key'		=>		'UoPyhd5I7XI2WSuvPIBkHVI0',
	
	],	
	
	//Список пользовательских файлов для загрузки
    'load_files'          =>      [
        "app/helpers/SomeFunctions.php",
        "app/helpers/emoji.php",
    ],
];