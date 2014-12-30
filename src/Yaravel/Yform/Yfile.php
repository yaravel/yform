<?php
namespace Yaravel\Yform;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\HTML;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class Yfile {
	private $_file;

	private $_path;

	private $_name;

	private $_filename;
	// Register object file
	public function file($_file){
		$this->_file = $_file;
	}
	// Register path
	public function path($_path){
		$this->_path = $_path;
	}
	// Register name
	public function name($_name){
		$this->_name = $_name;
	}

	public function upload($replace = null){
		$file = $this->_file;
		$destinationPath = $this->_path;
		File::makeDirectory($destinationPath, $mode = 0777, true, true);
		$this->_filename = Str::slug($this->_name) . '.' . $file->getClientOriginalExtension();
		// check is replace other file
		if($replace != null){
			$filePath = public_path() . '/' . $destinationPath . '/' . $replace;
			if (file_exists($filePath) AND is_file($filePath))
			unlink($filePath);
		}
		return $file->move($destinationPath, $this->_filename);
	}
	// return real name
	public function filename(){
		return $this->_filename;
	}
}
?>
