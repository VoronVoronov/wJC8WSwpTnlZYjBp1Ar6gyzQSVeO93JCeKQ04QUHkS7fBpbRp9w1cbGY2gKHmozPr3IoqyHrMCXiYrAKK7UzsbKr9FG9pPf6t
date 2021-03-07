@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Настройка приема платежей</h2>
    <div class="clear"></div>
</div>

<form id="update-form" action="" method="POST">
    <div class="row">
        <div class="col-md-12">

        @if($user->user_group == 2)
            <!-- Tab panes -->
            <div class="tab-content" style="padding-top: 15px">
                <div role="tabpanel" class="tab-pane active" id="main">

                    <div class="row" style="margin-top: 10px"> <!-- Ваша страница -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            QIWI CallBack:
                        </div>
                        <div class="col-md-6">
                            <div id="url_change_url">
                                https://api.ipdonate.com/result?payment=QIWI</a>
                            </div>
                        </div>
                    </div> <!-- /Ваша страница -->

                    <div class="row" style="margin-top: 10px"> <!-- Минимальная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            QIWI кошелек:
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="wallets[qiwi]" value="{{ $wallets->qiwi }}">
                        </div>
                    </div> <!-- /Минимальная сумма -->

                    <div class="row" style="margin-top: 10px"> <!-- Минимальная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            QIWI Public key:
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="wallets[qiwi_public]" value="{{ $wallets->qiwi_public }}">
                        </div>
                    </div> <!-- /Минимальная сумма -->


                    <div class="row" style="margin-top: 10px"> <!-- Минимальная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            QIWI Secret key:
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="wallets[qiwi_secret]" value="{{ $wallets->qiwi_secret }}">
                        </div>
                    </div> <!-- /Минимальная сумма -->

                    <div class="row" style="margin-top: 10px"> <!-- Ваша страница -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            WebMoney CallBack:
                        </div>
                        <div class="col-md-6">
                            <div id="url_change_url">
                                https://api.ipdonate.com/result?payment=webmoney</a>
                            </div>
                        </div>
                    </div> <!-- /Ваша страница -->

                    <div class="row" style="margin-top: 10px"> <!-- Минимальная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            WebMoney кошелек:
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="wallets[webmoney]" value="{{ $wallets->webmoney }}">
                        </div>
                    </div> <!-- /Минимальная сумма -->

                    <div class="row" style="margin-top: 10px"> <!-- Минимальная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            WebMoney Secret key:
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="wallets[webmoney_secret]" value="{{ $wallets->webmoney_secret }}">
                        </div>
                    </div> <!-- /Минимальная сумма -->


                    <div class="row" style="margin-top: 10px"> <!-- Минимальная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            WebMoney Secret key X20:
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="wallets[webmoney_secret_x20]" value="{{ $wallets->webmoney_secret_x20 }}">
                        </div>
                    </div> <!-- /Минимальная сумма -->

                    <div class="row" style="margin-top: 10px"> <!-- Ваша страница -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            YooMoney CallBack:
                        </div>
                        <div class="col-md-6">
                            <div id="url_change_url">
                                https://api.ipdonate.com/result?payment=yoomoney</a>
                            </div>
                        </div>
                    </div> <!-- /Ваша страница -->

                    <div class="row" style="margin-top: 10px"> <!-- Указанная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Yoomoney:
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="wallets[yoomoney]" value="{{ $wallets->yoomoney }}">
                        </div>
                    </div> <!-- /Указанная сумма -->

                    <div class="row" style="margin-top: 10px"> <!-- Сообщение -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Yoomoney Secret Key:
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="wallets[yoomoney_secret]" value="{{ $wallets->yoomoney_secret }}">
                        </div>
                    </div> <!-- /Сообщение -->
                    <center> Необходимо добавить ссылку на обработчик платежей нашей системы, а также включить функцию "IPN messages" в <a href="https://www.paypal.com/cgi-bin/customerprofileweb?cmd=_profile-ipn-notify">настройках аккаунта</a> PayPal.</center>
                </div>
            </div>
            <div class="row" style="margin-top: 30px">
                <div class="form-group col-lg-12 text-center">
                    <hr>
                    <input type="submit" class="btn btn-success" value="Сохранить">
                </div>
            </div>
            @else
            <center>
                Для приёма пожертвовании на свои кошельки, необходимо оплатить тарифный план.<br>
                Стоимость - 499 рублей в месяц.<br>
                <a href="#" class="btn btn-danger">Оплатить</a><br>
                Услуга временно недоступна.<br>
            </center>
            @endif
        </div>
    </div>
</form>
@stop

@section("plugins-scripts")
<script src="/assets/js/jquery.form.js"></script>
@stop
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>

<div id="vk_community_messages"></div>
<script type="text/javascript">
    VK.Widgets.CommunityMessages("vk_community_messages", 190202028, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>
@section("scripts")
<script>

    $('#update-form').ajaxForm({
        url: location.href,
        dataType: 'text',
        success: function(data) {
            console.log(data);
            data = $.parseJSON(data);
            switch(data.status) {
                case 'error':
                    fly_p('danger', data.error);
                    $('button[type=submit]').prop('disabled', false);
                    break;
                case 'success':
                    fly_p("success", "Настройки успешно сохранены!");
                    break;
            }
        },
        beforeSubmit: function(arr, $form, options) {
            $('button[type=submit]').prop('disabled', true);
        }
    });
</script>
@stop