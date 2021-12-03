<?php

require_once plugin_dir_path( __FILE__ ) . 'widget.php';

class argenta_widget_login_widget extends SB_WP_Widget {
	
	protected $options;
	
	function __construct(){
		
		$this->options = array(
			array(
				'title', 'text', '', 
				'label' => esc_html__( 'Title', 'argenta_extra' ), 
				'input' => 'text', 
				'filters' => 'widget_title', 
				'on_update' => 'esc_attr',
			),
			array(
				'description', 'text', '', 
				'label' => esc_html__( 'Description', 'argenta_extra' ), 
				'input' => 'textarea', 
				'on_update' => 'esc_attr',
			)
		);

		parent::__construct(
			'argenta_widget_login_widget',
			'Argenta: ' . esc_html__( 'Login', 'argenta_extra' ),
			array( 'description' => esc_html__( 'Display login form', 'argenta_extra' ) )
		);
	}
	
	function widget( $args, $instance ) {
		argenta_gh_add_required_script( 'argenta-login' );

		extract( $args );
		$this->setInstances( $instance, 'filter' );

		$allowed_tags = array(
			'section' => array(
				'id' => array(),
				'class' => array()
			),
			'li' => array(
				'id' => array(),
				'class' => array()
			),
			'div' => array(
				'id' => array(),
				'class' => array()
			),
			'h3' => array(
				'class' => array()
			)
		);
		
		$title = $this->getInstance( 'title' );
		$description = $this->getInstance( 'description' );
		
		$login_form_args = array(
			'label_log_in' => esc_html__( 'Login on site', 'argenta_extra' ),
			'label_lost_password' => esc_html__( 'Lost password', 'argenta_extra' ),
		);
		echo wp_kses( $before_widget, $allowed_tags );
		
		if ( ! empty( $title ) ) {
			echo wp_kses( $before_title . esc_html( $title ) . $after_title, $allowed_tags );
		}
		
		if ( ! empty( $description ) ) {
			echo '<p>' . wp_kses( $description, 'default' ) . '</p>';
		}
		
		$this->wp_login_form( $login_form_args);
		
		echo wp_kses( $after_widget, $allowed_tags );
	}
	
	function lost_password( $args ) {
		return '<p class="login-lost-password"><label>&nbsp;&nbsp;'
			. '<a href="' . esc_url( wp_lostpassword_url() ) . '">' . esc_html__( 'I lost my password', 'argenta_extra' ).'</a>'
			. '</label></p>';
	}
	
	function wp_login_form( $args = array( ) ) {
		$defaults = array(
			'redirect' => ( is_ssl( ) ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], // Default redirect is back to the current page
			'form_id' => uniqid( 'loginform_' ),
			'label_username' => esc_html__( 'Username', 'argenta_extra' ),
			'placeholder_username' => esc_html__( 'Login', 'argenta_extra' ),
			'label_password' => esc_html__( 'Password', 'argenta_extra' ),
			'placeholder_password' => esc_html__( 'Password', 'argenta_extra' ),
			'placeholder_email' => esc_html__( 'E-mail', 'argenta_extra' ),
			'label_remember' => esc_html__( 'Remember Me', 'argenta_extra' ),
			'label_lost_password' => esc_html__( 'Remind the password', 'argenta_extra' ),
			'label_log_in' => esc_html__( 'Log In', 'argenta_extra' ),
			'registration_text' => esc_html__( 'Register', 'argenta_extra' ),
			'back_to_login_text' => esc_html__( '< Back to login', 'argenta_extra' ),
			'id_username' => uniqid( 'user_login_' ),
			'id_password' => uniqid( 'user_pass_' ),
			'id_remember' => uniqid( 'rememberme_' ),
			'id_lost_password' => uniqid( 'rememberme_' ),
			'id_submit' => uniqid( 'wp-submit_' ),
			'remember' => true,
			'lost_password' => true,
			'value_username' => '',
			'value_remember' => true, // Set this to true to default the "Remember me" checkbox to checked
		);
		$args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );

		$registration_link = '';
		$login_submit_class = '';

		if ( get_option( 'users_can_register' ) ) {
			$registration_link = '<a href="' . esc_url( wp_registration_url() ) .'" class="btn btn-outline full-width">'. $args['registration_text'] .'</a>';
			$login_sumbit_class = ' with-registration';
		}

		echo '<div class="login-wrap">';

