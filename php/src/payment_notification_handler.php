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

    if(isset($payment->transaction)) {
      $trx = $payment->transaction;
      $logger->debug("payment.transaction: ". print_r($trx, true));

    } else {
      $logger->debug("ERROR: payment has no transaction");
    }

  } else {

    $logger->debug("Not OK! payment status: ". $payment->status);

    $error = 'unknwon error';
    if($payment->transaction) {
      $error = $payment->transaction->error;
    }
    $logger->error("payment NOT successfull. Error:\n". print_r($error, true));

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