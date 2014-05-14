<?php
require_once 'init.php';

function sale() {
	Hypercharge\Config::setLogger(new Hypercharge\StdoutLogger());

	$data = array(
    'transaction_id'=>'your-shop-order-id-43671',
    'usage'=>'40208 concert tickets',
    'remote_ip'=>'245.253.2.12',
    'amount'=>5000,
    'currency'=>'USD',
    'card_holder'=>'Emil Example',
    'card_number'=>'4200000000000000',
    'cvv'=>'ARGH!',
    'expiration_month'=>'2',
    'expiration_year'=>'2015',
    'customer_email'=>'emil@example.com',
    'customer_phone'=>'+49301234567',
    'billing_address' => array(
      'first_name' =>'Max',
      'last_name' =>'Mustermann',
      'address1' =>'Muster Str. 12',
      'zip_code' =>'10178',
      'city' =>'Berlin',
      'country' =>'DE'
    )
	);

  try {

  	$transaction = Hypercharge\Transaction::sale(HyperchargeCredentials::getChannelToken(), $data);

  	echo " should not be reached! ", $transaction, "\n";

  } catch(Hypercharge\Errors\ValidationError $e) {
    // ValidationError has a __toString() method
    echo $e, "\n";
    echo "errors:\n";
    print_r($e->errors);
  }
}

sale();
