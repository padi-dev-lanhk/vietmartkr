<?php 

/*
	* Name: Metabox Category
	* Develope: Smartaddons
*/

	$sw_taxies = swg_options( 'tax_select' );
	/* Add Custom field to category product */
	if( !empty( $sw_taxies ) ){
		foreach( $sw_taxies as $sw_tax ){
			add_action( $sw_tax . '_add_form_fields', 'sw_category_fields', 200 );
			add_action( $sw_tax . '_edit_form_fields', 'sw_edit_category_fields', 200 );
		}
		add_action( 'created_term', 'sw_save_category_fields', 10, 3 );
		add_action( 'edit_terms', 'sw_save_category_fields', 10, 3 );
	}
	
	function sw_category_fields(){
		$number  = array( 0 => esc_html__( 'Select column', 'sw_core' ), 1, 2, 3, 4 );
		$sidebar = array( 
			''		=> esc_html__( 'Select Layout', 'sw_core' ),
			'left'	=> esc_html__( 'Left Sidebar', 'sw_core' ),
			'full' => esc_html__( 'Full Layout', 'sw_core' ),		
			'right' => esc_html__( 'Right Sidebar', 'sw_core' )
		);
?>
	<div class="form-field">
		<label><?php  esc_html_e( 'Sidebar Product Layout', 'sw_core' ) ?></label>
		<select id="term_sidebar" name="term_sidebar">
			<?php 
				foreach( $sidebar as $k => $v ){
					echo '<option value="'.esc_attr( $k ).'">'.esc_html( $v ).'</option>';
				}
			?>
		</select>
	</div>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php  esc_html_e( 'Layout', 'sw_core' ) ?></label></th>
		<td>	
			<select id="blog_layout" name="blog_layout">
				<option value="list"><?php echo esc_html__( 'List Layout', 'sw_core' ) ?></option>
				<option value="list2"><?php echo esc_html__( 'List Layout2', 'sw_core' ) ?></option>
				<option value="grid"><?php echo esc_html__( 'Grid Layout', 'sw_core' ) ?></option>
			</select>
		</td>
	</tr>

	<div class="form-field">
		<label><?php  esc_html_e( 'Select column for desktop screen', 'sw_core' ) ?></label>
		<select id="term_col_lg" name="term_col_lg">
			<?php 
				foreach( $number as $k => $v ){
					echo '<option value="'.esc_attr( $k ).'">'.esc_html( $v ).'</option>';
				}
			?>
		</select>
	</div>
	
	<div class="form-field">
		<label><?php  esc_html_e( 'Select column for small desktop screen', 'sw_core' ) ?></label>
		<select id="term_col_md" name="term_col_md">
			<?php 
				foreach( $number as $k => $v ){
					echo '<option value="'.esc_attr( $k ).'">'.esc_html( $v ).'</option>';
				}
			?>
		</select>
	</div>
	
	<div class="form-field">
		<label><?php  esc_html_e( 'Select column for tablet screen', 'sw_core' ) ?></label>
		<select id="term_col_sm" name="term_col_sm">
			<?php 
				foreach( $number as $k => $v ){
					echo '<option value="'.esc_attr( $k ).'">'.esc_html( $v ).'</option>';
				}
			?>
		</select>
	</div>
<?php 
	}
	function sw_edit_category_fields( $term ){
		$number = array( 0 => esc_html__( 'Select column', 'sw_core' ), 1, 2, 3, 4 );
		$sidebar = array( 
			'left'	=> esc_html__( 'Left Sidebar', 'sw_core' ),
			'full' => esc_html__( 'Full Layout', 'sw_core' ),		
			'right' => esc_html__( 'Right Sidebar', 'sw_core' )
		);
		
		$layout = array( 
			'list'	=> esc_html__( 'List Layout', 'sw_core' ),
			'list2' => esc_html__( 'List Layout2', 'sw_core' ),		
			'grid' => esc_html__( 'Grid Layout', 'sw_core' )
		);
		
		$term_col_lg  = get_term_meta( $term->term_id, 'term_col_lg', true );
		$term_col_md  = get_term_meta( $term->term_id, 'term_col_md', true );
		$term_col_sm  = get_term_meta( $term->term_id, 'term_col_sm', true );
		$term_sidebar = get_term_meta( $term->term_id, 'term_sidebar', true );
		$term_layout  = get_term_meta( $term->term_id, 'term_layout', true );
		
?>	
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php  esc_html_e( 'Sidebar Product Layout', 'sw_core' ) ?></label></th>
		<td>	
			<select id="term_sidebar" name="term_sidebar">
				<?php 
					foreach( $sidebar as $k => $v ){
						echo '<option value="'.esc_attr( $k ).'" '.selected( $term_sidebar, $k, false ).'>'.esc_html( $v ).'</option>';
					}
				?>
			</select>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php  esc_html_e( 'Sidebar Product Layout', 'sw_core' ) ?></label></th>
		<td>	
			<select id="term_layout" name="term_layout">
			<?php 
					foreach( $layout as $k => $v ){
						echo '<option value="'.esc_attr( $k ).'" '.selected( $term_layout, $k, false ).'>'.esc_html( $v ).'</option>';
					}
				?>
			</select>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top"><label><?php  esc_html_e( 'Select column for desktop screen', 'sw_core' ) ?></label></th>
		<td>
			<select id="term_col_lg" name="term_col_lg">
				<?php 
					foreach( $number as $k => $v ){
						echo '<option value="'.esc_attr( $k ).'" '.selected( $term_col_lg, $k, false ).'>'.esc_html( $v ).'</option>';
					}
				?>
			</select>
			<div class="clear"></div>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php  esc_html_e( 'Select column for medium desktop screen', 'sw_core' ) ?></label></th>
		<td>
			<select id="term_col_md" name="term_col_md">
				<?php 
					foreach( $number as $k => $v ){
						echo '<option value="'.esc_attr( $k ).'" '.selected( $term_col_md, $k, false ).'>'.esc_html( $v ).'</option>';
					}
				?>
			</select>
			<div class="clear"></div>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php  esc_html_e( 'Select column for tablet screen', 'sw_core' ) ?></label></th>
		<td>
			<select id="term_col_sm" name="term_col_sm">
				<?php 
					foreach( $number as $k => $v ){
						echo '<option value="'.esc_attr( $k ).'" '.selected( $term_col_sm, $k, false ).'>'.esc_html( $v ).'</option>';
					}
				?>
			</select>
			<div class="clear"></div>
		</td>
	</tr>
<?php 
	}

	function sw_save_category_fields( $term_id, $tt_id = '', $taxonomy = '', $prev_value = '' ){
		$term_args = array( 'term_col_lg', 'term_col_md', 'term_col_sm', 'term_sidebar', 'term_layout' );
		foreach( $term_args as $value ){
			if( isset( $_POST[$value] ) ) {
				$term_value = '';
				if( preg_match_all( "/col/", $value, $output ) ){
					$term_value = intval( $_POST[$value] );
				}else{
					$term_value = esc_attr( $_POST[$value] );
				}
        update_term_meta( $term_id, $value, $term_value, $prev_value );
			}
		}
	}