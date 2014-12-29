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
	public function init($header = 'Titulo Form', $form, $values, $errors){
		$this->errors = $errors;
		$this->values = $values;
		$html  = '<div class="row">';
		$html .= '<div class="col-md-12">';
		$html .= Form::open($form);
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

	public function input($input = 'text', $name, $placeholder = null, $attributes = [], $selectValues = [], $selected = null) {
		$class = '';
		// Check if counter
		if (array_key_exists('counter', $attributes)) {
			if ($attributes['counter'] == 1) {
				$ifcounter = true;
			} else {
				$ifcounter = false;
			}
			unset($attributes['counter']);
		} else {
			$ifcounter = false;
		}
		if (array_key_exists('icon', $attributes)) {
			$icon = $attributes['icon'];
			$class .= ' input-group';
			unset($attributes['icon']);
		} else {
			$icon = false;
		}
		// Check if class
		if (!array_key_exists('class', $attributes)) {
			$attributes['class'] = "form-control input-lg";
		}
		// Check if exist id
		if (!array_key_exists('id', $attributes)) {
			$attributes['id'] = $name;
		}
		// Check if exist placeholder
		if ($placeholder != null) {
			$attributes['placeholder'] = $placeholder;
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
		isset($attributes['value']) ? $selected = $attributes['value'] : null;
		if ($selected == null) {
			$selected = Input::old(
				$name,
				isset($this->values->{$name}) ? $this->values->{$name} : null
			);
		} else {
			$selected = Input::old(
				$name,
				isset($selected) ? $selected : null
			);
		}

		// add icon
		if ($icon != false) {
			$html .= '<div class="input-group-addon"><i class="' . $icon . '"></i></div>';
		}
		if ($input == 'select') {
			$html .= Form::{$input}($name, $selectValues, $selected, $attributes);
		} else {
			$html .= Form::{$input}($name, $selected, $attributes);
		}
		if ($ifcounter == true) {
			$html .= '<span class="input-group-addon" id="' . "counter" . $attributes['id'] . '">0</span>';
			$this->addJs("$('#" . $name . "').contarCaracteres('#counter" . $attributes['id'] . "');");
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

	public function text($name, $placeholder = null, $attributes = []) {
		return $this->input(
			'text',
			$name,
			$placeholder,
			$attributes
		);
	}

	public function textarea($name, $placeholder, $attributes = []) {
		return $this->input(
			'textarea',
			$name,
			$placeholder,
			$attributes
		);
	}

	public function select($name, $values = [], $attributes = [], $selected = null) {
		return $this->input(
		'select',		// Tipe input
		$name,			// Name input
		null,			// Placeholder null
		$attributes,	// Tags Options
		$values,		// Array values Select
		$selected		// Select Default Value
	);
}
public function file($name, $values = [], $attributes = []) {
	$class = "";
	if ($this->errors != null) {
		if (!$this->errors->isEmpty()){
			if ($this->errors->first($name)) {
				$class = 'has-error';
			} else {
				$class = 'has-success';
			}
		}
	}
	$html = '<div class="fileinput fileinput-new input-group ' . $class . '" data-provides="fileinput">';
	$html .= '<div class="form-control" data-trigger="fileinput">';
	$html .= '<i class="glyphicon glyphicon-file fileinput-exists"></i>';
	$html .= '<span class="fileinput-filename"></span>';
	$html .= '</div>';
	$html .= '<span class="input-group-addon btn btn-default btn-file">';
	$html .= '<span class="fileinput-new">Seleccionar Archivo</span>';
	$html .= '<span class="fileinput-exists">Cambiar</span>';
	$html .= '<input type="file" name="' . $name . '">';
	$html .= '</span>';
	$html .= '<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>';
	$html .= '</div>';
	return $html;
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

	public function submit($text = "submit") {
		$html = Form::submit($text, ['class' => "btn btn-primary btn-lg"]);
		return $html;
	}
}
?>
