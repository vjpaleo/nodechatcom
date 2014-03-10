<?php

/**
 * User Cookie wrapper class.
 */

function setRememderMeCookie($cookieData = array()) {
	if(!empty($cookieData)) {

		// @todo : need to encrypt the data using some salt.
		$encodeCookieData = json_encode(
			array(
				'em' => $cookieData['email'],
				'pw' => $cookieData['password'],
				'rm' => $cookieData['rememberme']
				)
			);
		set_cookie("ud", $encodeCookieData,time()+3600);

	}

}

function getRememderMeCookie() {

	// @todo : need to decrypt
	$cookieData = json_decode(get_cookie("ud"));

	return (Array) $cookieData;
}

function delRememderMeCookie() {

	set_cookie("ud", NULL,time()-3600);

}

function setUserCookie($cookieData = array()) {
	if(!empty($cookieData)) {


		// @todo : need to encrypt the data using some salt.
		$encodeCookieData = json_encode($cookieData);
		set_cookie("u", $encodeCookieData,time()+3600);

	}

}

function getUserCookie() {

	// @todo : need to decrypt
	$cookieData = json_decode(get_cookie("u"));

	return (Array) $cookieData;
}

function delUserCookie() {

	set_cookie("u", NULL,time()-3600);
}


?>