		// Logged in
		$username = '';
		$logged_in_visible = false;
		if ( is_user_logged_in() ) {
			global $current_user;
			$current_user = wp_get_current_user();
			$username = $current_user->display_name;
			$logged_in_visible = true;
		}

		// Login form
		echo '<form class="login-form' . ( ( $logged_in_visible ) ? ' hidden' : '' ) . '" name="' . esc_attr( $args['form_id'] ) . '" id="' . esc_attr( $args['form_id'] ) . '" action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
				' . apply_filters( 'login_form_top', '', $args ) . '
				<p class="login-error hidden"></p>
				<p class="login-username">
					<input type="text" name="log" id="' . esc_attr( $args['id_username'] ) . '" class="input" value="' . esc_attr( $args['value_username'] ) . '" size="20" placeholder="' . esc_attr( $args['placeholder_username'] ) . '" />
				</p>
				<p class="login-password">
					<input type="password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" class="input" value="" size="20" placeholder="' . esc_attr( $args['placeholder_password'] ) . '" />
				</p>
				<p class="login-submit' . $login_sumbit_class . '">
					<button type="submit" name="wp-submit" id="' . esc_attr( $args['id_submit'] ) . '" class="btn full-width">
						<i class="outlinedicon-lock-closed"></i>
						<span class="text">' . esc_html( 'Login', 'argenta_extra' ) . '</span>
						<span class="text-loading">' . esc_html( 'Loading', 'argenta_extra' ) . '</span>
					</button>
					<input type="hidden" name="redirect_to" value="' . esc_url( $args['redirect'] ) . '" />
				</p>
				<p class="login-registration">
					'. $registration_link . '
				</p>
				'. ( $args['remember'] ? '<p class="login-remember"><label><input name="rememberme" type="checkbox" id="' . esc_attr( $args['id_remember'] ) . '" value="forever"' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> ' . $args['label_remember'] . '</label></p>' : '' )
				 . ( $args['lost_password'] ? '<p class="login-lost-password"><label>'
						. '<a href="' . esc_url( wp_lostpassword_url() ) . '">' . $args['label_lost_password'] . '</a></label></p>' : '' )
				.apply_filters( 'login_form_bottom', '', $args ) . '
			</form>';

		// Registration form
		if ( get_option( 'users_can_register' ) ) {
			echo '<form class="reg-form" name="' . esc_attr( $args['form_id'] ) . '" id="' . esc_attr( $args['form_id'] ) . '" action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
					' . apply_filters( 'login_form_top', '', $args ) . '
					<p class="reg-error hidden"></p>
					<p class="reg-success hidden"></p>
					<p class="reg-username">
						<input type="text" name="log" class="input" value="' . esc_attr( $args['value_username'] ) . '" size="20" placeholder="' . esc_attr( $args['placeholder_username'] ) . '" />
					</p>
					<p class="reg-email">
						<input type="text" name="email" class="input" size="20" placeholder="' . esc_attr( $args['placeholder_email'] ) . '" />
					</p>
					<p class="reg-submit' . $login_sumbit_class . '">
						<button type="submit" name="wp-submit" class="btn full-width">
							<i class="outlinedicon-lock-closed"></i>
							<span class="text">' . $args['registration_text'] . '</span>
							<span class="text-loading">' . esc_html( 'Loading', 'argenta_extra' ) . '</span>
						</button>
						<input type="hidden" name="redirect_to" value="' . esc_url( $args['redirect'] ) . '" />
					</p>
					<p class="back-to-login text-left">
						<a href="">' . esc_attr( $args['back_to_login_text'] ) . '</a>
					</p>
				</form>';
		}

		// Logged in
		echo '<div class="logged-in' . (( $logged_in_visible ) ? ' visible' : '') . '">
				<div class="left">
					' . esc_html__( 'Logged in as', 'argenta_extra' ) . '
					<a href="' . esc_url( get_option( 'siteurl' ) ) . '/wp-admin/profile.php" class="box-name">
						' . esc_html__( $username ) . '
					</a>
				</div>
				<div class="right">
					<a href="' . esc_url( wp_logout_url() ) . '" class="logout-link">
						' . esc_html__( 'Logout', 'argenta_extra' ) . '
					</a>
				</div>
				<div class="clear"></div>
			</div>';

		echo '</div>';
	}
	
}

register_widget( 'argenta_widget_login_widget' );