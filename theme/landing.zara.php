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
    <meta name="telderi" content="c15a225b1642bd3749c3eeb00ecf51d0" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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
                <li class="active"><a href="/">Главная</a></li>
                <li><a href="https://vk.com/im?sel=-174659405">Помощь</a></li>
                <li class="contact"><a href="#">Контакты</a></li>
                <li class="auth"><a href="#">Войти</a></li>
            </ul>
        </div>
    </div>

    <div id="landing">
        <div class="header">
            <div class="slider">
                <div class="slide" id="slide-1" style="display: block; background-image: url('/assets/images/slider/slide-1.png');">
                    <div class="container">
                        <a href="#" class="slide-btn">Опробовать</a>
                    </div>
                </div>
                <div class="slide" id="slide-2" style="background-image: url('/assets/images/slider/slide-2.png');">
                    <div class="container">
                        <a href="#" class="slide-btn">Опробовать</a>
                    </div>
                </div>
                <div class="slide" id="slide-3" style="background-image: url('/assets/images/slider/slide-3.png');">
                    <div class="container">
                        <a href="#" class="slide-btn">Опробовать</a>
                    </div>
                </div>
                <div class="slide" id="slide-4" style="background-image: url('/assets/images/slider/slide-4.png');">
                    <div class="container">
                        <a href="#" class="slide-btn">Опробовать</a>
                    </div>
                </div>

                <ul class="slide-menu">
                    <li class="active" data-id="1"><a href="#"></a></li>
                    <li data-id="2"><a href="#"></a></li>
                    <li data-id="3"><a href="#"></a></li>
                    <li data-id="4"><a href="#"></a></li>
                </ul>
            </div>
        </div>

        <div class="content">
            <!--<div class="stats container">
                <h5>Статистика</h5>
                <div class="stats-content">
                    <div class="stats-block">
                        <b>4 000 000</b>
                        <p>Сообщений отправленно</p>
                    </div>
                    <div class="stats-block">
                        <b>2 345 000</b>
                        <p>Заработано на стримах</p>
                    </div>
                    <div class="stats-block">
                        <b>12 450</b>
                        <p>Стримеров</p>
                    </div>
                    <div class="stats-block">
                        <b>200</b>
                        <p>Стримов онлайн</p>
                    </div>
                </div>
            </div>

            <div class="streams row container">
                <h5>Онлайн трансляции</h5>
                <iframe id="iframe-player" src="https://player.twitch.tv/?channel=cheatbanned" frameborder="0" allowfullscreen="true" scrolling="no" class="current-stream col-md-6"></iframe>
                <div class="stream-list col-md-6">
                    <div class="stream-label active" data-player="twitch" data-login="maksa98">
                        <img src="https://static-cdn.jtvnw.net/jtv_user_pictures/maksa98-profile_image-a105dc5a134104d4-300x300.jpeg">
                        <div>
                            <p>Maksa988</p>
                            Grand Theft Auto V
                        </div>

                        <span><i class="fa fa-user"></i> 3 300</span>
                    </div>

                    <div class="stream-label" data-player="twitch" data-login="cheatbanned">
                        <img src="https://static-cdn.jtvnw.net/jtv_user_pictures/cheatbanned-profile_image-948ded1c64b0bf48-300x300.jpeg">
                        <div>
                            <p>Cheatbanned</p>
                            Conunter Strike: Global Offensive
                        </div>

                        <span><i class="fa fa-user"></i> 3 300</span>
                    </div>

                </div>
            </div>-->

            <div class="rates ">
                <center>
                    <div class="container row">
                        <h5>Наши тарифы</h5>
                        <div class="col-md-4">
                            <div class="rate">
                                <p class="name free">FREE</p>
                                <div class="desc">Бесплатный тариф, который доступен каждому стримеру. Включает стартовый набор инструментов для проведение первокласных стримов.</div>
                                <span>Комиссия на приём: до 7%</span>
                                <span>Комиссия на вывод: до 7%</span>
                                <span>Discord-бот</span>
                                <a href="#" class="btn btn-default btn-sm slide-btn">Опробовать</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="rate not-active-rate">
                                <p class="name two">Advanced</p>
                                <div class="desc">Данный тарифный план включает в себя функционал сервиса и возможность принимать пожертвования на свои электронные кошельки.</div>
                                <span>Комиссия на приём: 0%</span>
                                <span>Комиссия на вывод: 0%</span>
                                <span>Discord-бот</span>
                                <div class="price two">
                                    <b>499</b>
                                    <p>рублей</p>
                                </div>
                                <a href="#" class="btn btn-danger btn-sm">Купить</a>
                            </div>
                        </div>
                    </div>
                </center>


                <h5>Мы работаем с сервисами</h5>
                <div class="social-platform">
                    <a href="#"><i class="fa fa-twitch"></i> Twitch</a>
                    <a href="#"><i class="fa fa-youtube-play"></i> YouTube</a>
                    <a href="#"><i class="fa fa-vk"></i> VK Gaming</a>
                </div>
            </div>
        </div>

        <div class="pay-methods container">
            <h5>Мы работаем с различными платёжными системами</h5>
            <img src="/assets/images/pay-methods.png">
            <h5>А так же уникальня возможность принимать скины</h5>
            <img src="/assets/images/pay-methods-games.png">
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <div class="left-footer">
                <div class="left-menu">
                    <a href="/">- Главная</a>
                    <a href="/oferta">- Публичная оферта</a>
                    <a href="/agreement">- Пользовательское соглашение</a>
                    <a href="https://vk.com/ipdonate">- ВКонтакте</a>
                </div>

                <div class="left-menu">
                    <a href="https://passport.webmoney.ru/asp/certview.asp?wmid=413143268781" target="_blank"><img src="/assets/images/v_blue_on_white_ru.png" alt="Здесь находится аттестат нашего WM идентификатора 413143268781" border="0" /></a>
                </div>
                <div class="left-menu">
                    <a href="https://megastock.ru/" target="_blank"><img src="/assets/images/webmoney_accept.png"></a>
                </div>
            </div>

            <div class="clear"></div>
        </div>
        <div class="footer-line">
            <div class="container">
                <div class="copyright">
                    2019 - <?php echo date ( 'Y' ) ; ?> &copy; IPDonate
                    <i class="fab fa-vimeo"></i>
                    <?
                    $version_json = @file_get_contents('https://ipdonate.com/api/v1/version/?token=OitQDh8fwQIO0ZaFJZwXuz5R');
                    $version = json_decode($version_json, true);
                    echo $version[0]['version'];
                    echo $version[0]['type'];
                    ?>.
                    <a href="https://status.ipdonate.com/">
                        UPTIME:
                        <!--
                        <i class="fas fa-signal"></i>
                        <i class="fab fa-dev"></i>
                        -->

                        <?
                        $status_json = @file_get_contents('https://updown.io/api/checks?api-key=CayZiwAv5S9oVkEUYxnu');
                        $status = json_decode( $status_json, true );
                        echo $uptime = $status[0]['uptime'].'%';
                        ?>
                    </a>
                </div>

                <div class="copyright-right">
                    Все права защищены
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
                    <center>
                        <div class="col-xs-2 col-sm-2">
                            <a href="/login/twitch" class="btn btn-lg btn-block lgn_btn-twitch" data-toggle="tooltip" data-placement="top" title="Twitch Login">
                                <i class="fa fa-twitch fa-2x"></i>
                                <span class="hidden-xs"></span>
                            </a>
                        </div>
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
                        <br>
                    </center>
                </div>
                <center>
                    <small>Авторизуясь, Вы подтверждаете, что внимательно прочитали и согласились нашими <a href="/agreement">пользовательским соглашением</a> и нашей <a href="/privacy">Политикой конфиденциальности</a>.</small>
                </center>
            </div>
        </div>
    </div>
