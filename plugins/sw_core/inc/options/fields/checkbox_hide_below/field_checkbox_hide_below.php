<?php
class SWG_Options_checkbox_hide_below extends SWG_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since SWG_Options 1.0.1
	*/
	function __construct($field = array(), $value ='', $parent){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		
		
	}//function
	
	
	
	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since SWG_Options 1.0.1
	*/
	function render(){
		
		$class = (isset($this->field['class'])) ? esc_attr( $this->field['class'] ):'';
		
		echo ($this->field['desc'] != '')?' <label>':'';
		
		echo '<input type="checkbox" id="'.esc_attr( $this->field['id'] ).'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" value="1" class="'.$class.' sw-opts-checkbox-hide-below" '.checked($this->value, '1', false).' />';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' '.esc_html( $this->field['desc'] ).'</label>':'';
		
	}//function
	
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since SWG_Options 1.0.1
	*/
	function enqueue(){
		
		wp_enqueue_script(
			'sw-opts-checkbox-hide-below-js', 
			SWG_Options_URL.'fields/checkbox_hide_below/field_checkbox_hide_below.js', 
			array('jquery'),
			time(),
			true
		);
		
	}//function
	
}//class
?>