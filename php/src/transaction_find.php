<?php
require_once 'init.php';

function reconcile() {

	Hypercharge\Config::setLogger(new Hypercharge\StdoutLogger());

	$transaction = Hypercharge\Transaction::find(
					HyperchargeCredentials::getChannelToken()
					,'5135d1c8f7bb29e109e03b27fe5d9f05'
	);
	if($transaction->isFatalError()) {
		echo "ERROR: ", $transaction->error ,"\n";
	} else {
		echo "OK   : ", $transaction, "\n";

	}
}

reconcile();
