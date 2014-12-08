<?php
namespace Yaravel\Yform;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\HTML;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
class Yform {

	public $errors;
	public $values;
	public $js = '';

	public function addJs($js) {
		$this->js .= $js . "\n";
	}
	public function printJS($value='') {
		return $this->js;
	}
	public function init($header = 'Titulo Form', $files = false, $values, $errors){
		$this->errors = $errors;
		$this->values = $values;
		$html  = '<div class="row">';
		$html .= '<div class="col-md-12">';
		$html .= Form::open(array('files' => $files));
		if ($this->errors != null) {
			if (!$this->errors->isEmpty()){
				$style = 'danger';
			} else {
				$style = 'default';
			}
		} else {
			$style = 'default';
		}
		$html .= '<div class="panel panel-' . $style . '">';
		$html .= '<div class="panel-heading">' . $header . '</div>';
		$html .= $this->panelBodyStart();
		$html .= $this->errors();
		return $html;
	}
	public function buttonSection() {
		$html  = $this->panelBodyClose();
		$html .= $this->panelFooterStart();
		return $html;
	}
	public function close($value='') {
		$html  = $this->panelFooterClose();
		$html .= '</div>';
		$html .= Form::close();
		$html .= '</div>';
		$html .= '</div>';
		return $html;
	}

	public function errors(){
		if ($this->errors != null) {
			if (!$this->errors->isEmpty()){
				$html = '<div class="alert alert-danger" role="alert">';
				foreach ($this->errors->all() as $message){
					$html .= $message . '<br>';
				}
				$html .= '</div>';
				return $html;
			}
		}
	}

	public function panelBodyStart() {
		$html  = '<div class="panel-body">';
		$html .= '<div class="row">';
		$html .= '<div class="col-sm-12">';
		return $html;
	}

	public function panelBodyClose() {
		$html  = '</div>';
		$html .= '</div>';
		$html .= '</div>';
		return $html;
	}

	public function panelFooterStart() {
		$html  = '<div class="panel-footer">';
		return $html;
	}

	public function panelFooterClose() {
		$html  = '</div>';
		return $html;
	}

	public function input($input = 'text', $name, $placeholder = null, $options = array(), $selectValues = array(), $selectDefault = null) {
		$class = '';
		// Check if counter
		if (array_key_exists('counter', $options)) {
			if ($options['counter'] == 1) {
				$ifcounter = true;
			} else {
				$ifcounter = false;
			}
			unset($options['counter']);
		} else {
			$ifcounter = false;
		}
		// Check if class
		if (!array_key_exists('class', $options)) {
			$options['class'] = "form-control input-lg";
		}
		// Check if exist placeholder
		if ($placeholder != null) {
			$options['placeholder'] = $placeholder;
		}
		if ($this->errors != null) {
			if (!$this->errors->isEmpty()){
				if ($this->errors->first($name)) {
					$class .= 'has-error';
					$inputIcon = 'glyphicon-remove';
				} else {
					$class .= 'has-success';
					$inputIcon = 'glyphicon-ok';
				}
			}
		}
		if ($ifcounter == true) {
			$class .= ' input-group';
		} else {
			$class .= ' has-feedback';
		}
		$html  = '<div class="form-group ' . $class . '">';
		if ($input == 'select') {
			$oldValue = Input::old(
				$name,
				isset($this->values->{$name}) ? $this->values->{$name} : null
			);
			$html .= Form::{$input}($name, $selectValues, $oldValue, $options);
		} else {
			$oldValue = Input::old(
				$name,
				isset($this->values->{$name}) ? $this->values->{$name} : null
			);
			$html .= Form::{$input}($name, $oldValue, $options);
		}
		if ($ifcounter == true) {
			$html .= '<span class="input-group-addon" id="' . "counter" . $name . '">0</span>';
			$this->addJs("$('#" . $name . "').contarCaracteres('#counter" . $name . "');");
		} else {
			if ($this->errors != null) {
				if (!$this->errors->isEmpty()){
					$html .= '<span class="glyphicon ' . $inputIcon . ' form-control-feedback"></span>';
				}
			}
		}
		$html .= '</div>';
		return $html;
	}

	public function text($name, $placeholder = null, $options = array()) {
		return $this->input(
			'text',
			$name,
			$placeholder,
			$options
		);
	}

	public function textarea($name, $placeholder, $options = array()) {
		return $this->input(
			'textarea',
			$name,
			$placeholder,
			$options
		);
	}
	
	public function select($name, $values = array(), $options = array()) {
		return $this->input(
			'select',	// Tipe input
			$name,		// Name input
			null,		// Placeholder null
			$options,	// Tags Options
			$values,	// Array values Select
			null		// Select Default Value
		);
	}
	public function headerSection($h2 = 'Panel Administrador del Sitio Web', $h5 = 'Bienvenido Usuario.') {
		$html = '<div class="row">';
		$html .= '<div class="col-md-12">';
		$html .= '<h2>' . $h2 . '</h2>';
		$html .= '<h5>' . $h5 . '</h5>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<hr />';
		return $html;
	}
}
?>