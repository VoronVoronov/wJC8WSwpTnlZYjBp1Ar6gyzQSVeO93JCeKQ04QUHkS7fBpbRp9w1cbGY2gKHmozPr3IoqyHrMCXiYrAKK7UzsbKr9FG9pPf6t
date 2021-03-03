<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" name="robots" content="none">
    <title>Прием платежей</title>
 <link rel="shortcut icon" href="/favicon.ico">
     <link rel="stylesheet" href="https://mjstc.ru/pay/style/bill.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style>
	    a.paysystem {
		    display: inline-block;
		    width: 30%;
		    cursor: pointer;
		    margin: 0px 5px;
		}

		a.item-paysystem {
		        display: inline-block;
			    width: auto;
			    cursor: pointer;
			    margin: 0px 5px;
			    outline: 1px solid #DFDFDF;
			    border-radius: 15px;
			    margin-bottom: 15px;
		}

		.checkout-billing-header{ margin: 0 -20px; }
		.checkout-billing{ padding: 0 0px }

		.clear {
			clear: both;
		}
		        /* свойства модального окна по умолчанию */
        .modal {
            position: fixed; /* фиксированное положение */
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.5); /* цвет фона */
            z-index: 1050;
            opacity: 0; /* по умолчанию модальное окно прозрачно */
            -webkit-transition: opacity 400ms ease-in;
            -moz-transition: opacity 400ms ease-in;
            transition: opacity 400ms ease-in; /* анимация перехода */
            pointer-events: none; /* элемент невидим для событий мыши */
        }

        /* при отображении модального окно */
        .modal:target {
            opacity: 1;
            pointer-events: auto;
            overflow-y: auto;
        }

        /* ширина модального окна и его отступы от экрана */
        .modal-dialog {
            position: relative;
            width: auto;
            margin: 10px;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 500px;
                margin: 30px auto;
            }
        }

        /* свойства для блока, содержащего контент модального окна */
        .modal-content {
            position: relative;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            background-color: #fff;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: .3rem;
            outline: 0;
        }

        @media (min-width: 768px) {
            .modal-content {
                -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
                box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
            }
        }

        /* свойства для заголовка модального окна */
        .modal-header {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 15px;
            border-bottom: 1px solid #eceeef;
        }

        .modal-title {
            margin-top: 0;
            margin-bottom: 0;
            line-height: 1.5;
            font-size: 1.25rem;
            font-weight: 500;
        }

        /* свойства для кнопки "Закрыть" */
        .close {
            float: right;
            font-family: sans-serif;
            font-size: 24px;
            font-weight: 700;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            opacity: .5;
            text-decoration: none;
        }

        /* свойства для кнопки "Закрыть" при нахождении её в фокусе или наведении */
        .close:focus, .close:hover {
            color: #000;
            text-decoration: none;
            cursor: pointer;
            opacity: .75;
        }

        /* свойства для блока, содержащего основное содержимое окна */
        .modal-body {
            position: relative;
            -webkit-box-flex: 1;
            -webkit-flex: 1 1 auto;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 15px;
            overflow: auto;
        }
	</style>
