<?php
/**
* @author Edocsyl <kaj@edocsyl.ch>
* @version 1.0
* @category YPool API
* @copyright Copyright (c) 2014, gigaIT.net
* @license Apache License 2.0
*/

class YPool {
	
	private $_apiUrl = 'http://ypool.net/api/';
	private $_apiKey = null;
	private $_curlTimeout = 5;
	
	public function __construct($apikey = null){
		$this->_apiKey = $apikey;
	}
	
	public function global_stats($coin){
		return $this->makeRequest('global_stats', $coin);
	}
	
	public function personal_stats($coin){
		return $this->makeRequest('personal_stats', $coin);
	}
	
	public function workers($coin){
		return $this->makeRequest('workers', $coin);
	}
	
	public function live_workers($coin){
		return $this->makeRequest('live_workers', $coin);
	}
	
	public function block_stats($coin){
		return $this->makeRequest('block_stats', $coin);
	}
	
	public function makeRequest($resource, $cointype){
		$url = $this->makeRequestUrl($resource, $cointype, $this->_apiKey);
		$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->_curlTimeout);
        $result = curl_exec($ch);
        curl_close($ch);
		return json_decode($result, true);
	}
	
	public function makeRequestUrl($resource, $cointype, $key = null){
		return $this->_apiUrl . $resource . '?coinType='. $cointype . ($key != null ? '&key=' . $key : '');
	}

}

class Coins {
	const XPM = 'XPM';
	const FTC = 'FTC';
	const PTS = 'PTS';
	const DOGE = 'DOGE';
	const MTC = 'MTC';
	const RIC = 'RIC';
}


?>