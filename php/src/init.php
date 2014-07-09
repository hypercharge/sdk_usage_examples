<?php
require_once(dirname(__DIR__).'/vendor/autoload.php');

/**
* singleton initializing and holding the hypercharge credentials.
* nothing special, just to avoid using globals here.
*/
class HyperchargeCredentials {

	private static $inst;

	private $credentials;

	private function __construct() {
		$this->credentials = json_decode(file_get_contents(dirname(dirname(__DIR__)).'/credentials.json'));

		Hypercharge\Config::set($this->credentials->login, $this->credentials->password, Hypercharge\Config::ENV_SANDBOX);
	}

	public static function instance() {
		if(!self::$inst) self::$inst = new HyperchargeCredentials();
		return self::$inst;
	}

	public static function getChannelToken() {
		return HyperchargeCredentials::instance()->credentials->channel;
	}

	public static function getMyShopBaseUrl() {
		return HyperchargeCredentials::instance()->credentials->myShopBaseUrl;
	}

}
// force init
HyperchargeCredentials::instance();
$validator = new Hypercharge\JsonSchemaValidator('scheduler_index');

echo "Hyperchage PHP SDK version: ". Hypercharge\VERSION ."\n";
echo "Hyperchage Schema  version: ". Hypercharge\SCHEMA_VERSION ."\n";