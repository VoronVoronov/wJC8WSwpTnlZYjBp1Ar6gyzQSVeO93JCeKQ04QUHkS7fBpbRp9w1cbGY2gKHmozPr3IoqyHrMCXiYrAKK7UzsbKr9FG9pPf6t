<?php
/*
|--------------------------------------------------------------------------
| Маршрутизация
|--------------------------------------------------------------------------
|
| Укажите пути маршрутизации и какие контроллеры будут выполняться вместе
| с их параметрами и так же действиями которые они должны выполнять
|
*/

//Router::any("go", "HomeController@redirect");
Router::any("agreement", "HomeController@agreement");
Router::any("oferta", "HomeController@oferta");
Router::any("news", "HomeController@news");


Router::any("/", ["as" => "home", "uses" => "HomeController@index"])->alias("panel");

Router::group(['param' => ['session', '!empty', 'user_id']], function(){
    Router::post("check_url/{url:[a-z0-9A-Z_.]+}", "UserController@check_url");

    Router::get("connect/{type:[a-z]+}","UserController@connect");
    Router::get("disconnect/{type:[a-z]+}","UserController@disconnect");

    Router::post("user", ["as" => "user.post", "uses" => "UserController@post_user"]);
    Router::get("user", ["as" => "user.profile", "uses" => "UserController@profile"]);
    Router::get("profile", ["as" => "user.profile.two", "uses" => "UserController@profile"]);
    Router::get("donations", ["as" => "user.donation", "uses" => "UserController@donations"]);
    Router::get("messages", ["as" => "user.message", "uses" => "UserController@messages"]);
    Router::get("money", ["as" => "user.money", "uses" => "UserController@money"]);
    Router::post("money", ["as" => "user.money.post", "uses" => "UserController@moneyPost"]);
    Router::get("donation-page", ["as" => "user.donation-page", "uses" => "UserController@donationPage"]);
    Router::post("donation-page", ["as" => "user.donation-page.post", "uses" => "UserController@donationPagePost"]);

    Router::get("paypal", ["as" => "user.paypal", "uses" => "UserController@paypal"]);
    Router::post("paypal", ["as" => "user.paypal.post", "uses" => "UserController@paypalPost"]);

    Router::get("user/logout", ["as" => "user.logout", "uses" => "UserController@logout"]);
    Router::get("faq", ["as" => "user.faq", "uses" => "UserController@faq"]);

    Router::post("edit-donate-page", ["as" => "user.editor.donate-page", "uses" => "UserController@editorDonatePage"]);

    Router::any("widgets/my", "WidgetController@myWidgets");
    Router::any("widgets/my/{type:[a-zA-Z-]+}", "WidgetController@myWidgets");
    Router::get("widgets/new", "WidgetController@addWidget");
    Router::post("widgets/new", "WidgetController@addWidgetPost");
    Router::any("widgets/remove", "WidgetController@removeWidget");
    Router::get("widgets/edit/{id:[0-9]+}", "WidgetController@editWidget");
    Router::post("widgets/edit/{id:[0-9]+}", "WidgetController@editWidgetPost");

    Router::post("files/upload", "MediaGalleryController@uploadFile");
    Router::post("files/getgallery", "MediaGalleryController@getGalleryFiles");
    Router::post("files/getown", "MediaGalleryController@getOwnFiles");
    Router::post("files/getsize", "MediaGalleryController@getSizeFiles");
});

Router::get("user/verify/{id:[0-9]+}-{code:[a-zA-z0-9]+}", ["as" => "user.verify", "uses" => "UserController@verify"]);

Router::get("donate/{login:[a-zA-Z0-9-_+]+}", ["as" => "user.donate", "uses" => "UserController@donate"]);
Router::post("donate/{login:[a-zA-Z0-9-_+]+}", ["as" => "user.donate.post", "uses" => "UserController@donatePost"]);

Router::get("login/{type:[a-z]+}","UserController@login");

//Оплата
Router::post("payment/{id:[0-9]+}", "PaymentController@index");
Router::get("payment/{id:[0-9]+}", "PaymentController@index");

