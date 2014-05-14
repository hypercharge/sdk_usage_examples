<?php
require_once 'init.php';

function reconcile_by_date() {
	Hypercharge\Config::setLogger(new Hypercharge\StdoutLogger());

	echo "\nTransactions for 4 days from 2013-05-31\n"
		,"unique_id amount currency transaction_type status:\n\n";

	$timeZone = new DateTimeZone('UTC');

	Hypercharge\Transaction::each(
		HyperchargeCredentials::getChannelToken()
		,array('start_date' => '2013-05-31', 'period'=>'P4D') // May 31 2013 + 4 days
		,function($transaction) use ($timeZone) {
			$date = new DateTime($transaction->timestamp, $timeZone);
			echo ($transaction->isError() ? ' !' : '  ' )
				,' ',$date->format('Y-m-d H:i')
				,' ',sprintf('%15s', $transaction->status)
				,' ',$transaction->unique_id
				,' ',sprintf('%3s'   , @$transaction->currency) // void transactions don't have currency
				,' ',sprintf('%10.2f', @$transaction->amount / 100)
				,' ',$transaction->transaction_type
				,"\n";
		}
	);
}

reconcile_by_date();