</div>

<div id="contactModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row row-sm-offset-3 socialButtons">
                    <center>
                        E-mail: support@ipdonate.com<br>
                        Сотовая связь: +79643641100<br>
                    </center>
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
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>

<div id="vk_community_messages"></div>
<script type="text/javascript">
    VK.Widgets.CommunityMessages("vk_community_messages", 174659405, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>
<script>
    var curr_slide = 1;
    var max_slide = 4;

    function changeSlide(id) {
        $(".slide").hide();
        $("#slide-" + id).show();
        $(".slide-menu li").removeClass("active");
        $(".slide-menu li[data-id="+ id +"]").addClass("active");
    }

    setInterval(function () {
        if(curr_slide == 4) {
            changeSlide(curr_slide);
            curr_slide = 1;
        } else {
            changeSlide(curr_slide);
            curr_slide++;
        }
    }, 5000);

    $(".slide-menu li").click(function () {
        curr_slide = $(this).attr("data-id");
        changeSlide(curr_slide);
    });

    $(".slide-btn, .auth").click(function() {
        $("#authModal").modal("show");

        return false;
    });

    $(".contact").click(function() {
        $("#contactModal").modal("show");

        return false;
    });

    $(".stream-label").click(function () {
        $(".stream-label").removeClass("active");
        $(this).addClass("active");
        if($(this).attr("data-player") == "twitch") {
            $("#iframe-player").attr("src", "https://player.twitch.tv/?channel=" + $(this).attr("data-login"));
        }
    });

</script>

</body>
</html>
