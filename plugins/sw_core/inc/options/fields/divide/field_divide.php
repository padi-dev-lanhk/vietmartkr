<?php
class SWG_Options_divide extends SWG_Options{	
	
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
		
		$class = (isset($this->field['class']))?' '.esc_attr( $this->field['class'] ).'':'';
		
		echo '</td></tr></table><div class="hr'.$class.'"/></div><table class="form-table no-border"><tbody><tr><th></th><td>';
		
	}//function
	
}//class
?>