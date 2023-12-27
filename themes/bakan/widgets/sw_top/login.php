<?php 
$bakan_header_style = swg_options('header_style');
?>
<?php do_action( 'before' ); ?>
<?php if ( class_exists( 'WooCommerce' ) ) { ?>
<?php global $woocommerce; ?>
<div class="top-login">
	<?php if ( ! is_user_logged_in() ) {  ?>
		<ul>
			<li>
			<?php echo '<a href="javascript:void(0);" data-toggle="modal" data-target="#login_form">'.esc_html__('Đăng Nhập', 'bakan').'</a>'; ?><a class="register" href="<?php echo esc_url( home_url('/my-account') ); ?>" title="<?php esc_attr_e( 'Đăng kí', 'bakan' ) ?>"><?php esc_html_e('Đăng kí', 'bakan'); ?></a>
			</li>
		</ul>
	<?php } else{?>
		<div class="div-logined">
			<ul>
				<li>
					<span><?php esc_html_e('Xin chào', 'bakan'); ?></span>
					<?php 
						$user_id = get_current_user_id();
						$user_info = get_userdata( $user_id );	
					?>
					<a href="<?php echo wp_logout_url( home_url('/') ); ?>" title="<?php esc_attr_e( 'Đăng xuất', 'bakan' ) ?>"><?php esc_html_e('Đăng xuất', 'bakan'); ?></a>
				</li>
			</ul>
		</div>
	<?php } ?>
</div>
<?php } ?>