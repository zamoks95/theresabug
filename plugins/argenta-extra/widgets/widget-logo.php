<?php

require_once plugin_dir_path( __FILE__ ) . 'widget.php';

class argenta_widget_logo extends SB_WP_Widget {
	
	protected $options;
	
	public function __construct() {

		$this->options = array(
			array(
				'custom_css', 'text', '', 
				'label' => esc_html__( 'Custom css classes', 'argenta_extra' ), 
				'input' => 'text'
			)
		);
		
		parent::__construct(
			'argenta_widget_logo',
			'Argenta: ' . esc_html__( 'Logo', 'argenta_extra' ),
			array( 'description' => esc_html__( 'Display site logo', 'argenta_extra' ) )
		);
	}
	
	function widget( $args, $instance ) {
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

		$css_classes = $this->getInstance( 'custom_css' );
		$logo = \Argenta\Settings::footer_widget_logo();

		echo wp_kses( $before_widget, $allowed_tags );
		?>
			<div class="theme-logo <?php if ( $css_classes ) { echo esc_attr( $css_classes ); } ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php if ( is_array( $logo ) && $logo['default'] ) : ?>
					<img src="<?php echo esc_url( $logo['default'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				<?php else : ?>
					<h3 class="title text-left"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h3>
				<?php endif; ?>
				</a>
			</div>
		<?php

		echo wp_kses( $after_widget, $allowed_tags );
	}
}

register_widget( 'argenta_widget_logo' );