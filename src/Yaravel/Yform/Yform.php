<?php
namespace Yaravel\Yform;

use Illuminate\Support\Facades\Session;
class Yform {

	private $errors;

	public function __construct() {
		$this->errors = Session::get('errors');
	}

}
?>