<?php
require_once 'init.php';

/*
  Payment Notification example for Payments (WPF or mobile)
  e.g. see wpf_create.php

  How you run the notification handler on your local maschine see README chapter "Notifications".
*/
$logger = new Hypercharge\PHPErrorLogLogger();
// uncomment if you want to see more low-level stuff
//Hypercharge\Config::setLogger($logger);

$logger->debug("POST:\n". print_r($_POST, true));

// $notification is an instance of Hypercharge\PaymentNotification
$notification = Hypercharge\Payment::notification($_POST);
if($notification->isVerified()) {
  $payment = $notification->getPayment();
  if($payment->isApproved()) {

    $logger->debug("OK, payment status: ". $payment->status);

    // implement your business logic here

    // If $payment doesn't provide enough infos, you can get further details with the Transaction.
    // $notification->getTransaction() returns the transaction which has triggered the notification -
    // as $payment->transactions can contain multiple Transactions. In most cases this is the the transaction of interest here.
    if($notification->hasTransaction()) {
      $trx = $notification->getTransaction();
      $logger->debug("notifiaction transaction: ". print_r($trx, true));
    } else {
      $logger->debug("ERROR: notification has no transaction");
    }

  } else {

    $logger->debug("Not OK! payment status: ". $payment->status);

    $error = 'unknwon error';
    if($notification->hasTransaction()) {
      $error = $notification->getTransaction()->error;
    }
    $logger->error("payment NOT successfull. Error: ". print_r($error, true));

    // implement your business logic here


  }

  // http response.
  // Tell hypercharge the notification has been successfully processed
  // and ensure output ends here
  die( $notification->ack() );

} else {
  $logger->error("Signature invalid or message does not come from hypercharge.\n"
    ,"Check your configuration or notificatoin request origin. POST:\n". print_r($notification, true));
}