<?php

require_once plugin_dir_path( __FILE__ ) . 'widget.php';

class argenta_widget_about_author extends SB_WP_Widget {

	protected $options;

	public function __construct() {		
		$this->options = array(
			array(
				'title', 'text', '', 
				'label' => esc_html__( 'Title', 'argenta_extra' ), 
				'input' => 'text', 
				'filters' => 'widget_title',
				'on_update' => 'esc_attr'
			),
		);
		
		parent::__construct(
			'argenta_widget_about_author',
			'Argenta: ' . esc_html__( 'About author', 'argenta_extra' ),
			array( 'description' => esc_html__( 'About author', 'argenta_extra' ) )
		);
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = '';
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'argenta_extra' ); ?>:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$this->setInstances( $instance, 'filter' );

		$allowed_tags = array(
			'div' => array(
				'id' => array(),
				'class' => array()
			),
			'li' => array(
				'id' => array(),
				'class' => array()
			),
			'section' => array(
				'id' => array(),
				'class' => array()
			),
			'h3' => array(
				'class' => array()
			)
		);

		$admin = false;
		$author = get_the_author_meta( 'ID' );
		if ( ! $author ) {
			$admin = get_users( array( 'role' => 'administrator' ) );
			$admin = $admin[0];
			$author = get_the_author_meta( 'ID', $admin->ID );// set admin
		}
		$authors_setting = get_field( 'global_author_social_links', 'option' );

		echo wp_kses( $before_widget, $allowed_tags );
		$title = $this->getInstance( 'title' );
		if ( ! empty( $title ) ) {
			echo wp_kses( $before_title . esc_html( $title ) . $after_title, $allowed_tags );
		}
		printf( '<img src="%s" alt="' . esc_html__( 'Author avatar', 'argenta_extra' ) . '" />', get_avatar_url( $author ) );
		?>
			<div class="info">
				<div class="info-wrap">
					<div class="socialbar">
					<?php
					if ( $authors_setting && is_array( $authors_setting ) ) {
						foreach ( $authors_setting as $author_setting ) {
							if ( isset( $author_setting['author'] ) && $author == $author_setting['author']['ID'] ) {
								foreach ( $author_setting['links'] as $author_link ) {
									echo '<a href="' . esc_url( $author_link['url'] ) . '" class="social">';
									switch ($author_link['social_networks']) {
										case 'facebook':
											echo '<span class="ion-social-facebook"></span>';
											break;
										case 'twitter':
											echo '<span class="ion-social-twitter"></span>';
											break;
										case 'youtube':
											echo '<span class="ion-social-youtube-outline"></span>';
											break;
										case 'google_plus':
											echo '<span class="ion-social-googleplus"></span>';
											break;
										case 'linkedin':
											echo '<span class="ion-social-linkedin-outline"></span>';
											break;
										case 'pinterest':
											echo '<span class="ion-social-pinterest-outline"></span>';
											break;
										case 'vimeo':
											echo '<span class="ion-social-vimeo"></span>';
											break;
										case 'github':
											echo '<span class="ion-social-github"></span>';
											break;
									}
									echo '</a>';
								}
								break;
							}
						}
					}
					?>
					</div>
			<?php
				if ( ! $admin ) {
					printf( '<h4>%s</h4>', esc_html( get_the_author() ) );
					printf( '<span class="site">%s</span>', get_the_author_meta( 'url', $author ) );
				} else {
					printf( '<h4>%s</h4>', esc_html( $admin->display_name ) );
					printf( '<span class="site">%s</span>', get_the_author_meta( 'url', $admin->ID ) );
				}
			?>
				</div>
			</div>
			<div class="clear"></div>
			<div class="content">
			<?php
				if ( ! $admin ) {
					echo get_the_author_meta( 'description', $author );
				} else {
					echo get_the_author_meta( 'description', $admin->ID );
				}
			?>
			</div>
		<?php
		echo wp_kses( $after_widget, $allowed_tags );
	}

}

register_widget( 'argenta_widget_about_author' );