<div class="vc_row blog-posts-masonry" id="<?php echo $recent_posts_uniqid; ?>">
	<?php
	foreach ($posts_data as $post_index => $_post_object) {
		$argenta_post = argenta_extra_parse_post_object( $_post_object );
		$argenta_post['boxed'] = $card_boxed;
		argenta_gh_set_current_item_data( $argenta_post );

		$col_class = $column_class;
		if ( $argenta_post['grid_style'] == '2col' ) {
			$col_class = $column_double_class;
		}

		echo '<div class="' . $col_class . (( $argenta_post['grid_style'] != '2col' ) ? ' grid-item' : '') . ' blog-post-masonry post-offset">';

		switch ( $card_layout ) {
			case 'default':
				include( locate_template( 'template-parts/blog/default.php' ) );
				break;
			case 'without_excerpt':
				include( locate_template( 'template-parts/blog/without_excerpt.php' ) );
				break;
			case 'date_top':
				include( locate_template( 'template-parts/blog/date_top.php' ) );
				break;
			case 'inner':
				include( locate_template( 'template-parts/blog/inner.php' ) );
				break;
			case 'inner_with_description':
				include( locate_template( 'template-parts/blog/inner_with_description.php' ) );
				break;
			default:
				include( locate_template( 'template-parts/blog/default.php' ) );
				break;
		}
		echo '<div class="clear"></div>';
		echo '</div>';
	}
	?>
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $items_css ) {
			$_style_block .= '#' . $recent_posts_uniqid . ' .blog-post-masonry{';
			$_style_block .= $items_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>