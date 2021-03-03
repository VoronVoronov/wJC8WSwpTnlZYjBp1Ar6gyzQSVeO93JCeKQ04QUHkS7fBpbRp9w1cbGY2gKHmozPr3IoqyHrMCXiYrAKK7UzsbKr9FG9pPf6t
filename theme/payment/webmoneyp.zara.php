<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="shortcut icon" href="/static/img/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta content="text/html; charset=windows-1251" http-equiv="Content-Type">
</head>
<body>

<form id=pay name=pay method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp">
    <p>Redirect to webmoney</p>
    <p>
        <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{{ $sum }}">
        <input type="hidden" name="LMI_PAYMENT_DESC" value="Оплата счета №{{ $payment['donation_id'] }}">
        <input type="hidden" name="LMI_PAYMENT_NO" value="{{ $payment['donation_id'] }}">
        <input type="hidden" name="LMI_PAYEE_PURSE" value="{{ $webmoneyp }}">
        <input type="hidden" name="LMI_PAYMENTFORM_SIGN" value="{{ hash('sha256', $webmoneyp.';'.$sum.';'.$payment['donation_id'].';UoPyhd5I7XI2WSuvPIBkHVI1;') }}">
    <p>
</form>

<script language="JavaScript">
    //document.pay.submit();
</script>

</body>
</html>