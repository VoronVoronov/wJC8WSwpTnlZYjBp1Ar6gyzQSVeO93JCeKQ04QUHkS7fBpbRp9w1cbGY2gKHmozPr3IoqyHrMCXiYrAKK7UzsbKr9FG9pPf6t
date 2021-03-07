@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Настройка приема Paypal</h2>
    <div class="clear"></div>
</div>

<form id="paypal-form" action="" method="POST">
    <div class="row">
        <div class="col-md-12">


            <!-- Tab panes -->
            <div class="tab-content" style="padding-top: 15px">
                <div role="tabpanel" class="tab-pane active" id="main">

                    <div class="row" style="margin-top: 10px"> <!-- Ваша страница -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            IPN:
                        </div>
                        <div class="col-md-6">
                            <div id="url_change_url">
                                <a href="https://www.paypal.com/cgi-bin/customerprofileweb?cmd=_profile-ipn-notify">{{ config()->url }}result.php?payment=handlerPaypal</a>
                            </div>
                        </div>
                    </div> <!-- /Ваша страница -->

                    <div class="row" style="margin-top: 10px"> <!-- Фиильтр матов -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Состояние:
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="paypal[on]">
                                <option value="1" @if($paypal->on == 1) selected @endif>Включен</option>
                                <option value="0" @if($paypal->on == 0) selected @endif>Выключен</option>
                            </select>
                        </div>
                    </div> <!-- /Фиильтр матов -->

                    <div class="row" style="margin-top: 10px"> <!-- Минимальная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Client ID:
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="paypal[clientid]" value="{{ $paypal->clientid }}">
                        </div>
                    </div> <!-- /Минимальная сумма -->

                    <div class="row" style="margin-top: 10px"> <!-- Указанная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Secret:
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="paypal[secret]" value="{{ $paypal->secret }}">
                        </div>
                    </div> <!-- /Указанная сумма -->

                    <div class="row" style="margin-top: 10px"> <!-- Сообщение -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Email:
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="paypal[email]" value="{{ $paypal->email }}">
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
        </div>
    </div>
</form>
@stop

@section("plugins-scripts")
<script src="/assets/js/jquery.form.js"></script>
@stop
@section("scripts")
<script>
    
    $('#paypal-form').ajaxForm({
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