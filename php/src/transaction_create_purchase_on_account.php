<?php
require_once 'init.php';

function purchase_on_account() {

  $data = array(
    'transaction_id' => '14',
    'remote_ip' => '123.54.31.3',
    'amount' => 1999,
    'currency' => 'USD',
    'customer_email' => 'mg@gmail.com',
    'billing_address' => array(
      'first_name' => 'Michael',
      'last_name' => 'Großmühl',
      'address1' => 'Igelweg 5',
      'zip_code' => '65128',
      'city' => 'Rüsselsheim',
      'country' => 'DE'
    ),
    'shipping_address' => array(
      'first_name' => 'Michael',
      'last_name' => 'Großmühl',
      'address1' => 'Igelweg 5',
      'zip_code' => '65128',
      'city' => 'Rüsselsheim',
      'country' => 'DE'
    )
  );

  try {
    $transaction = Hypercharge\Transaction::purchase_on_account(HyperchargeCredentials::getChannelToken(), $data);

    echo $transaction;

    echo "\npurchase_on_account Transaction\n"
      ,"  status unique_id amount currency type status:\n\n";

    echo ($transaction->isApproved() ? '  ' : ' !')
      ,' ',sprintf('%15s', $transaction->status)
      ,' ',$transaction->unique_id
      ,' ',$transaction->currency
      ,' ',sprintf('%.2f', $transaction->amount / 100)
      ,' ',$transaction->getType()
      ,"\n";
  } catch(\Exception $e) {
    print_r($e->errors);
  }
}

purchase_on_account();
