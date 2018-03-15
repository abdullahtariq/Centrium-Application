<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation {
    /**
     * MY_Form_validation::alpha_extra().
     * Alpha-numeric with periods, underscores, spaces and dashes.
     */
    function alpha_extra($str) {
        $this->CI->form_validation->set_message('alpha_extra', 'The %s may only contain alpha-numeric characters, spaces, periods, underscores & dashes.');
        return ( ! preg_match("/^([\.\s-a-z0-9_-])+$/i", $str)) ? FALSE : TRUE;
    }
    // add more function to apply custom rules.
    public function get_errors_as_array(){
    	return $this->_error_array;
    }

    public function get_config_rules(){
    	return $this->_config_rules;
    }

    public function get_field_names($form){
    	$field_names = array();
        $formval = $form;
    	$rules = $this->get_config_rules();
    	$rules = $rules[$formval];

    	foreach ($rules as $index => $info) {
    		$field_names[] = $info['field'];
    	}
    	return $field_names;
    }
}
