<?php
namespace Yaravel\Yform;

use Illuminate\Support\Facades\Session;
class Yerrors {

	const DEFAULT_MESSAGE = 9;

	private $errors;

	public function __construct() {
		$this->errors = Session::get('errors');
	}

	public function first($key = null, $message1 = self::DEFAULT_MESSAGE, $message2 = self::DEFAULT_MESSAGE) {
		if (count($this->errors) > 0) {
			if($this->errors->has($key)){
				return $message1==self::DEFAULT_MESSAGE ? 'has-error' : $message1;
			} else {
				return $message2==self::DEFAULT_MESSAGE ? 'has-success' : $message2;
			}
		}
	}
}
?>