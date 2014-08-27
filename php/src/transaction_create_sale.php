<?php
require_once 'init.php';

function sale() {

	//Hypercharge\Config::setLogger(new Hypercharge\StdoutLogger());

	$data = array(
    'transaction_id'=>'your-shop-order-id-43671',
    'usage'=>'40208 concert tickets',
    'remote_ip'=>'245.253.2.12',
    'amount'=>5000,
    'currency'=>'USD',
    'card_holder'=>'Emil Example',
    'card_number'=>'4200000000000000',
    'cvv'=>'123',
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
    ),
    'shipping_address' => array(
      'first_name' =>'Lieferando GmbH',
      'last_name' =>'z.Hd. Hr. Mustermann',
      'address1' =>'Lieferstraße 7a',
      'zip_code' =>'10999',
      'city' =>'Berlin',
      'country' =>'DE'
    )
	);

	$transaction = Hypercharge\Transaction::sale(HyperchargeCredentials::getChannelToken(), $data);

	echo $transaction;

	echo "\nsale Transaction\n"
		,"  status unique_id amount currency type status:\n\n";

	echo ($transaction->isApproved() ? '  ' : ' !')
		,' ',sprintf('%15s', $transaction->status)
		,' ',$transaction->unique_id
		,' ',$transaction->currency
		,' ',sprintf('%.2f', $transaction->amount / 100)
		,' ',$transaction->getType()
		,"\n";
}

sale();
