<?php
namespace Yaravel\Dscloud;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\HTML;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
class Dsform {

	public $errors;
	public $values;

	public function init($header = 'Titulo Form', $files = false, $values, $errors){
		$this->errors = $errors;
		$this->values = $values;
		$html  = '<div class="row">';
		$html .= '<div class="col-md-12">';
		$html .= Form::open(array('files' => $files));
		if (!$this->errors->isEmpty()){
			$style = 'danger';
		} else {
			$style = 'default';
		}
		$html .= '<div class="panel panel-' . $style . '">';
		$html .= '<div class="panel-heading">' . $header . '</div>';
		$html .= $this->panelBodyStart();
		$html .= $this->errors();
		return $html;
	}

	public function errors(){
		if (!$this->errors->isEmpty()){
			$html = '<div class="alert alert-danger" role="alert">';
			foreach ($this->errors->all() as $message){
				$html .= $message . '<br>';
			}
			$html .= '</div>';
			return $html;
		}
	}

	public function panelBodyStart() {
		$html  = '<div class="panel-body">';
		$html .= '<div class="row">';
		$html .= '<div class="col-sm-12">';
		return $html;
	}

	public function text($name, $placeholder, $ifcounter = false) {
		$class = '';
		if (!$this->errors->isEmpty()){
			if ($this->errors->first($name)) {
				$class .= 'has-error';
				$inputIcon = 'glyphicon-remove';
			} else {
				$class .= 'has-success';
				$inputIcon = 'glyphicon-ok';
			}
		}
		if ($ifcounter == true) {
			$class .= ' input-group';
		} else {
			$class .= ' has-feedback';
		}
		$html  = '<div class="form-group ' . $class . '">';
		$html .= Form::text($name, Input::old(
			$name,
			isset($this->values->{$name}) ? $this->values->{$name} : null),
			array(
				'id' => "title",
				'class' => "form-control input-lg",
				'maxlength' => "40",
				'placeholder' => $placeholder));
		if ($ifcounter == true) {
			$html .= '<span class="input-group-addon" id="counterTitle">0</span>';
		} else {
			if (!$this->errors->isEmpty()){
				$html .= '<span class="glyphicon ' . $inputIcon . ' form-control-feedback"></span>';
			}
		}
		$html .= '</div>';
		return $html;
	}
}
?>