@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Административная панель </h2>
    <h3>Последний вход: {{ date("d.m.Y G:m", strtotime($user['user_last_login_time'])) }}</h3>
    <div class="clear"></div>
</div>

<div class="profile-head">
    <div class="user-profile">
        <div class="user-left">
            <img src="{{ $user['user_avatar'] }}" class="profile-avatar">
            <i class="profile-status"></i>
            <div>
                <h4>{{ $user['user_login_show'] }}</h4>
                 @if($user['user_group'] == 1) 
                <span class="btn btn-default btn-xs">
                Пользователь</span>
                @elseif($user['user_group'] == 2)
                <span class="btn btn-info btn-xs">
                Партнер</span>
                @elseif($user['user_group'] == 3)
                <span class="btn btn-success btn-xs">
                Модератор</span>
                @elseif($user['user_group'] == 4)
                <span class="btn btn-danger btn-xs">
                Администратор</span>
                @endif
                
            </div>
        </div>

        <div class="user-right">
            <div class="profile-stats-block">
                <p>Баланс:</p>
                <b>{{ number_format($balance, 0, '', ' ') }}Р</b>
            </div>
            
            <div class="profile-stats-block">
                <p>Доход за все время:</p>
                <b>{{ number_format($allbalance , 0, '', ' ') }}Р</b>
            </div>

        </div>

        <div class="clear"></div>
    </div>

    <div class="user-info">
        <div class="user-left">
            <table>
                <tr>
                    <td>Электронная почта</td>
                    <td id="profile-change-email" style="display: none;"><input type="text" class="form-control input-sm profile-change-email-input" placeholder="Укажите новый E-mail"></td>
                    <td class="profile-change-email @if(empty($user['user_email'])) empty @endif" data-toggle="tooltip" data-placement="top" title="Для изменения кликните дважды">{{ $user['user_email'] or "Не указано" }}</td>
                </tr>
                <tr>
                    @if(empty($user->user_vk))
                    <td><i class="fa fa-vk"></i> Не подключено</td>
                    <td><a href="#" class="btn btn-default btn-xs">Подключить</a></td>
                    @else
                    <td class="active"><i class="fa fa-vk"></i> Подключено</td>
                    <td><a href="#" class="btn btn-danger btn-xs">Отключить</a></td>
                    @endif
                </tr>
                <tr>
                    @if(empty($user->user_twitch))
                    <td><i class="fa fa-twitch"></i> Не подключено</td>
                    <td><a href="#" class="btn btn-default btn-xs">Подключить</a></td>
                    @else
                    <td class="active"><i class="fa fa-twitch"></i> Подключено</td>
                    <td><a href="#" class="btn btn-danger btn-xs">Отключить</a></td>
                    @endif
                </tr>
                <tr>
                    @if(empty($user->user_youtube))
                    <td><i class="fa fa-youtube"></i> Не подключено</td>
                    <td><a href="#" class="btn btn-default btn-xs">Подключить</a></td>
                    @else
                    <td class="active"><i class="fa fa-youtube"></i> Подключено</td>
                    <td><a href="#" class="btn btn-danger btn-xs">Отключить</a></td>
                    @endif
                </tr>
            </table>
        </div>

        <div class="user-right">
            <table>
                <tr>
                    <td>Qiwi</td>
                    <td id="profile-change-qiwi" style="display: none;"><input type="text" name="qiwi" data-type="qiwi" class="form-control input-sm profile-change-input" value="{{ $user->user_wallets->qiwi }}"></td>
                    <td class="profile-change @if(empty($user->user_wallets->qiwi)) empty @endif" data-type="qiwi" data-toggle="tooltip" data-placement="top" title="Для изменения кликните дважды">{{ $user->user_wallets->qiwi or "Не указано" }}</td>
                </tr>
                <tr>
                    <td>WebMoney</td>
                    <td id="profile-change-webmoney" style="display: none;"><input type="text" name="webmoney" data-type="webmoney" class="form-control input-sm profile-change-input" value="{{ $user->user_wallets->webmoney }}"></td>
                    <td class="profile-change @if(empty($user->user_wallets->webmoney)) empty @endif" data-type="webmoney" data-toggle="tooltip" data-placement="top" title="Для изменения кликните дважды">{{ $user->user_wallets->webmoney or "Не указано" }}</td>
                </tr>
                <tr>
                    <td>YooMoney</td>
                    <td id="profile-change-yamoney" style="display: none;"><input type="text" name="yamoney" data-type="yamoney" class="form-control input-sm profile-change-input" value="{{ $user->user_wallets->yamoney }}"></td>
                    <td class="profile-change @if(empty($user->user_wallets->yamoney)) empty @endif" data-type="yamoney" data-toggle="tooltip" data-placement="top" title="Для изменения кликните дважды">{{ $user->user_wallets->yamoney or "Не указано" }}</td>
                </tr>
                <tr>
                    <td>Банковская карта</td>
                    <td id="profile-change-bank" style="display: none;"><input type="text" name="bank" data-type="bank" class="form-control input-sm profile-change-input" value="{{ $user->user_wallets->bank }}"></td>
                    <td class="profile-change @if(empty($user->user_wallets->bank)) empty @endif" data-type="bank" data-toggle="tooltip" data-placement="top" title="Для изменения кликните дважды">{{ $user->user_wallets->bank or "Не указано" }}</td>
                </tr>
            </table>
        </div>

        <div class="clear"></div>
    </div>
