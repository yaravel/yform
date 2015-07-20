<?php
namespace Yaravel\Yform;

use Illuminate\Support\Facades\Session;
class Yform {

	public $errors;

	public function __construct() {
		$this->errors = Session::get('errors');
	}

	public function first($key = null, $message1 = null, $message2 = null) {
		if (count($this->errors) > 0) {
			if($this->errors->has($key)){
				return $message1;
			} else {
				return $message2;
			}
		}
	}
}
?>