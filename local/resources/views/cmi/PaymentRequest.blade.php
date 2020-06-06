<html>

<head>

<title>3D PAY HOSTING</title>

<meta http-equiv="Content-Language" content="tr">


<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9">


<meta http-equiv="Pragma" content="no-cache">


<meta http-equiv="Expires" content="now">


</head>


<body  onload="javascript:moveWindow()">

	<?php
	
		$orgClientId  =   "600001364";
  		$orgAmount = $DATA["AMOUNT"];
  		$orgOkUrl =  route("checkout.success");
  		$orgFailUrl = route("checkout.fail");
  		$shopurl = route("checkout.cancel");
  		$orgTransactionType = "PreAuth";
  		$orgRnd =  microtime();
  		$orgCallbackUrl = "https://localhost/benson/cmi/callback.php";
  		$orgCurrency = "504";
		
	?>



		<form name="pay_form" method="post" action="cmi/SendData.php" hidden>
			<table>
				<tr>

					<td align="center" colspan="2"><input type="submit"
						value="Complete Payment" /></td>
				</tr>

			</table>
				<input type="text" name="clientid" value="<?php echo $orgClientId ?>"> 
				<input type="text" name="amount" value="<?php echo $orgAmount ?>">
				<input type="text" name="okUrl" value="<?php echo $orgOkUrl ?>">
				<input type="text" name="failUrl" value="<?php echo $orgFailUrl ?>">
				<input type="text" name="TranType" value="<?php echo $orgTransactionType ?>">
				<input type="text" name="callbackUrl" value="<?php echo $orgCallbackUrl ?>">
				<input type="text" name="shopurl" value="<?php echo $shopurl ?>">
				<input type="text" name="currency" value="{{$DATA["CURRENCY_CODE"]}}">
				<input type="text" name="rnd" value="<?php echo $orgRnd ?>">
				<input type="text" name="storetype" value="3D_PAY_HOSTING">
				<input type="text" name="hashAlgorithm" value="ver3">
				<input type="text" name="lang" value="{{$DATA["LANGUAGE"]}}">
				<input type="text" name="refreshtime" value="5">
				<input type="text" name="BillToName" value="{{$DATA["CUSTOMER_LASTNAME"]}} {{$DATA["CUSTOMER_FIRSTNAME"]}}">
				<input type="text" name="BillToCompany" value="{{$DATA["CUSTOMER_LASTNAME"]}}">
				<input type="text" name="BillToStreet1" value="{{$DATA["CUSTOMER_ADDRESS"]}}">
				<input type="text" name="BillToCity" value="{{$DATA["CUSTOMER_CITY"]}}">
				<input type="text" name="BillToStateProv" value="{{$DATA["CUSTOMER_STATE"]}}">
				<input type="text" name="BillToPostalCode" value="{{$DATA["CUSTOMER_ZIPCODE"]}}">
				<input type="text" name="BillToCountry" value="{{$DATA["CUSTOMER_COUNTRY"]}}">
				<input type="text" name="email" value="{{$DATA["CUSTOMER_EMAIL"]}}">
				<input type="text" name="tel" value="{{$DATA["CUSTOMER_PHONE"]}}">
				<input type="text" name="encoding" value="UTF-8">
				<input type="text" name="oid" value="{{$DATA["ORDER_ID"]}}"> <!-- La valeur du paramètre oid doit être unique par transaction -->
				
		</form>


</body>
<script type="text/javascript" language="javascript">
	function moveWindow() {
	   document.pay_form.submit();
	}
</script>
</html>
