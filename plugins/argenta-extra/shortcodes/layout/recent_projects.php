<div class="recent_projects_wrapper" id="<?php echo $recent_projects_uniqid; ?>">
<?php if ( $projects_layout == 'grid' ) : ?>

	<?php if ( $show_projects_filter ) : ?>
		<?php
			if ( is_array( $projects_category ) ) {
				$cat_ids = get_terms( array( 
					'taxonomy' => 'argenta_portfolio_category',
					'include' => $projects_category,
					'hide_empty' => false
				) );
			} else {
				$cat_ids = get_terms( array(
					'taxonomy' => 'argenta_portfolio_category',
					'hide_empty' => false
				) );
			}
			if ( is_array( $cat_ids ) && $cat_ids ) :
		?>
		<div class="portfolio-sorting<?php echo $filter_align_class; ?>" data-filter="portfolio">
			<div class="title brand-color"><?php _e( 'Filter by:', 'argenta_extra' ); ?></div>
			<ul class="unstyled">
				<li><a class="active" href="#all" data-isotope-filter="*"><?php _e( 'All', 'argenta_extra' ); ?></a></li>
				<?php
					foreach ( $cat_ids as $cat_obj ) {
						$slug_hash = hash( 'md4', $cat_obj->slug, false );
						echo '<li><a href="#' . $slug_hash  . '" data-isotope-filter=".argenta-filter-project-' . $slug_hash  . '">' . $cat_obj->name . '</a></li>';
					}
				?>
			</ul>
		</div>
		<?php endif; ?>
	<?php endif; ?>
	
	<div class="vc_row blog-posts-masonry<?php echo $css_class; ?>" data-isotope-grid="true">
		<?php foreach ( $projects_data as $project_index => $_project_object ) : ?>
		<?php 
			$argenta_project = argenta_extra_get_project_settings( $_project_object );
			$argenta_project['in_popup'] = $open_in_popup;
			$argenta_project['loop_popup_slider'] = $loop_popup_slider;
			argenta_gh_set_current_item_data( $argenta_project );

			$col_class = $column_class;
			if ( $argenta_project['grid_style'] == '2col' ) {
				$col_class = $column_double_class;
			}

			echo '<div class="' . $col_class . ( ( $projects_solid ) ? ' post-offset' : '' ) . (( $argenta_project['grid_style'] != '2col' ) ? ' grid-item' : '') . ' blog-post-masonry illustration argenta-project-item ' . $argenta_project['categories_group'] . '">';

			switch ( $card_layout ) {
				case 'default':
					include( locate_template( 'template-parts/portfolio-cards/default.php' ) );
					break;
				case '_special_demo':
					include( locate_template( 'template-parts/portfolio-cards/_special_demo.php' ) );
					break;
				case 'default_show_now':
					include( locate_template( 'template-parts/portfolio-cards/default_show_now.php' ) );
					break;
				case 'default_panel_show_now':
					include( locate_template( 'template-parts/portfolio-cards/default_panel_show_now.php' ) );
					break;
				case 'default_with_description':
					include( locate_template( 'template-parts/portfolio-cards/default_with_description.php' ) );
					break;
				case 'inner_show_now':
					include( locate_template( 'template-parts/portfolio-cards/inner_show_now.php' ) );
					break;
				case 'inner_panel':
					include( locate_template( 'template-parts/portfolio-cards/inner_panel.php' ) );
					break;
				case 'inner_wide_centred':
					include( locate_template( 'template-parts/portfolio-cards/inner_wide_centred.php' ) );
					break;
				case 'inner_padding_bottom':
					include( locate_template( 'template-parts/portfolio-cards/inner_padding_bottom.php' ) );
					break;
				default:
					include( locate_template( 'template-parts/portfolio-cards/default.php' ) );
					break;
			}

			if ( $argenta_project['in_popup'] ) {
				ob_start();
				argenta_gh_set_current_item_data( $argenta_project );
				include( locate_template( 'template-parts/portfolio-cards/_popup.php' ) );
				\Argenta\Layout::append_to_footer_buffer_content( ob_get_clean() );
			}
		?>
			<div class="clear"></div>
		</div>
	<?php endforeach; ?>
	</div>
<?php endif; ?>


<?php if ( $projects_layout == 'slider' ) : ?>
	<div class="vc_row<?php echo $css_class; ?>">
		<div class="slider<?php echo $slider_class; ?><?php echo $css_class; ?>" id="<?php echo $recent_projects_uniqid; ?>" data-slider="true"	data-slide-by="<?php echo $slide_by; ?>" data-autoplay-time="<?php echo $autoplay_time; ?>" data-autoplay="<?php echo $autoplay; ?>" data-nav="<?php echo $navigation_buttons; ?>" data-pagination="<?php echo $pagination_show; ?>" data-loop="<?php echo $loop; ?>" data-items-desktop="<?php echo $item_desktop; ?>" data-items-tablet="<?php echo $item_tablet; ?>" data-items-mobile="<?php echo $item_mobile; ?>" data-stop-hover="<?php echo $stop_on_hover; ?>">
		<?php foreach ($projects_data as $project_index => $_project_object) : ?>
		<?php 
			$argenta_project = argenta_extra_get_project_settings( $_project_object );
			$argenta_project['in_popup'] = $open_in_popup;
			$argenta_project['loop_popup_slider'] = $loop_popup_slider;
			$_columns_num_class = $columns_num_class; // reserve
			if ( $argenta_project['grid_style'] == '2col' && $argenta_project['grid_style'] != '12' ) {
				$columns_num_class = intval( $columns_num_class ) * 2; // wide grid item
			}
			echo '<div class="slider-wrap">';
			$columns_num_class = $_columns_num_class;
			argenta_gh_set_current_item_data( $argenta_project );
			
			include( locate_template( 'template-parts/portfolio-cards/inner_wide_centred.php' ) );
			echo '</div>';
			
			if ( $argenta_project['in_popup'] ) {
				ob_start();
				argenta_gh_set_current_item_data( $argenta_project );
				include( locate_template( 'template-parts/portfolio-cards/_popup.php' ) );
				\Argenta\Layout::append_to_footer_buffer_content( ob_get_clean() );
			}
		?>
		<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $filter_css ) {
			$_style_block .= '#' . $recent_projects_uniqid . ' .portfolio-sorting ul li a{';
			$_style_block .= $filter_css;
			$_style_block .= '}';
		}
		if ( $filter_accent_css ) {
			$_style_block .= '#' . $recent_projects_uniqid . ' .portfolio-sorting ul li a.active,';
			$_style_block .= '#' . $recent_projects_uniqid . ' .portfolio-sorting .title{';
			$_style_block .= $filter_accent_css;
			$_style_block .= '}';
		}
		if ( $items_css ) {
			$_style_block .= '#' . $recent_projects_uniqid . ' .owl-item{';
			$_style_block .= $items_css;
			$_style_block .= '}';
		}
		if ( $dots_css ) {
			$_style_block .= '#' . $recent_projects_uniqid . ' .owl-controls .owl-dots .owl-dot{';
			$_style_block .= $dots_css;
			$_style_block .= '}';
			$_style_block .= '#' . $recent_projects_uniqid . ' .owl-controls .owl-dots .owl-dot.active{';
			$_style_block .= 'background-color:transparent;';
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>