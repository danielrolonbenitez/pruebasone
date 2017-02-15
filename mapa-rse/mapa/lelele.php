<?php
session_start();


set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . DIRECTORY_SEPARATOR . "library");
require_once "Zend/Loader.php";
require_once "Zend/Gdata/Photos.php";
require_once "Zend/Gdata/ClientLogin.php";


$serviceName = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
$user = "nicolas@vnstudios.com";
$pass = "";

$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $serviceName);

// url https://picasaweb.google.com/100742160751246668876/PruebaAlbum?authuser=0&authkey=Gv1sRgCI7ejbDo1Lj6Tg&feat=directlink

$_REQUEST['url'] = 'https://picasaweb.google.com/100742160751246668876/PruebaAlbum?authuser=0&authkey=Gv1sRgCI7ejbDo1Lj6Tg&feat=directlink';

$url = explode('?', $_REQUEST['url']);
$url = explode('#', $url[0]);
$url = $url[0];
$url = preg_replace('/\/$/', '', $url);
$url = explode("/", $url);
$album_name = $url[count($url) - 1];
$user_name = $url[count($url) - 2];


require_once "Zend/Gdata.php";
require_once "Zend/Gdata/Photos.php";
require_once "Zend/Gdata/Photos/AlbumQuery.php";

$service = new Zend_Gdata_Photos($client);

$query = new Zend_Gdata_Photos_AlbumQuery();
$query->setUser($user_name);
$query->setAlbumName($album_name);

try {
	$album = $service->getAlbumFeed($query);
	/*$raw_data = $album->getMediaGroup();
	$raw_data = $raw_data->getContent();
	
	$data = array();
	
	foreach($raw_data as $picture) {
		$data[] = array(
			'url' => $picture->getUrl()
			
		);
	}*/
	$data = array();
	foreach($album as $entry) {
		$data[] = array(
			'thumbnail' => $entry->getMediaGroup()->getThumbnail()[0]->getUrl(),
			'photo' => $entry->getMediaGroup()->getContent()[0]->getUrl()
		);
		/*var_dump($entry->getMediaGroup()->getContent()[0]->getUrl());*/
	}
	echo json_encode($data);
}
catch (Zend_Gdata_App_Exception $e) {
	$error = array('error' => $e->getMessage());
	echo json_encode($error);
}

die();
