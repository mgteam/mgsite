<?php
class UserSystemInfo {

/**
 *	getting user ip address.
 *
 *	@access public.
 *	@return user ip.
 **/
	public function getIp() {
    	if (!empty($_SERVER["HTTP_CLIENT_IP"])){
			//check for ip from share internet
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		}elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
			// Check for the Proxy User
			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}else{
			$ip = $_SERVER["REMOTE_ADDR"];
		}
		// This will return user's real IP Address
		// does't matter if user using proxy or not.
		return $ip;
    }
	
/**
 *	find location of current user using ip address.
 *
 *	@access public.
 *	@param ip address.
 *	@return array.
 **/
	function findLocation($ip) {
        $default = array(); //'India, IND';
        $curl_info = null;
        $city = '';
        $state = '';
        $location = array();
        
        if (!is_string($ip) || strlen($ip) < 1 || $ip == '127.0.0.1' || $ip == 'localhost') {
            $ip = '8.8.8.8';
        }

        $curlopt_useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';
        
        $url = 'http://ipinfodb.com/ip_locator.php?ip=' . urlencode($ip);
        $ch = curl_init();
        
        $curl_opt = array(
            CURLOPT_FOLLOWLOCATION  => 1,
            CURLOPT_HEADER      	=> 0,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_USERAGENT   	=> $curlopt_useragent,
            CURLOPT_URL       		=> $url,
            CURLOPT_TIMEOUT         => 1,
            CURLOPT_REFERER         => 'http://' . $_SERVER['HTTP_HOST'],
        );
        
        curl_setopt_array($ch, $curl_opt);
        
        $content = curl_exec($ch);
        
        if (!is_null($curl_info)) {
            $curl_info = curl_getinfo($ch);
        }
        
        curl_close($ch);
        
        if (preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs))  {
            $city = $regs[1];
        }
        if (preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs)) {
            $state = $regs[1];
        }
        if (preg_match('{<li>Zip or postal code : ([^<]*)</li>}i', $content, $regs)) {
            $location['zip_code'] = $regs[1];
        }
        if (preg_match('{<li>Latitude : ([^<]*)</li>}i', $content, $regs)) {
            $location['latitude'] = $regs[1];
        }
        if (preg_match('{<li>Longitude : ([^<]*)</li>}i', $content, $regs)) {
            $location['longitude'] = $regs[1];
        }
        if (preg_match('{<li>Timezone : ([^<]*)</li>}i', $content, $regs)) {
            $location['timezone'] = $regs[1];
        }

        if ($city!='' && $state!='') {
			$location['city'] = $city;
			$location['state'] = $state;
			return $location;
        } else {
			$default['city'] = 'city';
			$default['state'] = 'state';
			$default['zip_code'] = 'AABBCC';
			$default['timezone'] = 'UTC';
			$default['latitude'] = '1.325575452';
			$default['longitude'] = '1.4644416456';
            return $default; 
        }
    }
}