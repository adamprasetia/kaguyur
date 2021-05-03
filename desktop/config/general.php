<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['xml'] 	= 'https://statics-kcm.s3.ap-southeast-1.amazonaws.com/XML/';
$config['json'] = 'https://statics-kcm.s3.ap-southeast-1.amazonaws.com/JSON/';

if(strpos($_SERVER['HTTP_HOST'], '.kompas.com') != False)
{
	$config['xml'] 	= 'http://xml.kompas.in/XML/';
	$config['json'] = 'http://xml.kompas.in/JSON/';
}