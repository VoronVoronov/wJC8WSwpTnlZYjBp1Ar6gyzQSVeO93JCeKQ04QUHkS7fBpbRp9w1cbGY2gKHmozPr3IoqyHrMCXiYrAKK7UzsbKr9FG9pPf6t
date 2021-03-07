<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Cache-Control" content="no-cache" />

    <title>IPDonate</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-tour.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">


    @yield("styles")

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body id="wrapper">

<div>

    <div class="navbar">
        <div class="container text-center">
            <ul>
                <li><a href="#">Главная</a></li>
                <li class="active"><a href="#">Панель управления</a></li>
                <li><a href="/faq">FAQ</a></li>
            </ul>
        </div>
    </div>

    <div class="content row container">
        <div class="sidebar col-md-3">
            <ul>
                <li>
                    <a href="#">Мой аккаунт</a>
                    <ul>
                        <li @if(route()->url == "/" or route()->url == "panel") class="active" @endif><a href="/"><i class="icon icon-stats"></i> Моя статистика</a></li>
                        <li @if(route()->url == "messages") class="active" @endif><a href="/messages"><i class="icon icon-mail"></i> Мои сообщения</a></li>
                        <li @if(route()->url == "donations") class="active" @endif><a href="/donations"><i class="icon icon-balance"></i> Мои донаты</a></li>
                        <li @if(route()->url == "money") class="active" @endif><a href="/money"><i class="icon icon-exit"></i> Мои выплаты</a></li>
                        <li @if(route()->url == "faq") class="active" @endif><a href="/faq"><i class="icon icon-help"></i> FAQ</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#">Личные настройки</a>
                    <ul>
                        <li @if(route()->url == "user" or route()->url == "profile") class="active" @endif><a href="/profile"><i class="icon icon-settings"></i> Основные настройки</a></li>
                        <li @if(route()->url == "donation-page") class="active" @endif><a href="/donation-page"><i class="icon icon-chat"></i> Настройки страницы доната</a></li>
                        <li @if(route()->url == "update") class="active" @endif><a href="/update"><i class="icon icon-balance"></i> Тариф</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#">Виджеты</a>
                    <ul>
                        <li @if(route()->url == "widgets/my/alerts") class="active" @endif><a href="/widgets/my/alerts"><i class="icon icon-bell"></i> Оповещения</a></li>
                        <li @if(route()->url == "widgets/my/stats") class="active" @endif><a href="/widgets/my/stats"><i class="icon icon-mic"></i> Внутристримовая статистика</a></li>
                        <li @if(route()->url == "widgets/my/goals") class="active" @endif><a href="/widgets/my/goals"><i class="icon icon-balance"></i> Сбор средств</a></li>
                        <li @if(route()->url == "widgets/my/votes") class="active" @endif><a href="/widgets/my/votes"><i class="icon icon-vote"></i> Голосования</a></li>
                        <li @if(route()->url == "widgets/evenets") class="active" @endif><a href="/widgets/events"><i class="fa fa-list"></i> Последние действия</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="page-wrapper col-md-9">
            <div class="page-head">
                <img src="{{ isOnline()->user_avatar }}" class="mini-avatar">
                <i class="status-online"></i>
                <b>{{ isOnline()->user_login_show }}</b>
                <p>({{ isOnline()->user_balance }} руб.)</p>

                <a href="/user/logout" class="logout-btn">Выйти</a>
            </div>

            <div class="page-content">
                @yield("content")
            </div>
        </div>
    </div>
</div>

<div id="notifier-box"></div>
<!-- /#wrapper -->

<script src="https://use.fontawesome.com/1d342aabb8.js"></script>
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/bootstrap-tour.min.js"></script>
@yield("plugins-scripts");
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>

