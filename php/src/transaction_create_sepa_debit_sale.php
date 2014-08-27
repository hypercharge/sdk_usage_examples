<?php
require_once 'init.php';

function sepa_debit_sale() {

  Hypercharge\Config::setLogger(new Hypercharge\StdoutLogger());

  $data = array(
    "transaction_id"=>"145236",
    "wire_reference_id"=>"ABCD1234EF",
    "bank_account_holder"=>"Günther Pfröten",

    "iban"=>"DE18210501700012345678",
    "bic"=>"PBNKDEFF",
    "sepa_mandate_id"=>"1234567890abcdef",
    "sepa_mandate_signature_date"=>"2014-06-24",

    "usage"=>"40208 concert tickets",
    "remote_ip"=>"127.0.0.1",
    "amount"=>7701,
    "currency"=>"USD",
    "customer_email"=>"manfred.test@example.com",
    "customer_phone"=>"+49301234567",
    "billing_address"=>array(
      "first_name"=>"Günther",
      "last_name"=>"Pfröten",
      "address1"=>"Mühlenstraße 123",
      "zip_code"=>"12345",
      "city"=>"Berlin",
      "country"=>"DE"
    ),
    'shipping_address' => array(
      'first_name' =>'Lieferando GmbH',
      'last_name' =>'z.Hd. Hr. Mustermann',
      'address1' =>'Lieferstraße 7a',
      'zip_code' =>'10999',
      'city' =>'Berlin',
      'country' =>'DE'
    ),
    "risk_params"=>array(
      "birthday"=>"1968-04-01"
    )
  );

  $transaction = Hypercharge\Transaction::sepa_debit_sale(HyperchargeCredentials::getChannelToken(), $data);

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

sepa_debit_sale();
