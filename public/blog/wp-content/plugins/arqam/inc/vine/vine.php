<?php
/**
 * Vine API wrapper in PHP
 *
 * @author      Peter A. Tariche
 * @copyright   2012 Peter A. Tariche <ptariche@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 * @link        http://github.com/ptariche/VinePHP
 * @category    Services
 * @package     Vine
 * @version     0.0.5
 * @todo        Search by Tags, Get Post on Post ID
 */

Class TieVine {

    private static $username;
    private static $password;

    private $_baseURL = 'https://api.vineapp.com';

    public function __construct() {

        if (func_get_args(0))
            self::$username = func_get_arg(0);

        if (func_get_arg(1))
            self::$password = func_get_arg(1);
    }

    private function _getCurl($params = array()) {

    	$url = $params["url"];
    	$key = $params["key"];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, "iphone/110 (iPhone; iOS 7.0.4; Scale/2.00)");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('vine-session-id: '.$key));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($ch);
		curl_close($ch);
		if (!$result){echo curl_error($ch);}

		return $result;

    }
    private function _postCurl($params = array()) {

		$url = $params["url"];
		$postFields = $params["postFields"];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		curl_setopt($ch, CURLOPT_USERAGENT, "iphone/110 (iPhone; iOS 7.0.4; Scale/2.00)");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($ch);
		curl_close($ch);
		if (!$result){echo curl_error($ch);}

		return $result;
    }

    public function getKey() {

    	$username = urlencode(self::$username);
		$password = urlencode(self::$password);
		$postFields = "username=$username&password=$password"; 
		$url = $this->_baseURL.'/users/authenticate';
		$params = array("url" => $url, "postFields" =>$postFields,);
		$result = $this->_postCurl($params);
		$json = json_decode($result, true);
		$key = $json["data"]["key"];

		return $key;
    }

    public function meJSON() {

    	$key = $this->getKey();
		$userId = strtok($key,'-');
		$url = $this->_baseURL.'/users/me';
		$params = array("url" => $url, "key" =>$key,);
		$result = $this->_getCurl($params);
		$result_pregReplace = preg_replace ('/:\s?(\d{14,})/', ': "${1}"', $result);
		$json = json_decode($result_pregReplace, true);

		return $json;
    }

    public function me() {

		$json = $this->meJSON();
		$followerCount= $json["data"]["followerCount"];

		return $followerCount;
    }
}

?>