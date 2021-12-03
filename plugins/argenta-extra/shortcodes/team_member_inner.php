<?php 

	/**
	* Visual Composer Argenta Team member inner shortcode
	*/

	add_shortcode( 'argenta_sc_team_member_inner', 'argenta_sc_team_member_inner_func' );

	function argenta_sc_team_member_inner_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$name = ( isset( $name ) ) ? argenta_extra_filter_string( $name, 'string', '' ) : '';
		$position = ( isset( $position ) ) ? argenta_extra_filter_string( $position, 'string', '' ) : '';
		$description = ( isset( $description ) ) ? argenta_extra_filter_string( $description, 'textarea', '' ) : '';
		$photo = ( isset( $photo ) ) ? argenta_extra_filter_string( wp_get_attachment_url( argenta_extra_filter_string( $photo ) ), 'attr' ) : false;
		$facebook_link = ( isset( $facebook_link ) ) ? argenta_extra_filter_string( $facebook_link, 'url' ) : false;
		$twitter_link = ( isset( $twitter_link ) ) ? argenta_extra_filter_string( $twitter_link, 'url' ) : false;
		$dribbble_link = ( isset( $dribbble_link ) ) ? argenta_extra_filter_string( $dribbble_link, 'url' ) : false;
		$pinterest_link = ( isset( $pinterest_link ) ) ? argenta_extra_filter_string( $pinterest_link, 'url' ) : false;
		$github_link = ( isset( $github_link ) ) ? argenta_extra_filter_string( $github_link, 'url' ) : false;
		$instagram_link = ( isset( $instagram_link ) ) ? argenta_extra_filter_string( $instagram_link, 'url' ) : false;
		$linkedin_link = ( isset( $linkedin_link ) ) ? argenta_extra_filter_string( $linkedin_link, 'url' ) : false;
		$name_typo = ( isset( $name_typo ) ) ? argenta_extra_filter_string( $name_typo ) : false;
		$position_typo = ( isset( $position_typo ) ) ? argenta_extra_filter_string( $position_typo ) : false;
		$desription_typo = ( isset( $desription_typo ) ) ? argenta_extra_filter_string( $desription_typo ) : false;
		$name_color = ( isset( $name_color ) ) ? argenta_extra_filter_string( $name_color ) : false;
		$position_color = ( isset( $position_color ) ) ? argenta_extra_filter_string( $position_color ) : false;
		$desc_color = ( isset( $desc_color ) ) ? argenta_extra_filter_string( $desc_color ) : false;
		$social_color = ( isset( $social_color ) ) ? argenta_extra_filter_string( $social_color ) : false;
		$social_hover_color = ( isset( $social_hover_color ) ) ? argenta_extra_filter_string( $social_hover_color ) : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Styling
		$team_member_uniqid = uniqid( 'argenta-custom-' );

		$name_css = argenta_extra_parse_VC_typography_to_CSS( $name_typo ) . ( ( $name_color ) ? 'color: ' . $name_color . ';' : '' );
		$position_css = argenta_extra_parse_VC_typography_to_CSS( $position_typo ) . ( ( $position_color ) ? 'color: ' . $position_color . ';' : '' );
		$description_css = argenta_extra_parse_VC_typography_to_CSS( $desription_typo ) . ( ( $desc_color ) ? 'color: ' . $desc_color . ';' : '' );
		$social_css = ( $social_color ) ? 'color: ' . $social_color . '; border-color: ' . $social_color . ';' : '';
		$social_hover_css = ( $social_hover_color ) ? 'background: ' . $social_hover_color . '; border-color: ' . $social_hover_color . '; color: #ffffff;' : '';
		$name_css = $name_css ? $name_css : false;
		$position_css = $position_css ? $position_css : false;
		$description_css = $description_css ? $description_css : false;
		$social_css = $social_css ? $social_css : false;
		$social_hover_css = $social_hover_css ? $social_hover_css : false;

		$element_custom_fonts = array();
		$name_custom_font = argenta_extra_parse_VC_typography_custom_font( $name_typo );
		if ( $name_custom_font ) {
			$element_custom_fonts[] = $name_custom_font;
		}
		$position_custom_font = argenta_extra_parse_VC_typography_custom_font( $position_typo );
		if ( $position_custom_font ) {
			$element_custom_fonts[] = $position_custom_font;
		}
		$description_custom_font = argenta_extra_parse_VC_typography_custom_font( $desription_typo );
		if ( $description_custom_font ) {
			$element_custom_fonts[] = $description_custom_font;
		}

		$with_styles = ( $name_css || $position_css || $description_css || $social_css || $social_hover_css || count( $element_custom_fonts ) > 0 );

		$social_bar = ( $facebook_link || $twitter_link || $dribbble_link || $pinterest_link || $github_link || $instagram_link || $linkedin_link );

		// Assembling
		ob_start();
		include( 'layout/team_member_inner.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
		'name' => __( 'Team Member', 'argenta_extra' ),
		'description' => __( 'Team member module', 'argenta_extra' ),
		'base' => 'argenta_sc_team_member_inner',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-TeamMember.png',
		'content_element' => true,
		'as_child' => array(
			'only' => 'argenta_sc_team_member_group'
		),
		'js_view' => 'VcArgentaTeamMemberInnerView',
		'custom_markup' => '{{title}}<div class="vc_argenta_team_member_inner-container">
				<div class="_contain">
					<div class="photo" style="background-image: url(\'' . plugin_dir_url( __FILE__ ) . 'images/sc_user_gap.png\');"></div>
					<div class="right">
						<div class="name">%%name%%</div>
						<div class="position"></div>
						<div class="lines"><div class="line"></div><div class="line"></div><div class="line"></div><div class="line"></div></div>
					</div>
				</div>
			</div>',
		'params' => array(
			// General
			array(
				'type' => 'attach_image',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Photo', 'argenta_extra' ),
				'param_name' => 'photo',
				'description' => __( 'Choose member photo.', 'argenta_extra' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'em',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Name', 'argenta_extra' ),
				'param_name' => 'name',
				'description' => __( 'Team member name.', 'argenta_extra' ),
			),
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Position', 'argenta_extra' ),
				'param_name' => 'position',
				'description' => __( 'For example, <strong>Product manager at Colabr.io</strong>.', 'argenta_extra' ),
			),
			array(
				'type' => 'textarea',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Description', 'argenta_extra' ),
				'param_name' => 'description',
				'description' => __( 'Tell what this remarkable team member in your team.', 'argenta_extra' ),
			),

			// Soc links
			array(
				'type' => 'textfield',
				'group' => __( 'Social links', 'argenta_extra' ),
				'heading' => '<em class="argenta_is ion-social-facebook"></em>' . __( 'Facebook link', 'argenta_extra' ),
				'param_name' => 'facebook_link'
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Social links', 'argenta_extra' ),
				'heading' => '<em class="argenta_is ion-social-twitter"></em>' . __( 'Twitter link', 'argenta_extra' ),
				'param_name' => 'twitter_link'
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Social links', 'argenta_extra' ),
				'heading' => '<em class="argenta_is ion-social-dribbble-outline"></em>' . __( 'Dribbble link', 'argenta_extra' ),
				'param_name' => 'dribbble_link'
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Social links', 'argenta_extra' ),
				'heading' => '<em class="argenta_is ion-social-pinterest-outline"></em>' . __( 'Pinterest link', 'argenta_extra' ),
				'param_name' => 'pinterest_link'
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Social links', 'argenta_extra' ),
				'heading' => '<em class="argenta_is ion-social-github"></em>' . __( 'Github link', 'argenta_extra' ),
				'param_name' => 'github_link'
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Social links', 'argenta_extra' ),
				'heading' => '<em class="argenta_is ion-social-instagram-outline"></em>' . __( 'Instagram link', 'argenta_extra' ),
				'param_name' => 'instagram_link'
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Social links', 'argenta_extra' ),
				'heading' => '<em class="argenta_is ion-social-linkedin-outline"></em>' . __( 'LinkedIn link', 'argenta_extra' ),
				'param_name' => 'linkedin_link'
			),

			/* Typography */
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'typo_tab_divider_name',
				'value' => __( 'Name', 'argenta_extra' ),
			),
			array(
				'type' => 'argenta_typography',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'name_typo',
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'typo_tab_divider_position',
				'value' => __( 'Position', 'argenta_extra' ),
			),
			array(
				'type' => 'argenta_typography',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'position_typo',
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'typo_tab_divider_description',
				'value' => __( 'Description', 'argenta_extra' ),
			),
			array(
				'type' => 'argenta_typography',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'desription_typo',
			),

			/* Styles */
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'param_name' => 'style_tab_divider_content',
				'value' => __( 'Content', 'argenta_extra' ),
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Name color', 'argenta_extra' ),
				'param_name' => 'name_color',
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Position text color', 'argenta_extra' ),
				'param_name' => 'position_color',
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Description color', 'argenta_extra' ),
				'param_name' => 'desc_color',
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Social buttons color', 'argenta_extra' ),
				'param_name' => 'social_color',
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'param_name' => 'style_tab_divider_hover',
				'value' => __( 'Hover colors', 'argenta_extra' ),
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Social buttons hover color', 'argenta_extra' ),
				'param_name' => 'social_hover_color',
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'param_name' => 'style_tab_divider_other',
				'value' => __( 'Other', 'argenta_extra' ),
			),
			array(
				'type' => 'dropdown',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Appearance effect', 'argenta_extra' ),
				'param_name' => 'appearance_effect',
				'value' => array(
					__( 'None', 'argenta_extra' ) => 'none',
					__( 'Fade up', 'argenta_extra' ) => 'fade-up',
					__( 'Fade down', 'argenta_extra' ) => 'fade-down',
					__( 'Fade right', 'argenta_extra' ) => 'fade-right',
					__( 'Fade left', 'argenta_extra' ) => 'fade-left',
					__( 'Flip up', 'argenta_extra' ) => 'flip-up',
					__( 'Flip down', 'argenta_extra' ) => 'flip-down',
					__( 'Zoom in', 'argenta_extra' ) => 'zoom-in',
					__( 'Zoom out', 'argenta_extra' ) => 'zoom-out'
				)
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Appearance effect duration', 'argenta_extra' ),
				'param_name' => 'appearance_duration',
				'description' => __( 'Duration accept values from 50ms to 3000ms, with step 50ms', 'argenta_extra' ),
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Custom CSS class', 'argenta_extra' ),
				'param_name' => 'css_class',
				'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra' )
			),
		)
	) );