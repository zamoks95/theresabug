<?php

class argenta_widget_subscribe extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'argenta_widget_subscribe',
			'Argenta: ' . esc_html__( 'Subscribe', 'argenta_extra' ),
			array( 'description' => esc_html__( 'Subscribe to social and rss', 'argenta_extra' ) )
		);
	}

	function widget( $args, $instance ) {
		extract( $args );

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

		$title = apply_filters( 'widget_title', $instance['title'] );
		$feedburner = ( isset( $instance['feedburner'] ) ) ? $instance['feedburner'] : false;

		$subscribe_title = ( isset( $subscribe_title ) ) ? $subscribe_title : false;
		$subscribe_description = ( isset( $subscribe_description ) ) ? $subscribe_description : false;

		echo wp_kses( $before_widget, $allowed_tags );
		
		$unique_id = uniqid( 'argenta_subscr_widget_' );

		if ( ! empty( $title ) ) {
			echo wp_kses( $before_title . esc_html( $title ) . $after_title, $allowed_tags );
		}
	?>

	<div class="subscribe-widget">
		
		<?php if ( $subscribe_title ) : ?>
		<h3 class="title widgettitle"><?php echo esc_html( $subscribe_title ); ?></h3>
		<?php endif; ?>
		
		<?php if ( $subscribe_description ) : ?>
		<p><?php echo wp_kses( $subscribe_description, 'default' ); ?></p>
		<?php endif; ?>
		
		<form id="<?php echo uniqid( 'feedburner_subscribe_' ) ?>" action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open( 'https://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr( $feedburner ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520' );return true">
			<div class="subscribe fullwidth">
				<table>
					<tr>
						<td>
							<input type="text" placeholder="<?php esc_attr_e( 'Enter your email', 'argenta_extra' ); ?>" name="email" id="<?php echo uniqid( 'subsmail_' ); ?>">
						</td>
						<td class="btn-wrap">
							<button class="btn"><?php esc_html_e( 'Join us', 'argenta_extra' ); ?></button>
						</td>
					</tr>
				</table>
			</div>
			<div class="text-left"></div>
			<input type="hidden" value="<?php echo esc_attr( $feedburner ); ?>" name="uri"/>
			<input type="hidden" name="loc" value="en_US"/>
		</form>
	</div>

   <?php
		echo wp_kses( $after_widget, $allowed_tags );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['feedburner'] = strip_tags( $new_instance['feedburner'] );
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'title' => '',
			'feedburner' => ''
		) );
?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title', 'argenta_extra' ); ?>:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feedburner' ) ); ?>"><?php esc_html_e( 'Feedburner Feed Name', 'argenta_extra' ); ?>:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'feedburner' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'feedburner' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['feedburner'] ); ?>"/>
		</p>
	<?php }
}

register_widget( "argenta_widget_subscribe" );