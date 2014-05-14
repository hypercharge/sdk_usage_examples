<?php
require_once 'init.php';

function reconcile() {
	//Hypercharge\Config::setLogger(new Hypercharge\StdoutLogger());

	$transaction = Hypercharge\Transaction::find(
										HyperchargeCredentials::getChannelToken()
										,'5135d1c8f7bb29e109e03b27faaaaaaa' // unique_id: valid format but transaction doesn't exist
	);
	if($transaction->isFatalError()) {
		echo $transaction->error ,"\n";
	}
}

reconcile();