<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Cache-Control" content="no-cache" />

    <title>IPDonate - зарабатывай вместе с нами!</title>
    
    <script src="https://vk.com/js/api/openapi.js?160" type="text/javascript"></script>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">

	<meta name="webmoney" content="CAB1D522-3C80-4778-9D95-EBC276A179C7"/>


    @yield("styles")

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<div id="wrapper">

    <div class="navbar">
        <div class="container text-center">
            <ul>
                <li><a href="/">Главная</a></li>
                <li class="active"><a target="_blank" href="/news">Новости</a></li>
                <li><a href="http://help.ipdonate.com/">Помощь</a></li>
                <li class="auth"><a href="#">Войти</a></li>
            </ul>
        </div>
    </div>

    <div id="landing">


        <div class="content">
            <div class="stats container">
                <table class="messages">
                    @foreach($news as $item)
                    <thead>
                        <th>{{ $item['news_name'] }}</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $item['news_text'] }}</td>
                        <td>
                            <time datetime="{{ date("Y-m-d\TH:i:s\Z", strtotime($item['news_date'])) }}" class="timeago"></time>
                        </td>
                    </tr>
                    </tbody>
                    @endforeach
                    @if(empty($news))
                    <center>Сообщений нет</center>
                    @endif
                </table>                
            </div>
        </div>

        <div class="footer">
            <div class="container">
                <div class="left-footer">
                    <div class="left-menu">
                        <a href="/">- Главная</a>
                        <a href="https://vk.com/ipdonate">- Новости</a>
                        <a href="/contact">- Контакты</a>
                        <a href="https://vk.com/im?sel=-174659405">- Техническая поддержка</a>
                    </div>

                    <div class="right-menu">
						<a href="https://passport.webmoney.ru/asp/certview.asp?wmid=413143268781" target="_blank"><img src="/assets/images/v_blue_on_white_ru.png" alt="Здесь находится аттестат нашего WM идентификатора 413143268781" border="0" /><br /></a>
                        <a href="https://webmoney.ru/" target="_blank"><img src="https://www.webmoney.ru/img/icons/88x31_wm_white_blue.png"></a>
					</div>
                </div>
		
                <div class="clear"></div>
            </div>
            <div class="footer-line">
                <div class="container">
                    <div class="copyright">
                        2019 &copy; <a href="#">Stream Donate</a>
                    </div>
                    <div class="copyright-right">
                        Любое копирование материала с сайта запрещено!
                    </div>

                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="notifier-box"></div>
<!-- /#wrapper -->


<!-- Модальное окно -->
<div id="authModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row row-sm-offset-3 socialButtons">
                    <div class="col-xs-2 col-sm-2">
                        <a href="/login/vk" class="btn btn-lg btn-block lgn_btn-vk" data-toggle="tooltip" data-placement="top" title="VK Login">
                            <i class="fa fa-vk fa-2x"></i>
                            <span class="hidden-xs"></span>
                        </a>
                    </div>
                    <div class="col-xs-2 col-sm-2">
                        <a href="/login/youtube" class="btn btn-lg btn-block lgn_btn-google-plus" data-toggle="tooltip" data-placement="top" title="YouTube login">
                            <i class="fa fa-youtube fa-2x"></i>
                            <span class="hidden-xs"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Модальное окно -->


<script src="https://use.fontawesome.com/1d342aabb8.js"></script>
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/common.js"></script>
<script src="/assets/js/timeago.min.js"></script>
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>

<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 174659405, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>

<script type="text/javascript">
   $(document).ready(function () {
        function numpf(n, f, s, t) {
            // f - 1, 21, 31, ...
            // s - 2-4, 22-24, 32-34 ...
            // t - 5-20, 25-30, ...
            var n10 = n % 10;
            if ( (n10 == 1) && ( (n == 1) || (n > 20) ) ) {
                return f;
            } else if ( (n10 > 1) && (n10 < 5) && ( (n > 20) || (n < 10) ) ) {
                return s;
            } else {
                return t;
            }
        }

        $.timeago.settings.strings = {
            prefixAgo: null,
            prefixFromNow: "через",
            suffixAgo: "назад",
            suffixFromNow: null,
            seconds: "меньше минуты",
            minute: "минуту",
            minutes: function(value) { return numpf(value, "%d минута", "%d минуты", "%d минут"); },
            hour: "час",
            hours: function(value) { return numpf(value, "%d час", "%d часа", "%d часов"); },
            day: "день",
            days: function(value) { return numpf(value, "%d день", "%d дня", "%d дней"); },
            month: "месяц",
            months: function(value) { return numpf(value, "%d месяц", "%d месяца", "%d месяцев"); },
            year: "год",
            years: function(value) { return numpf(value, "%d год", "%d года", "%d лет"); }
        };
        $('time.timeago').timeago();
    $(".slide-btn, .auth, .rate .btn, .panel-btn").click(function() {
    $("#authModal").modal("show");

        return false;
    });

    $(".contact").click(function() {
       $("#contactModal").modal("show");

        return false;
    });
</script>

</body>
</html>
