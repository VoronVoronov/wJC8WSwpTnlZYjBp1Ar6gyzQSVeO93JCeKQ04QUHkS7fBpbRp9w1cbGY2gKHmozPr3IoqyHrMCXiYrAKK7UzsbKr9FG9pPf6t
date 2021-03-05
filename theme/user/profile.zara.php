@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Мой профиль</h2>
    <h3>@if(empty($user->user_last_stream_time)) 
        Вы еще не проводили стрим.
        @else
        Последний стрим: {{ date("d.m.Y", strtotime($user->user_last_stream_time))  }}
        @endif
    </h3>
    <div class="clear"></div>
</div>

<div class="profile-head">
    <div class="user-profile">
        <div class="user-left">
            <img src="{{ $user->user_avatar }}" class="profile-avatar">
            <i class="profile-status"></i>
            <div>
                <h3>{{ $user->user_login_show }}</h3>
            </div>
        </div>

        <div class="user-right">
            <div class="profile-stats-block">
                <p>Ваш баланс:</p>
                <b>{{ number_format($user->user_balance, 0, '', ' ') }}Р</b>
            </div>

            <div class="profile-stats-block">
                <p>Всего заработано:</p>
                <b>{{ number_format($user->user_all_balance, 0, '', ' ') }}Р</b>
            </div>

            <div class="profile-stats-block">
                <p>Время стримов:</p>
                <b>{{ number_format($user->user_stream_time, 0, '.', ' ') }}Ч</b>
            </div>
        </div>

        <div class="clear"></div>
    </div>

    <div class="user-info">
        <div class="user-left">
            <table>
                <!--<tr>
                    <td>Электронная почта</td>
                    <td id="profile-change-email" style="display: none;"><input type="text" class="form-control input-sm profile-change-email-input" placeholder="Укажите новый E-mail"></td>
                    <td class="profile-change-email @if(empty($user->user_email)) empty @endif" data-toggle="tooltip" data-placement="top" title="Для изменения кликните дважды">{{ $user->user_email or "Не указано" }}</td>
                </tr>-->
                <tr>
                    @if(empty($user->user_vk))
                    <td><i class="fa fa-vk"></i> Не подключено</td>
                    <td><a href="/connect/vk" class="btn btn-default btn-xs">Подключить</a></td>
                    @else
                    <td class="active"><i class="fa fa-vk"></i> Подключено</td>
                    <td><a href="" class="btn btn-danger btn-xs"></a></td>
                    <!--<td><a href="/disconnect/vk" class="btn btn-danger btn-xs">Отключить</a></td>-->
                    @endif
                </tr>
                <tr>
                    @if(empty($user->user_twitch))
                    <td><i class="fa fa-twitch"></i> Не подключено</td>
                    <td><a href="/connect/twitch" class="btn btn-default btn-xs">Подключить</a></td>
                    @else
                    <td class="active"><i class="fa fa-twitch"></i> Подключено</td>
                    <td><a href="" class="btn btn-danger btn-xs"></a></td>
                    <!--<td><a href="/disconnect/vk" class="btn btn-danger btn-xs">Отключить</a></td>-->
                    @endif
                </tr>
                <tr>
                    @if(empty($user->user_youtube))
                    <td><i class="fa fa-youtube"></i> Не подключено</td>
                    <td><a href="/connect/youtube" class="btn btn-default btn-xs">Подключить</a></td>
                    @else
                    <td class="active"><i class="fa fa-youtube"></i> Подключено</td>
                    <td><a href="" class="btn btn-danger btn-xs"></a></td>
                    <!--<td><a href="/disconnect/vk" class="btn btn-danger btn-xs">Отключить</a></td>-->
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
                <tr>
                    <td>Paypal</td>
                    <td><a href="/paypal" >Настроить</a></td>
                </tr>                 
            </table>
        </div>

        <div class="clear"></div>
    </div>
</div>

<table class="last-actions">
    <thead>
        <tr>
            <td>Дата</td>
            <td>IP</td>
			<td></td>
        </tr>
    </thead>
    <tbody>
        <!--<tr>
            <td>{{ date("d.m.y H:i:s",strtotime($user->user_last_login_time)) }}</td>
            <td>{{ $user->user_last_ip }}</td>
			<td></td>
        </tr>-->
        @foreach($ip as $item)        
        <tr>
            <td>{{ date("d.m.y H:i:s",strtotime($item['log_time'])) }}</td>
            <td>{{ $item['ip'] }}</td>
            <td></td>
        </tr>
            @endforeach
            @if(empty($ip))
            <center>Список пуст</center>
            @endif
    </tbody>
</table>
@stop
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>

<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 174659405, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>
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
                            fly_p("success", "На вашу почту отправленно сообщение для подтверждения изменения!");
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