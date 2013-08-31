<?php

require_once('AbstractAuthMechanism.php');

abstract class OAuthAuthMechanism extends AbstractAuthMechanism {

	public function loginCallback($provider, $requestToken, $callbackURL) {
		$accessToken = $this->getAccessToken($provider, $requestToken, $callbackURL);

		if ($accessToken['success']) {
			$response = array(
				'success'       => true,
				'accessToken'   => $accessToken['data']
			);

			if ($provider->profileURL) {
				$profile = $this->getNormalizedProfile($provider, $accessToken['data']);
				if ($profile['success']) {
					$response['profile'] = $profile['data'];
					return $response;
				} else {
					$profile['accessToken'] = $accessToken['data'];
					return $profile;
				}
			} else {
				return $response;
			}
		} else {
			return $accessToken;
		}
	}

	public function getNormalizedProfile($provider, $accessToken) {
		/*debug($provider);
		debug($provider->profileURL);
		debug($accessToken);
		debug($provider->profileParameters);
		debug($provider->profileRequestMethod);
		debug($provider->profileRequestHeaders);
		exit;*/
		if ($provider->profileURL) {
			$response = $this->apiRequest(
				$provider,
				$provider->profileURL,
				$accessToken,
				//$provider->profileParameters,
				array('id','name','first_name','last_name','username','email','birthday','gender','about','address','hometown','relationship_status','friends'),
				$provider->profileRequestMethod,
				$provider->profileRequestHeaders
			);
			if ($response['success']) {
				return $provider->normalizeProfile($response['data']);
			} else {
				return $response;
			}

		} else {
			return array(
				'success'       => false,
				'message'       => 'Profiles are unavailable from this provider'
			);
		}
	}

	abstract public function getAccessToken($provider, $requestToken);
}
