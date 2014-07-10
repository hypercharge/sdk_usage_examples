<?php
require_once 'init.php';

function reconcile() {

  Hypercharge\Config::setLogger(new Hypercharge\StdoutLogger());

  $payment = Hypercharge\Payment::find('0097c5fcb51d69489f750aba70293fcc');
  if($payment->isFatalError()) {
    echo "ERROR: ", $payment->error ,"\n";
  } else {
    echo "OK   : ", $payment, "\n";
  }
}

reconcile();
