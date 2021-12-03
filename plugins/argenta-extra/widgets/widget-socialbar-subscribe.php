<?php

class argenta_widget_socialbar_subscribe extends WP_Widget {

	function __construct() {
		parent::__construct(
			'argenta_widget_socialbar_subscribe',
			'Argenta: ' . esc_html__( 'Socialbar subscribe', 'argenta_extra' ),
			array( 'description' =>  esc_html__( 'Subscribe social buttons', 'argenta_extra' ) )
		);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = $instance['title'];
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$googleplus = $instance['googleplus'];
		$instagram = $instance['instagram'];
		$pinterest = $instance['pinterest'];
		$linkedin = $instance['linkedin'];
		$youtube = $instance['youtube'];

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
		
		echo wp_kses( $before_widget, $allowed_tags );

		if ( ! empty( $title ) ) {
			echo wp_kses( $before_title . esc_html( $title ) . $after_title, $allowed_tags );
		}
		?>
		<div class="socialbar small">
			<?php if ( $facebook ) : ?>
				<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" class="social outline rounded">
					<span class="ion-social-facebook"></span>
				</a>
			<?php endif; ?>

			<?php if ( $twitter ) : ?>
				<a href="<?php echo esc_url( $twitter ); ?>" target="_blank" class="social outline rounded">
					<span class="ion-social-twitter"></span>
				</a>
			<?php endif; ?>

			<?php if ( $googleplus ) : ?>
				<a href="<?php echo esc_url( $googleplus ); ?>" target="_blank" class="social outline rounded">
					<span class="ion-social-googleplus-outline"></span>
				</a>
			<?php endif; ?>

			<?php if ( $instagram ) : ?>
				<a href="<?php echo esc_url( $instagram ); ?>" target="_blank" class="social outline rounded">
					<span class="ion-social-instagram-outline"></span>
				</a>
			<?php endif; ?>

			<?php if ( $linkedin ) : ?>
				<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" class="social outline rounded">
					<span class="ion-social-linkedin-outline"></span>
				</a>
			<?php endif; ?>

			<?php if ( $pinterest ) : ?>
				<a href="<?php echo esc_url( $pinterest ); ?>" target="_blank" class="social outline rounded">
					<span class="ion-social-pinterest-outline"></span>
				</a>
			<?php endif; ?>
			<?php if ( $youtube ) : ?>
				<a href="<?php echo esc_url( $youtube ); ?>" target="_blank" class="social outline rounded">
					<span class="ion-social-youtube"></span>
				</a>
			<?php endif; ?>
		</div>
		<?php
		echo wp_kses( $after_widget, $allowed_tags );
	}


	function update( $new, $old){
		$new = wp_parse_args( $new, array(
			'title' => '',
			'facebook' => '',
			'instagram' => '',
			'twitter' => '',
			'googleplus' => '',
			'pinterest' => '',
			'linkedin' => '',
			'youtube' => ''
		) );
		return $new;
	}

	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'title' => '',
			'facebook' => '',
			'instagram' => '',
			'twitter' => '',
			'googleplus' => '',
			'pinterest' => '',
			'linkedin' => '',
			'youtube' => ''
		) );
?>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'argenta_extra' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook link:', 'argenta_extra' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['facebook'] ); ?>"/>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter link:', 'argenta_extra' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['twitter'] ); ?>"/>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>"><?php esc_html_e( 'Google+ link:', 'argenta_extra' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'googleplus' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['googleplus'] ); ?>"/>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram link:', 'argenta_extra' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['instagram'] ); ?>"/>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest link:', 'argenta_extra' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['pinterest'] ); ?>"/>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'Linkedin link:', 'argenta_extra' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['linkedin'] ); ?>"/>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'Youtube link:', 'argenta_extra' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['youtube'] ); ?>"/>
	</p>

<?php
	}
}


register_widget( 'argenta_widget_socialbar_subscribe' );