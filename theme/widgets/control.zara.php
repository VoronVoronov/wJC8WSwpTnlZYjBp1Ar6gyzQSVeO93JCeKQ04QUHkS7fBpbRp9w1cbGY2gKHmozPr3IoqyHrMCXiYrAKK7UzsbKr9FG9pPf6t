<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>{{ lang('main.title_widget_control') }} - DFor.me</title>
		<link rel="stylesheet" href="/assets/css/widget.css">
		<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
	</head>
	<body>
        <form action="" method="POST">
            <select name="widget_id">
                @foreach($widgets as $widget)
                <option value="{{ $widget['widget_id'] }}">{{ $widget['widget_name'] }}</option>
                @endforeach
            </select><br>
            <input type="text" name="user_name" placeholder="USER_NAME">
            <input type="text" name="sum" placeholder="SUM">
            <select name="curr">
                <option value="RUB">RUB</option>
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="UAH">UAH</option>
                <option value="BYN">BYN</option>
                <option value="KZT">KZT</option>
            </select>
            <br>
            <br>
            <textarea name="msg" rows="5" cols="50"></textarea>
            <br>
            <input type="submit" value="SEND" id="btn">
        </form>
	</body>
</html>