<div id="vk_community_messages"></div>
<script type="text/javascript">
    VK.Widgets.CommunityMessages("vk_community_messages", 190202028, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>
<script>
    var tour = new Tour({
        steps: [
            {
                path: "/",
                element: ".sidebar",
                title: "Основное меню",
                content: "В этом меню размещены основные разделы нужные вам для работы с сайтом",
                backdrop: true,
            },
            {
                path: "/",
                element: ".page-content",
                title: "Основной контент",
                content: "В данном разделе сайта будет размещатся весь контент сайта",
                placement: "top"
            },
            {
                path: "/",
                element: ".page-head",
                title: "Мини профиль",
                content: "В этой части сайта размещен ваш аватар, статус стрима и текущий баланс",
                backdrop: true,
                placement: "bottom"
            },
            {
                element: ".stats-block:first-child",
                title: "Статистика",
                content: "Тут размещены блоки с основной статистикой, она отображается за весь период",
                placement: "left"
            },
            {
                path: "/",
                element: "#graph-stats",
                title: "Статистика",
                content: "Тут отображен график вашей статистики дохода за последние 30 дней",
                backdrop: true,
                placement: "left"
            },
            {
                path: "/",
                element: ".last-donations",
                title: "Последние действия",
                content: "Тут будут отображены все последние действия ваших зрителей (подписка / донат)",
                backdrop: true,
                placement: "top"
            },
            {
                path: "/messages",
                element: ".messages",
                title: "Сообщения",
                content: "На данной странице будут отоображены все действия которые вы производите на сайте",
                backdrop: true,
                placement: "top"
            },
            {
                path: "/donations",
                element: ".donations",
                title: "Донаты",
                content: "На данной странице вы увидите список последних донатов с указанием автора, суммы и времени",
                backdrop: true,
                placement: "top"
            },
            {
                path: "/money",
                element: ".newRequestBtn",
                title: "Выплаты",
                content: "Все полученные деньги вы можете вывести на один из ваших счетов, для создания выплаты просто нажмите на эту кнопку",
                backdrop: true,
                placement: "left"
            },
            {
                path: "/money",
                element: ".money_back",
                title: "Список выплат",
                content: "В данной части отображен список ваших запросов, их сумма, время и так же статус. Код который указан в списке будет указан в примечании при переводе денег",
                backdrop: true,
                placement: "left"
            },
            {
                path: "/profile",
                element: ".page-name h3",
                title: "Дата последнего стрима",
                content: "Закончив стрим тут будет отображатся дата вашего последнего стрима",
                backdrop: true,
                placement: "left"
            },
            {
                path: "/profile",
                element: ".user-profile",
                title: "Профиль",
                content: "Это ваш профиль, тут вы сможете посмотреть сколько вы заработали, ваш баланс и общее время трансляций",
                backdrop: true,
                placement: "left"
            },
            {
                path: "/profile",
                element: ".user-info",
                title: "Данные",
                content: "На этой странице отображены ваши данные которые вы можете изменять",
                backdrop: true,
                placement: "top"
            },
            {
                path: "/profile",
                element: ".user-info .user-left",
                title: "Профили",
                content: "К вашему аккаунту вы можете подключать или отключать различные профили, отключив например Twitch, система не будет учитывать новых подписчиков",
                backdrop: true,
                placement: "right"
            },
            {
                path: "/profile",
                element: ".user-info .user-right",
                title: "Счета",
                content: "Тут отображены ваши счета, вы можете изменить их указав свои реквизиты для вывода денег. Для изменения просто нажмите по значению дважды",
                backdrop: true,
                placement: "left"
            },
            {
                path: "/profile",
                element: ".last-actions",
                title: "Сессии",
                content: "В данном блоке отображены ваши сессии, их время и с какого IP они были совершенны",
                backdrop: true,
                placement: "left"
            },
            {
                path: "/donation-page",
                element: "#donation-page-form",
                title: "Настройкии страницы",
                content: "На этой странице вы можете изменить некоторые данные вашей страницы для отправки сообщений. Для изменения оформления просто перейдите на вашу страницу.",
                backdrop: true,
                placement: "top"
            },
            {
                path: "/donation-page",
                element: "#url_change_url",
                title: "Смена адреса",
                content: "Нажав на иконку редактирования возле адреса, вы можете изменить ваш адрес на любой подходящий Вам и свободный.",
                backdrop: true,
                placement: "right"
            },
            {
                path: "/widgets/my/alerts",
                element: ".my-widgets",
                title: "Ваши виджеты",
                content: "Перейдя на раздел с определенным типом виджетов вы увидите их список, вы сможете редактировать его или запустить.",
                backdrop: true,
                placement: "top"
            },
            {
                path: "/widgets/my/alerts",
                element: ".page-name a",
                title: "Новый виджет",
                content: "Каждый виджет вы можете создать отдельно, например если вам нужно несколько вариаций, и вы можете запускать их по отдельности или одновременно.",
                backdrop: true,
                placement: "left"
            },
            {
                path: "/widgets/edit/{{ getAlertWidgetID() }}",
                element: "#tour_alert_one",
                title: "Тип оповещений",
                content: "Изначально все типы оповещений включены, нажав на одну из кнопок вы отключите или включите один из типов. После чего вы можете включить ваш виджет и он будет отображать только те типы которые вы оставили.",
                backdrop: true,
                placement: "right"
            },
            {
                path: "/widgets/edit/{{ getAlertWidgetID() }}",
                element: "#tour_alert_two",
                title: "Адрес виджета",
                content: "В данном поле хранится адрес вашего виджета, он скрыт так как имеет уникальный токен, не отправляйте ссылку никому. Так же нажав Запустить вы запустите виджет с использованием цвета фона который указан ниже.",
                backdrop: true,
                placement: "left"
            },
            {
                path: "/widgets/edit/{{ getAlertWidgetID() }}",
                element: "#tour_alert_three",
                title: "Тестовое оповещение",
                content: "Вы можете отправить одно из тестовых оповещений на ваш виджет, тем самым проверить оформление или другие настройки.",
                backdrop: true,
                placement: "left"
            },
            {
                path: "/widgets/edit/{{ getAlertWidgetID() }}",
                element: "#tour_alert_four",
                title: "Настройки виджета",
                content: "Каждый виджет имеет несколько вариантов настроек, вы можете изменить их. Если вам нужна помощь, вы можете навести на знак вопроса с правой стороны и получить информацию.",
                backdrop: true,
                placement: "left"
            }
        ]});

    // Initialize the tour
    tour.init();

    // Start the tour
    tour.start();
</script>

@yield("scripts")

</body>
</html>
