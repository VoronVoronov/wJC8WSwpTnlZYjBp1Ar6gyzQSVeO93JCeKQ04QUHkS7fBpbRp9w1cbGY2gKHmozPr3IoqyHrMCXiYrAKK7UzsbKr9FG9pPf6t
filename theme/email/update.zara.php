<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StreamDonate | Смена E-Mail</title>

    <link href="https://ipdonate.com/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://ipdonate.com/assets/css/sticky-footer.css" rel="stylesheet">
    <style>
        a.paysystem {
            display: inline-block;
            width: 23%;
            margin: 0px 15px;
            cursor: pointer;
        }

        .clear {
            clear: both;
        }
    </style>
  </head>

  <body>

    <div class="container">
        <div class="page-header">
            <h1>StreamDonate | Смена E-Mail</h1>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
				Вы запросили на смену почтового ящика, перейдите по ссылку                 
				<br><br>
                Ваша ссылка для подтверждения: <a href="https://ipdonate.com/user/verify/{{ $userid }}-{{ $code }}">https://ipdonate.com/user/verify/{{ $userid }}-{{ $code }}</a>
                <br><br>
            </div>
        </div>
        <blockquote>
            <small>Просим не отвечать на данное сообщение, оно было сгенерировано и отправлено автоматически.</small>
        </blockquote>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">
            <a href="https://vk.com/im?sel=-174659405" class="text-left">Поддержка</a> 
            <span class="pull-right">| <a href="https://ipdonate.com/">StreamDonate</a> &copy; 2019</span>
        </p>
        <div class="clear"></div>
      </div>
    </footer>
  </body>
</html>