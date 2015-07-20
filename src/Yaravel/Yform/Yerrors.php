<?php
namespace Yaravel\Yform;

use Illuminate\Support\Facades\Session;
class Yerrors {


	private $errors;

	public function __construct() {
		$this->errors = Session::get('errors');
	}

	public function first($key = null, $message1 = true, $message2 = true) {
		if (count($this->errors) > 0) {
			if($this->errors->has($key)){
				return $message1 == true ? 'has-error' : $message1;
			} else {
				return $message2 == true ? 'has-success' : $message2;
			}
		}
	}
}
?>