//Способы оплаты
Router::get("pay/qiwi/{id:[0-9]+}", "PaymentController@qiwi");
Router::post("pay/qiwi/{id:[0-9]+}", "PaymentController@qiwi");
Router::get("pay/yoomoney/{id:[0-9]+}", "PaymentController@yoomoney");
Router::post("pay/yoomoney/{id:[0-9]+}", "PaymentController@yoomoney");
Router::get("pay/card/{id:[0-9]+}", "PaymentController@card");
Router::post("pay/card/{id:[0-9]+}", "PaymentController@card");
Router::get("pay/webmoneyp/{id:[0-9]+}", "PaymentController@webmoneyp");
Router::post("pay/webmoneyp/{id:[0-9]+}", "PaymentController@webmoneyp");
Router::get("pay/webmoneyr/{id:[0-9]+}", "PaymentController@webmoneyr");
Router::post("pay/webmoneyr/{id:[0-9]+}", "PaymentController@webmoneyr");
Router::get("pay/webmoneyb/{id:[0-9]+}", "PaymentController@webmoneyb");
Router::post("pay/webmoneyb/{id:[0-9]+}", "PaymentController@webmoneyb");
Router::get("pay/webmoneye/{id:[0-9]+}", "PaymentController@webmoneye");
Router::post("pay/webmoneye/{id:[0-9]+}", "PaymentController@webmoneye");
Router::get("pay/webmoneyz/{id:[0-9]+}", "PaymentController@webmoneyz");
Router::post("pay/webmoneyz/{id:[0-9]+}", "PaymentController@webmoneyz");
Router::get("pay/webmoneyk/{id:[0-9]+}", "PaymentController@webmoneyk");
Router::post("pay/webmoneyk/{id:[0-9]+}", "PaymentController@webmoneyk");

Router::get("widget/{token:[a-zA-Z0-9]+}", "WidgetController@widget");
Router::any("alert/{token:[a-zA-Z0-9]+}", "WidgetController@widgetDemo");
Router::post("widgets/alert/{id:[0-9]+}/showed", "WidgetController@alertShowed");

Router::get("widgets/events", "WidgetController@events");

Router::post("widgets/getalerts/{id:[0-9]+}/{token:[a-zA-Z0-9]+}", "WidgetController@getNotShowedAlerts");
Router::post("widgets/getlastmsg/{id:[0-9]+}/{token:[a-zA-Z0-9]+}", "WidgetController@getLastMessage");
Router::post("widgets/getcostsmsg/{id:[0-9]+}/{token:[a-zA-Z0-9]+}", "WidgetController@getCostMessage");
Router::post("widgets/getucostsmsg/{id:[0-9]+}/{token:[a-zA-Z0-9]+}", "WidgetController@getUserCostMessage");
Router::post("widgets/getbalance/{id:[0-9]+}/{token:[a-zA-Z0-9]+}", "WidgetController@getBalance");
Router::post("widgets/getvotevariants/{id:[0-9]+}/{token:[a-zA-Z0-9]+}", "WidgetController@getVoteVariants");

Router::get("control", "WidgetController@control");
Router::post("control", "WidgetController@controlPost");
Router::get("stopShow", "WidgetController@stopShow");

Router::group(['param' => ['get', '==', ["token" => config()->token]]], function(){
    Router::get("cron/updateSubs", "CronController@updateSubs");
    Router::get("cron/updateStreamStatus", "CronController@updateStreamStatus");
});

Router::group(['param' => ['get', '==', ["token" => config()->token]]], function () {
    Router::get("api/v1/{action:[a-z]+}", "ApiController@tokenActions");
});
//Router::get("api/v1/{action:[a-z]+}", "ApiController@tokenActions");


//Callback уведомления
Router::get("unitpay/handler", "UnitPayController@handler");
Router::get("qiwi/handler", "PaymentController@QiwiHandler");
Router::get("yoomoney/handler", "PaymentController@YoomoneyHandler");
Router::get("webmoney/handler", "PaymentController@WebmoneyHandler");
Router::get("paypal/handler", "PaymentController@PaypalHandler");


