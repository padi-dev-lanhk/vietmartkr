<?php
class SWG_Options_button_set extends SWG_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since SWG_Options 1.0
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
	 * @since SWG_Options 1.0
	*/
	function render(){
		
		$class = (isset($this->field['class']))?'class="'. esc_attr( $this->field['class'] ).'" ':'';
		
		echo '<fieldset class="buttonset">';
			
			foreach($this->field['options'] as $k => $v){
				
				echo '<input type="radio" id="'.esc_attr( $this->field['id'] ).'_'.array_search($k,array_keys($this->field['options'])).'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" '.$class.' value="'.esc_attr( $k ).'" '.checked($this->value, $k, false).'/>';
				echo '<label for="'.esc_attr( $this->field['id'] ).'_'.array_search($k,array_keys($this->field['options'])).'">'.$v.'</label>';
				
			}//foreach
			
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?'&nbsp;&nbsp;<span class="description">'.esc_html( $this->field['desc'] ).'</span>':'';
		
		echo '</fieldset>';
		
	}//function
	
	
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since SWG_Options 1.0
	*/
	function enqueue(){
		
		wp_enqueue_style('sw-opts-jquery-ui-css');

		wp_enqueue_script(
			'sw-opts-field-button_set-js', 
			SWG_Options_URL.'fields/button_set/field_button_set.js', 
			array('jquery', 'jquery-ui-core', 'jquery-ui-dialog'),
			time(),
			true
		);

		
	}//function
	
}//class
?>