</head>
	<body>
	<div id="dev-app">
		<div class="checkout">

      <header class="checkout-header">
        <div class="checkout-guarantee">
          <div class="icon icon-security">
          <a href="https://www.sslshopper.com/ssl-checker.html#hostname=ipdonate.com" target="_blank"><i class="fa fa-lock fa-3x"></i></a>
          </div>
          <span>
            Гарантируем безопасность платежа и сохранность ваших личных данных
          </span>
        </div>
      </header>

			<div data-reactid=".0.1:2">
				<section class="checkout-section">
					<div class="checkout-section-wrap">
						<div class="checkout-carrier-info">
							<div class="checkout-carrier">
								<h1 class="checkout-carrier-title"></h1>

								<div class="checkout-carrier-amount">
									<span class="checkout-currency">
										<span>{{ $payment['donation_ammount'] }}</span>
										<span></span>
										<i class="fa fa-rub"></i>
									</span>
								</div>
							</div>
						</div>

						<div class="checkout-sep"></div>
                        @if($payment['donation_status'] == 0)
						<div class="checkout-billing">
							<div class="checkout-billing-header">
								<a href="#webmoneyPModal" class="item-paysystem"><img src="/assets/images/webmoneyp.png"></a>
                                <a href="#webmoneyRModal" class="item-paysystem"><img src="/assets/images/webmoneyr.png"></a>
                                <a href="#webmoneyEModal" class="item-paysystem"><img src="/assets/images/webmoneye.png"></a>
                                <a href="#webmoneyZModal" class="item-paysystem"><img src="/assets/images/webmoneyz.png"></a>
                                <a href="#webmoneyKModal" class="item-paysystem"><img src="/assets/images/webmoneyk.png"></a>
                                <a href="#webmoneyBModal" class="item-paysystem"><img src="/assets/images/webmoneyb.png"></a>
								<a href="#yandexModal" class="item-paysystem"><img src="/assets/images/yoomoney.png"></a>
								<a href="#qiwiModal" class="item-paysystem"><img src="/assets/images/qiwi.png"></a>
								<a href="#cardModal" class="item-paysystem"><img src="/assets/images/visa.jpg"></a>
								<a href="#mtsModal" class="item-paysystem"><img src="/assets/images/mts.png"></a>
								<a href="#tele2Modal" class="item-paysystem"><img src="/assets/images/tele2.png"></a>
								<a href="#beelineModal" class="item-paysystem"><img src="/assets/images/beeline.png"></a>
                                @if($paypal->on == 1)
                                <a href="#paypalModal" class="item-paysystem"><img src="/assets/images/paypal.png"></a>
                                @endif
							</div>

							<div class="checkout-hr"></div>
							<div class="checkout-billing-content">
								<div class="checkout-billing-content-field checkout-billing-content-total">
									<div class="checkout-billing-content-title">
										<span>Сумма к оплате*</span>
									</div>
									<div class="checkout-billing-content-amount">
										<span class="checkout-currency">
											<span>{{ $payment['donation_ammount'] }}</span>
											<span> </span>
											<i class="fa fa-rub"></i>
										</span>
									</div>
								</div>
									<p class="checkout-carrier-text">Сумма указана без учета комиссии платежных систем</p>
							</div>

						</div>
                        @else
                        <div class="checkout-billing">
                            <div class="checkout-billing-header">                        
                                <center>ПЛАТЁЖ УЖЕ ОПЛАЧЕН</center>
                            </div>
                        </div>
                        @endif
					</div>
				</section>
			</div>
		</div>
	</div> 
	    <!--<div id="webmoneyPModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">E-mail адрес</h3>
                    <a href="#close" title="Close" class="close">×</a>
                </div>
                <div class="modal-body">
                    <form action="https://merchant.webmoney.ru/lmi/payment_utf.asp" accept-charset="utf-8" method="post">
                    	<center>
                            <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{{ $payment['donation_ammount'] }}">
                            <input type="hidden" name="LMI_PAYMENT_DESC" value="Оплата счета №{{ $payment['donation_id'] }}">
                            <input type="hidden" name="LMI_PAYMENT_NO" value="{{ $payment['donation_id'] }}">
                            <input type="hidden" name="LMI_PAYEE_PURSE" value="{{ $webmoneyp }}">
                            <input type="hidden" name="LMI_PAYMENTFORM_SIGN" value="{{ hash('sha256', $webmoneyp.';'.$payment['donation_ammount'].';'.$payment['donation_id'].';UoPyhd5I7XI2WSuvPIBkHVI1;') }}">
                            <p><input type="text" class="input-text" style="margin-right: 10px;" name="LMI_PAYMER_EMAIL" id="LMI_PAYMER_EMAIL" placeholder="Ваш e-mail адрес"></p><br>
                        	<p><input class="btn btn-default" type="submit"></p>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        </div>-->
        <div id="webmoneyRModal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">E-mail адрес</h3>
                        <a href="#close" title="Close" class="close">×</a>
                    </div>
                    <div class="modal-body">
                        <form action="https://merchant.webmoney.ru/lmi/payment_utf.asp" accept-charset="utf-8" method="post">
                            <center>
                                <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{{ $payment['donation_ammount'] }}">
                                <input type="hidden" name="LMI_PAYMENT_DESC" value="Оплата счета №{{ $payment['donation_id'] }}">
                                <input type="hidden" name="LMI_PAYMENT_NO" value="{{ $payment['donation_id'] }}">
                                <input type="hidden" name="LMI_PAYEE_PURSE" value="{{ $webmoneyr }}">
                                <input type="hidden" name="LMI_PAYMENTFORM_SIGN" value="{{ hash('sha256', $webmoneyr.';'.$payment['donation_ammount'].';'.$payment['donation_id'].';30F35089-3BFB-4915-898A;') }}">
                                <p><input type="text" class="input-text" style="margin-right: 10px;" name="LMI_PAYMER_EMAIL" id="LMI_PAYMER_EMAIL" placeholder="Ваш e-mail адрес"></p><br>
                                <p><input class="btn btn-default" type="submit"></p>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="webmoneyBModal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">E-mail адрес</h3>
                        <a href="#close" title="Close" class="close">×</a>
                    </div>
                    <div class="modal-body">
                        <form action="https://merchant.webmoney.ru/lmi/payment_utf.asp" accept-charset="utf-8" method="post">
                            <center>
                                <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{{ $payment['donation_ammount'] }}">
                                <input type="hidden" name="LMI_PAYMENT_DESC" value="Оплата счета №{{ $payment['donation_id'] }}">
                                <input type="hidden" name="LMI_PAYMENT_NO" value="{{ $payment['donation_id'] }}">
                                <input type="hidden" name="LMI_PAYEE_PURSE" value="{{ $webmoneyb }}">
                                <input type="hidden" name="LMI_PAYMENTFORM_SIGN" value="{{ hash('sha256', $webmoneyb.';'.$payment['donation_ammount'].';'.$payment['donation_id'].';UoPyhd5I7XI2WSuvPIBkHVI1;') }}">
                                <p><input type="text" class="input-text" style="margin-right: 10px;" name="LMI_PAYMER_EMAIL" id="LMI_PAYMER_EMAIL" placeholder="Ваш e-mail адрес"></p><br>
                                <p><input class="btn btn-default" type="submit"></p>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="webmoneyEModal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">E-mail адрес</h3>
                        <a href="#close" title="Close" class="close">×</a>
                    </div>
                    <div class="modal-body">
                        <form action="https://merchant.webmoney.ru/lmi/payment_utf.asp" accept-charset="utf-8" method="post">
                            <center>
                                <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{{ $payment['donation_ammount'] }}">
                                <input type="hidden" name="LMI_PAYMENT_DESC" value="Оплата счета №{{ $payment['donation_id'] }}">
                                <input type="hidden" name="LMI_PAYMENT_NO" value="{{ $payment['donation_id'] }}">
                                <input type="hidden" name="LMI_PAYEE_PURSE" value="{{ $webmoneye }}">
                                <input type="hidden" name="LMI_PAYMENTFORM_SIGN" value="{{ hash('sha256', $webmoneye.';'.$payment['donation_ammount'].';'.$payment['donation_id'].';UoPyhd5I7XI2WSuvPIBkHVI1;') }}">
                                <p><input type="text" class="input-text" style="margin-right: 10px;" name="LMI_PAYMER_EMAIL" id="LMI_PAYMER_EMAIL" placeholder="Ваш e-mail адрес"></p><br>
                                <p><input class="btn btn-default" type="submit"></p>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="webmoneyKModal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">E-mail адрес</h3>
                        <a href="#close" title="Close" class="close">×</a>
                    </div>
                    <div class="modal-body">
                        <form action="https://merchant.webmoney.ru/lmi/payment_utf.asp" accept-charset="utf-8" method="post">
                            <center>
                                <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{{ $payment['donation_ammount'] }}">
                                <input type="hidden" name="LMI_PAYMENT_DESC" value="Оплата счета №{{ $payment['donation_id'] }}">
                                <input type="hidden" name="LMI_PAYMENT_NO" value="{{ $payment['donation_id'] }}">
                                <input type="hidden" name="LMI_PAYEE_PURSE" value="{{ $webmoneyk }}">
                                <input type="hidden" name="LMI_PAYMENTFORM_SIGN" value="{{ hash('sha256', $webmoneyk.';'.$payment['donation_ammount'].';'.$payment['donation_id'].';UoPyhd5I7XI2WSuvPIBkHVI1;') }}">
                                <p><input type="text" class="input-text" style="margin-right: 10px;" name="LMI_PAYMER_EMAIL" id="LMI_PAYMER_EMAIL" placeholder="Ваш e-mail адрес"></p><br>
                                <p><input class="btn btn-default" type="submit"></p>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="webmoneyZModal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">E-mail адрес</h3>
                        <a href="#close" title="Close" class="close">×</a>
                    </div>
                    <div class="modal-body">
                        <form action="https://merchant.webmoney.ru/lmi/payment_utf.asp" accept-charset="utf-8" method="post">
                            <center>
                                <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{{ $payment['donation_ammount'] }}">
                                <input type="hidden" name="LMI_PAYMENT_DESC" value="Оплата счета №{{ $payment['donation_id'] }}">
                                <input type="hidden" name="LMI_PAYMENT_NO" value="{{ $payment['donation_id'] }}">
                                <input type="hidden" name="LMI_PAYEE_PURSE" value="{{ $webmoneyz }}">
                                <input type="hidden" name="LMI_PAYMENTFORM_SIGN" value="{{ hash('sha256', $webmoneyz.';'.$payment['donation_ammount'].';'.$payment['donation_id'].';UoPyhd5I7XI2WSuvPIBkHVI1;') }}">
                                <p><input type="text" class="input-text" style="margin-right: 10px;" name="LMI_PAYMER_EMAIL" id="LMI_PAYMER_EMAIL" placeholder="Ваш e-mail адрес"></p><br>
                                <p><input class="btn btn-default" type="submit"></p>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	    <div id="yandexModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">E-mail адрес</h3>
                    <a href="#close" title="Close" class="close">×</a>
                </div>
                <div class="modal-body">
                    <form action="/pay/yoomoney/{{ $payment['donation_id'] }}" method="post">
                    	<center>
                            <p><input type="text" class="input-text" style="margin-right: 10px;" name="email" id="email" placeholder="Ваш e-mail адрес"></p><br>
                        	<p><input class="btn btn-default" type="submit"></p>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <div id="webmoneyPModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">E-mail адрес</h3>
                    <a href="#close" title="Close" class="close">×</a>
                </div>
                <div class="modal-body">
                    <form action="/pay/webmoneyp/{{ $payment['donation_id'] }}" method="post">
                        <center>
                            <p><input type="text" class="input-text" style="margin-right: 10px;" name="email" id="email" placeholder="Ваш e-mail адрес"></p><br>
                            <p><input type="text" class="input-text" style="margin-right: 10px;" name="to" id="to" placeholder="Ваш QIWI кошелек" value="+"></p><br>
                            <p><input class="btn btn-default" type="submit"></p>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <div id="cardModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">E-mail адрес</h3>
                    <a href="#close" title="Close" class="close">×</a>
                </div>
                <div class="modal-body">
                    <form action="/pay/card/{{ $payment['donation_id'] }}" method="post">
                        <center>
                            <p><input type="text" class="input-text" style="margin-right: 10px;" name="email" id="email" placeholder="Ваш e-mail адрес"></p><br>
                            <p><input class="btn btn-default" type="submit"></p>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <div id="mtsModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">E-mail адрес</h3>
                    <a href="#close" title="Close" class="close">×</a>
                </div>
                <div class="modal-body">
                    <form action="/pay/mts/{{ $payment['donation_id'] }}" method="post">
                        <center>
                            <p><input type="text" class="input-text" style="margin-right: 10px;" name="email" id="email" placeholder="Ваш e-mail адрес"></p><br>
                            <p><input class="btn btn-default" type="submit"></p>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <div id="tele2Modal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">E-mail адрес</h3>
                    <a href="#close" title="Close" class="close">×</a>
                </div>
                <div class="modal-body">
                    <form action="/pay/tele2/{{ $payment['donation_id'] }}" method="post">
                        <center>
                            <p><input type="text" class="input-text" style="margin-right: 10px;" name="email" id="email" placeholder="Ваш e-mail адрес"></p><br>
                            <p><input class="btn btn-default" type="submit"></p>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <div id="beelineModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">E-mail адрес</h3>
                    <a href="#close" title="Close" class="close">×</a>
                </div>
                <div class="modal-body">
                    <form action="/pay/beeline/{{ $payment['donation_id'] }}" method="post">
                        <center>
                            <p><input type="text" class="input-text" style="margin-right: 10px;" name="email" id="email" placeholder="Ваш e-mail адрес"></p><br>
                            <p><input class="btn btn-default" type="submit"></p>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        </div>
        @if($paypal->on == 1)
        <div id="paypalModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">E-mail адрес</h3>
                    <a href="#close" title="Close" class="close">×</a>
                </div>
                <div class="modal-body">
                    <form action="https://www.sandbox.paypal.com/cgi-bin/websc" method="post">
                        <center>
                            <input type="hidden" name="cmd" value="_xclick" />
                            <input type="hidden" name="amount" value="{{ $payment['donation_ammount'] }}" />
                            <input type="hidden" name="charset" value="utf-8" />
                            <input type="hidden" name="business" value="{{ $paypal->email }}" />
                            <input type="hidden" name="item_name" value="Оплата счета №{{ $payment['donation_id'] }}" />
                            <input type="hidden" name="currency_code" value="RUB" />
                            <input type="hidden" name="no_shipping" value="1">
                            <input type="hidden" name="notify_url" value="https://ipdonate.com/result.php?payment=handlerPaypal" />
                            <input type="hidden" name="item_number" value="{{ $payment['donation_id'] }}">
                            <input type="hidden" name="rm" value="2">
                            <input type="hidden" name="invoice" value="{{ $payment['donation_id'].'-'.hash('sha256', $payment['donation_id'].$payment['donation_ammount'].$payment['donation_create_time']).'-'.$payment['user_id'] }}">
                            <p><input type="text" class="input-text" style="margin-right: 10px;" name="email" id="email" placeholder="Ваш e-mail адрес"></p><br>
                            <p><input class="btn btn-default" type="submit"></p>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        </div>
        @endif
	</body>
</html>