<?php
namespace DsurlGateway;

class Dsurl {

	public static function to($url = '') {
		$url = explode('/', trim($url, '/'));
		if(App::environment() == 'production') {
			unset($url[0]);
		}
		$url = '/' . implode('/', $url);
		return URL::to('/') . $url;
	}

	public static function dsbase($url = ''){
		$url = explode('/', trim($url, '/'));
		$_PATH = '';
		if(App::environment() == 'local') {
			$_PATH = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
			$_PATH = '/' . $_PATH[2];
		}
		$url = '/' . implode('/', $url);
		return URL::to('/') . $_PATH . $url;
	}

}
?>