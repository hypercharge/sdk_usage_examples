<?php
require_once 'init.php';

function create_pwf_payment() {
	Hypercharge\Config::setLogger(new Hypercharge\StdoutLogger());

	echo "\ncreate wpf payment ...";

  // see credentials.json
  $myShopUrl = HyperchargeCredentials::getMyShopBaseUrl();

	$data = array(
	  'amount'             => 15000
	  ,'currency'           => 'EUR'
	  ,'transaction_id'     => '0AF671AF-4134-4BE7-BDF0-26E38B74106E'
	  ,'usage'              => 'www.shoes.com, Order 12345'
	  ,'description'        => 'Du kaufst 3 Paar Schuhe auf www.shoes.com.'
	  ,'notification_url'   => "$myShopUrl/payment_notification_handler.php"
	  ,'return_success_url' => "$myShopUrl/success.html"
	  ,'return_failure_url' => "$myShopUrl/failure.html"
	  ,'return_cancel_url'  => "$myShopUrl/canceled.html"
	  ,'customer_email' => 'andre_ringkobing@gmx.de'
	  ,'customer_phone' => '089/1234567890'
	  ,'billing_address' => array(
	    'first_name' =>'André'
	    ,'last_name'  =>'Ringkøbing'
	    ,'address1'   =>'März Str. 12'
	    ,'zip_code'   =>'80111'
	    ,'city'       =>'München'
	    ,'country'    =>'DE'
    )
	);

	try{
	  $payment = Hypercharge\Payment::wpf($data);

	  echo "done\n";
	  print_r($payment);

	  $cmd = 'open '.$payment->getRedirectUrl('de');
	  echo "\nopen wpf in browser ... ", $cmd, "\n";
	  `$cmd`;


	}catch(Hypercharge\Errors\Error $e){
	  echo "\nERROR!\n";
	  print_r($e);
	}
}

create_pwf_payment();