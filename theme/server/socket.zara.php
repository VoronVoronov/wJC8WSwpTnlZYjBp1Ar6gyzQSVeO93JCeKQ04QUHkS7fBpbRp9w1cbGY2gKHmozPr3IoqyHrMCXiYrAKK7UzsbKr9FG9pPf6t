<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>Котроль виджетами - DFor.me</title>
		<link rel="stylesheet" href="/assets/css/widget.css">
		<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
	</head>
	<body>
	
		<script src="/assets/js/jquery.js"></script>
		<script src="/assets/js/fancywebsocket.js"></script> 

		<script>
			console.log('[Server]: Connecting...');
			Server = new FancyWebSocket('ws://127.0.0.1:889');

			//Let the user know we're connected
			Server.bind('open', function() {
				console.log("[Server]: Connected.");
				Server.send('message', '{{ $msg }}');
				console.log("[Server]: Message sended.");
			});

			//OH NOES! Disconnection occurred.
			Server.bind('close', function(data) {
				console.log("[Server]: Disconnected.");
			});
			Server.connect();
		</script>
	</body>
</html>