</div>
<!-- 
<table class="last-actions">
    <thead>
        <tr>
            <td>Дата</td>
            <td>IP адрес</td>
            <td>Время сессии</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>27/01/2017</td>
            <td>192.168.0.1</td>
            <td>2 часа 35 минут</td>
        </tr>
        <tr>
            <td>26/01/2017</td>
            <td>192.168.0.1</td>
            <td>40 минут</td>
        </tr>
        <tr>
            <td>25/01/2017</td>
            <td>127.0.0.1</td>
            <td>57 минут</td>
        </tr>
        <tr>
            <td>27/01/2017</td>
            <td>192.168.0.1</td>
            <td>2 часа 35 минут</td>
        </tr>
    </tbody>
</table></-->
@stop

@section("scripts")
<script>
    $(".profile-change-email").dblclick(function () {
        $("#profile-change-email").show();
        $(this).hide();
    });

    $('.profile-change-email-input').on('keydown',function(e) {
        if (e.keyCode == 13) {
            $("#profile-change-" + $(this).attr("data-type")).hide();
            $(".profile-change-email").show();

            var this_element = $(this);

            $.ajax({
                url: "/user",
                type: "POST",
                data: {change_email: true, name: "email", value: $(this).val()},
                success: function (data) {
                    data = JSON.parse(data);

                    switch (data.status) {
                        case "success":
                            $(".profile-change-email").html(this_element.val());
                            $(".profile-change-email").removeClass("empty");
                            fly_p("success", "На вашу старую почту отправленно сообщение для подтверждения изменения!");
                            break;

                        case "error":
                            fly_p("danger", data.error);
                            break;
                    }
                }
            });
        }
    });

    $(".profile-change").dblclick(function () {
        $("#profile-change-" + $(this).attr("data-type")).show();
        $(this).hide();
    });

    $('.profile-change-input').on('keydown',function(e) {
        if (e.keyCode == 13) {
            $("#profile-change-" + $(this).attr("data-type")).hide();
            $(".profile-change[data-type='"+ $(this).attr("data-type") +"']").show();

            var this_element = $(this);

            $.ajax({
                url: "/user",
                type: "POST",
                data: {pay_wallet: true, name: $(this).attr("data-type"), value: $(this).val()},
                success: function (data) {
                    data = JSON.parse(data);

                    switch (data.status) {
                        case "success":
                            $(".profile-change[data-type='"+ this_element.attr("data-type") +"']").html(this_element.val());
                            $(".profile-change[data-type='"+ this_element.attr("data-type") +"']").removeClass("empty");
                            fly_p("success", "Данные успешно сохранены!");
                            break;

                        case "error":
                            fly_p("danger", data.error);
                            break;
                    }
                }
            });
        }
    });
</script>
@stop