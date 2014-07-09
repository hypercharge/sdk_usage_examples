<?php
require_once 'init.php';

/*
  Transaction Notification example for async Transactions (not Payment, WPF or mobile)
  e.g. see transaction_create_ideal.php

  We recomment to use ngrok https://ngrok.com/ to be able to receive notifications at your local dev maschine.

  Register at ngork and download ngork.

  start the notification handler with local php http server
  $ php -S localhost:8080

  enable internet forwarding to localhost:8080
  $ ngrok 8080
*/
// $notification is an instance of Hypercharge\PaymentNotification
error_log("POST\n". print_r($_POST, true), 4);

$notification = Hypercharge\Transaction::notification($_POST);
if($notification->isVerified()) {
  $transaction = $notification->getTransaction();
  if($transaction->isApproved()) {

    error_log("transaction success". print_r($transaction, true), 4);
    ////////////////////////////////////////
    // implement your business logic here
    ////////////////////////////////////////

  } else {

    error_log("transaction NOT successfull". print_r($transaction, true), 4);
    ////////////////////////////////////////
    // check $transaction->status  and $transaction->error
    // implement your business logic here
    ////////////////////////////////////////

  }

  // http response.
  // Tell hypercharge the notification has been successfully processed
  // and ensure output ends here
  die( $notification->ack() );

} else {
  error_log("Signature invalid or message does not come from hypercharge.\n"
    ,"Check your configuration or notificatoin request origin. POST". print_r($notification, true), 4);
}