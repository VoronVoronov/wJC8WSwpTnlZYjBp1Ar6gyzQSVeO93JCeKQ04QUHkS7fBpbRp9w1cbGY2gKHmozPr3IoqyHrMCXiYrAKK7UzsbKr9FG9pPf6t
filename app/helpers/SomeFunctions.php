<?php
/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 24.01.2017
 * Time: 22:19
 */

function IsOnline()
{
    model('User');

    if(!empty(session('user_id'))) {
        $user = (object)registry()->UserModel->getUser(session('user_id'));

        $balance = registry()->UserModel->getBalance(session('user_id'));

        $user->user_balance = (empty($balance)) ? 0 : $balance;
        $user->user_donations = registry()->UserModel->getDonations(session('user_id'));
        $user->user_last_stream_time = registry()->UserModel->getLastStreamEndTime(session("user_id"));
        $user->user_stream_time = (float) (registry()->UserModel->getStreamTime(session("user_id")) / 60);

        return $user;
    } else
        return false;
}

function getHumanDate($date, $type = 1)
{
    $months = [
        1 => "января",
        "ферваля",
        "марта",
        "апреля",
        "мая",
        "июня",
        "июля",
        "августа",
        "сентября",
        "октября",
        "ноября",
        "декабря",
    ];

    $days = [
        "Воскресенье",
        "Поенедельник",
        "Вторник",
        "Среда",
        "Четверг",
        "Пятница",
        "Суббота",
    ];

    switch ($type) {
        case 1:

            return date("j ", strtotime($date)) . $months[date("n", strtotime($date))];
            break;
    }
}

function getCurrentHumanDate()
{
    $months = [
        1 => "января",
        "ферваля",
        "марта",
        "апреля",
        "мая",
        "июня",
        "июля",
        "августа",
        "сентября",
        "октября",
        "ноября",
        "декабря",
    ];

    $days = [
        "Воскресенье",
        "Поенедельник",
        "Вторник",
        "Среда",
        "Четверг",
        "Пятница",
        "Суббота",
    ];

    return $days[date("w")] .", ". date(j) ." ". $months[date("n")];
}

function format_fsize($size)
{
    $metrics[0] = 'байт';
    $metrics[1] = 'КБ';
    $metrics[2] = 'МБ';
    $metrics[3] = 'ГБ';
    $metrics[4] = 'ТБ';
    $metric = 0;
    while(floor($size/1024) > 0){
        ++$metric;
        $size /= 1024;
    }
    $ret =  round($size,1)." ".(isset($metrics[$metric])?$metrics[$metric]:'??');
    return $ret;
}

function getCurrency($num) {
    $currency = [
        "RUB",
        "USD",
        "UAH",
        "EUR",
        "BYN",
        "KZT",
    ];

    return $currency[$num];
}

function getHumanCurrency($curr)
{
    $currency = [
        "руб.",
        "$",
        "грн.",
        "€",
        "BYN",
        "KZT",
    ];

    return $currency[$curr];
}

function getAlertWidgetID()
{
    model("Widget");

    $widgets = registry()->WidgetModel->getUserAlertsWidget(session("user_id"));
    foreach ($widgets as $widget) {
        return $widget['widget_id'];
    }
}