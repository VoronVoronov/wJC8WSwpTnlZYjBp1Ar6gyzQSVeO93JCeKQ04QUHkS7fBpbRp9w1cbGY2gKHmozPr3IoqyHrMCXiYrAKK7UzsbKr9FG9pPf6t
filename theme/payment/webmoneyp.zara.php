<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8" name="robots" content="none">
</head>
<body>

<form id=pay name=pay method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp" accept-charset="utf-8">
    <p>Redirect to webmoney</p>
    <p>
        <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{{ $sum }}">
        <input type="hidden" name="LMI_PAYMENT_DESC" value="Оплата счета №{{ $payment['donation_id'] }}">
        <input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="{{ $desc }}">
        <input type="hidden" name="LMI_PAYMENT_NO" value="{{ $payment['donation_id'] }}">
        <input type="hidden" name="LMI_PAYEE_PURSE" value="{{ $webmoneyp }}">
        <input type="hidden" name="LMI_PAYMENTFORM_SIGN" value="{{ hash('sha256', $webmoneyp.';'.$sum.';'.$payment['donation_id'].';UoPyhd5I7XI2WSuvPIBkHVI1;') }}">
    <p>
</form>

<script language="JavaScript">
    document.pay.submit();
</script>

</body>
</html>