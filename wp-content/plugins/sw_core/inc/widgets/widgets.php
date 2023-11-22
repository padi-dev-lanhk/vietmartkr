<?php 

require_once( SWPATH . 'inc/widgets/widget-advanced.php' );
require_once( SWPATH . 'inc/widgets/classes.php' );


/**
 * Register sidebars and widgets
 */
function gaion_unregister_default_widgets() {
	if ( class_exists( 'WooCommerce' ) && file_exists( get_template_directory() . '/widgets/woocommerce/widget-product-categories.php' ) ) {
		include_once( get_template_directory() . '/widgets/woocommerce/widget-product-categories.php' );
		register_widget( 'Bakan_WC_Widget_Product_Categories' );
	}
	// Widgets
	register_widget('SW_Social_Widget');
	register_widget('SW_Top_Widget');
}
add_action('widgets_init', 'gaion_unregister_default_widgets', 11);

/**
 * Posts widget class
 *
 * @since 2.8.0
*/

class SW_Top_Widget extends SW_Widget{

	function __construct(){
		$widget_ops = array('classname' => 'sw_top', 'description' => esc_html__('SW top header widget', 'sw_core'));
		parent::__construct('sw_top', esc_html__('SW Top Widget', 'sw_core'), $widget_ops);
	}
}

class SW_Social_Widget extends WP_Widget{

	function __construct(){
		$widget_ops = array('classname' => 'sw_social', 'description' => esc_html__('SW Social Networks', 'sw_core'));
		parent::__construct('sw_social', esc_html__('SW Social', 'sw_core'), $widget_ops);
		$this->option_name='socials';
	}

	function widget($args, $instance){
		$socials  = isset($instance['socials']) && is_array($instance['socials']) ? $instance['socials'] : array();
		extract($args);
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base);

		echo sprintf( '%s', $before_widget );
		if ($title){
			echo sprintf( $before_title . '%s' . $after_title, $title );
		}
		?>
		<ul>
			<?php foreach ($socials as $social){?>
			<?php preg_match('/fa-.*?/', $social['icon'], $match); ?>
			<li><a href="<?php echo esc_url( $social['link'] ); ?>"
				title="<?php if (empty($match)) echo esc_attr( $social['icon'] ); ?>"> <?php if (empty($match)) echo esc_html( $social['icon'] ); else { ?>
					<i class="fa <?php echo esc_attr( $social['icon'] )?>"></i> <?php }?>
			</a></li>
			<?php } ?>
		</ul>
		<?php
		echo sprintf( '%s', $after_widget );
	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$socials = array();
		foreach ($new_instance['socials'] as $i => $social){
			if (isset($social['icon'])){
				$icon = trim(strip_tags($social['icon']));
				if ( !empty($icon) ){
					$link = trim(strip_tags($social['link']));
					if ( empty($link) ){
						$link = '#';
					}
					$socials[]= array( 'icon' => $icon, 'link' => $link );
				}
			}
		}
		$instance['socials'] = $socials;
		return $instance;
	}

	function form($instance){ 
		$title   = isset($instance['title']) ? sanitize_title($instance['title']) : '';
		$socials = isset($instance['socials']) && is_array($instance['socials']) ? $instance['socials'] : array();

		?>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title: ', 'sw_core'); ?>
	</label> <input class="widefat"
		id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"
		name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text"
		value="<?php echo esc_attr($title); ?>" />
</p>

<?php 
		// if saved data
		foreach ($socials as $j => $social){

			$name_j = $this->get_field_name($this->option_name).'['.$j.']';
			$id_j = $this->get_field_id($this->option_name).'_'.$j;

			$name_j_icon = $name_j.'[icon]';
			$id_j_icon = $id_j.'_icon';

			$name_j_link = $name_j.'[link]';
			$id_j_link = $id_j.'_link';
			?>
<p>
	<strong><?php echo esc_html__( 'Social', 'sw_core' ). ' ' .( $j+1 ); ?>
	</strong><br>
	<?php if (key_exists('icon', $social)){?>
	<label for="<?php echo esc_attr( $id_j_icon ); ?>"><?php esc_html_e('fa-* | title', 'sw_core')?>
	</label> <input class="widefat" id="<?php echo esc_attr( $id_j_icon );?>"
		name="<?php echo esc_attr($name_j_icon); ?>" type="text"
		value="<?php echo esc_attr( $social['icon'] ); ?>"><br>
	<?php }?>
	<label for="<?php echo esc_attr( $id_j_link ); ?>"><?php esc_html_e('Link ', 'sw_core')?> </label>
	<input class="widefat" id="<?php echo esc_attr( $id_j_link );?>"
		name="<?php echo esc_attr($name_j_link); ?>" type="text"
		value="<?php echo esc_attr( $social['link'] ); ?>">
</p>
<?php
		}

		// gaion fields for add new social network
		$i = (is_array($socials) && count($socials)) ? count($socials) : 0;

		$name_i = $this->get_field_name($this->option_name).'['.$i.']';
		$id_i = $this->get_field_id($this->option_name).'_'.$i;

		$name_i_icon = $name_i.'[icon]';
		$id_i_icon = $id_i.'_icon';

		$name_i_link = $name_i.'[link]';
		$id_i_link = $id_i.'_link';

		?>
<p>
	<strong><?php esc_html_e( 'Add a new social network', 'sw_core' ) ?></strong><br> <label
		for="<?php echo esc_attr( $id_i_icon ); ?>"><?php esc_html_e('Classname for Icon or Title', 'sw_core'); ?>
	</label> <input class="widefat" id="<?php echo esc_attr( $id_i_icon ); ?>"
		name="<?php echo esc_attr( $name_i_icon ); ?>" type="text" value=""
		placeholder="<?php esc_attr_e( 'Enter Font Awesome icon or Title', 'sw_core' ) ?>" /> <span><?php esc_html_e( 'If using as
		icon, please choose class name in Font Awesome. This is required.', 'sw_core' ) ?></span>
	<label for="<?php echo esc_attr( $id_i_link ); ?>"><?php esc_html_e('Link ', 'sw_core')?> </label>
	<input class="widefat" id="<?php echo esc_attr( $id_i_link ); ?>"
		name="<?php echo esc_attr( $name_i_link ); ?>" type="text" value=""
		placeholder="#" />
</p>
<?php
	}

}