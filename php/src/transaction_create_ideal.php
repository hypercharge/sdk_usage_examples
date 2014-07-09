<?php
require_once 'init.php';

/*
  This is a short example to give you an idea about how ideal_sale transaction works.

  ideal_sale is async you need a transaction notification handler to implement the whole ideal_sale workflow.
  see transaction_notification_handler.php
*/

function create_ideal_transaction() {
  Hypercharge\Config::setLogger(new Hypercharge\StdoutLogger());

  echo "\ncreate ideal transaction ...";

  // see credentials.json
  $myShopUrl = HyperchargeCredentials::getMyShopBaseUrl();

  $data = array(
    "transaction_id"      => "145236",
    "notification_url"    => "$myShopUrl/transaction_notification_handler.php",
    "return_success_url"  => "$myShopUrl/success.html",
    "return_failure_url"  => "$myShopUrl/failure.html",
    "bank_name"           => "RABOBANK",
    "bank_account_holder" => "Thomas van der Landen",
    "bank_account_number" => "1290701",
    "bank_number"         => "20050550",
    "amount"              => 5000,
    "currency"            => "USD",  // TODO set to your channel currency. It's maybe "EUR"
    "customer_email"      => "thomas@example.com",
    "remote_ip"           => "123.123.123.123",
    "billing_address"     => array(
      "first_name" => "Thomas",
      "last_name"  => "van der Landen",
      "address1"   => "Boschdijk 1092",
      "zip_code"   => "5631 AV",
      "city"       => "Eindhoven",
      "country"    => "NL"
    )
  );

  try{
    $transaction = Hypercharge\Transaction::ideal_sale(HyperchargeCredentials::getChannelToken(), $data);

    echo "done. Transaction:\n";
    print_r($transaction);

    if($transaction->shouldRedirect()) {

      // only for cli use on OSX: open ideal page in browser.
      // In sandbox it's a bogus ideal page
      $cmd = 'open '.$transaction->redirect_url;
      echo "\nopen wpf in browser ... ", $cmd, "\n";
      `$cmd`;

      // in real (Webserver-Browser environment) you would redirect the customer's browser to ideal:
      //header('Location: '. $transaction->redirect_url);

    } else {
      echo "\nERROR! redirect expected\n";
    }

  }catch(Hypercharge\Errors\Error $e){
    echo "\nERROR!\n";
    print_r($e);
  }
}

create_ideal_transaction();