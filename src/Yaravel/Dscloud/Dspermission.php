<?php
/**
* 
*/
class Dspermission {
	public static function check() {
		if ( Auth::guest() )  {
			return false;
		}
		return true;
	}
}
?>