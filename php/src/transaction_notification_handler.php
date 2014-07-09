<?php
require_once 'init.php';

/*
  Transaction Notification handler example for async Transactions (sale3d, ideal_sale, ... )
  e.g. see transaction_create_ideal.php

  How you run the notification handler on your local maschine see README chapter "Notifications".
*/
$logger = new Hypercharge\PHPErrorLogLogger();
// uncomment if you want to see more low-level stuff
//Hypercharge\Config::setLogger($logger);

$logger->debug("POST:\n". print_r($_POST, true));

// $notification is an instance of Hypercharge\TransactionNotification
$notification = Hypercharge\Transaction::notification($_POST);
if($notification->isVerified()) {
  $transaction = $notification->getTransaction();
  if($transaction->isApproved()) {

    $logger->debug("OK, transaction status: ". print_r($transaction->status, true));
    $logger->error("transaction: ". print_r($transaction, true));

    // implement your business logic here

  } else {

    $logger->error("Not OK! transaction status: ". $transaction->status);
    $logger->error("transaction: ". print_r($transaction, true));

    // implement your business logic here

  }

  // http response.
  // Tell hypercharge the notification has been successfully processed
  // and ensure output ends here
  die( $notification->ack() );

} else {
  $logger->error("Signature invalid or message does not come from hypercharge.\n"
    ,"Check your configuration or notificatoin request origin. POST". print_r($notification, true));
}