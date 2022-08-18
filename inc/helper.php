<?php

/**
 * this helper function is used to get IP Address of visitor
 */
function getIpAddress()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		// Check IP from internet.
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		// Check IP is passed from proxy.
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		// Get IP address from remote address.
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	/* // Get visitor IP behind CloudFlare network
	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
		$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if (filter_var($client, FILTER_VALIDATE_IP)) {
		$ip = $client;
	} elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
		$ip = $forward;
	} else {
		$ip = $remote;
	} */

	return ip2long($ip);
}

/**
 * this helper function provides current url
 */
function getCurrentUrl()
{
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
		$url = "https://";
	else
		$url = "http://";
	// Append the host to the url.
	$url .= $_SERVER['HTTP_HOST'];
	// Append the query string
	$url .= $_SERVER['REQUEST_URI'];

	return urlencode($url);
}

/**
 * @param null $date
 * @return bool|string
 */
function setDateFormat($date = null)
{
	$date = empty($date) ? time() : strtotime($date);
	return date('l, jS F Y, h:i:sa', $date);
}
