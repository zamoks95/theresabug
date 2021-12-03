<?php
	// Settings
	$show_header_title = \Argenta\Settings::header_title_is_displayed();
	$header_subtitle_type = \Argenta\Settings::header_subtitle_type();
	$show_header_subtitle = (bool) ( $header_subtitle_type != 'without' );
	$show_header_cap = \Argenta\Settings::header_cap_is_displayed();
	$header_subtitle_custom_text = \Argenta\Settings::header_subtitle_custom_text();
	$full_height = \Argenta\Settings::header_title_is_full_height();
	$full_height_class = ( $full_height ) ? ' title-full' : '';

	$title_align = \Argenta\Settings::header_title_align();
	$title_align_class = '';
	if ( $title_align == 'left' ) {
		$title_align_class = ' text-left';
	} elseif ( $title_align == 'right' ) {
		$title_align_class = ' text-right';
	} else {
		$title_align_class = ' text-center';
	}

	$page_wrapped = \Argenta\Settings::page_is_wrapped();

	// Title and subtitle
	$title_text = get_the_title();
	$subtitle_text = wp_kses( \Argenta\Settings::get( 'header_subtitle' ), 'default' );

	if ( \Argenta\Settings::page_is( 'home' ) ) {
		$title_text = esc_html__( 'Blog', 'argenta' );
		$subtitle_text = esc_html__( 'Our recent posts', 'argenta' );
	} else if ( \Argenta\Settings::page_is( 'category' ) ) {
		$title_text = single_cat_title( '', false ); 
		$subtitle_text = __( 'Category', 'argenta' );
	} elseif ( \Argenta\Settings::page_is( 'tag' ) ) {
		$title_text = single_tag_title( '', false ); 
		$subtitle_text = __( 'Tag', 'argenta' );
	} elseif ( \Argenta\Settings::page_is( 'search' ) ) {
		$title_text =  esc_html__( 'Search Results for: ', 'argenta' ) . '<span>' . get_search_query() . '</span>';
		$subtitle_text = false;
	} elseif ( is_day() ) {
		$title_text = get_the_time( 'F' ) . ' ' . get_the_time( 'd' ) . ', ' . get_the_time( 'Y' );
		$subtitle_text = 'Posts by date';
	} elseif ( is_month() ) {
		$title_text = get_the_time( 'F' ) . ' ' . get_the_time( 'Y' );
		$subtitle_text = false;
	} elseif ( is_year() ) {
		$title_text = get_the_time( 'Y' );
		$subtitle_text = false;
	} elseif ( \Argenta\Settings::page_is( 'single' ) ) {
		if ( ! $title_text ) {
			$title_text = '[' . get_the_date( get_option( 'date_format' ), $post->ID ) . ']';
		}
		if ( $header_subtitle_type == 'generated' ) {
			ob_start();
			argenta_gh_posted_on();
			$subtitle_text = ob_get_clean();
		}
		if ( $header_subtitle_type == 'custom' ) {
			$subtitle_text = $header_subtitle_custom_text;
		}
	} elseif ( \Argenta\Settings::page_is( 'project' ) ) {
		if ( ! $title_text ) {
			$title_text = '[' . get_the_date( get_option( 'date_format' ), $post->ID ) . ']';
		}
		$subtitle_text = \Argenta\Settings::get( 'header_subtitle' );
	} elseif ( \Argenta\Settings::page_is( 'author' ) ) {
		$author = get_the_author();
		$title_text = ( $author ) ? $author : esc_html__( 'Undefined', 'argenta' );
		$subtitle_text = esc_html__( 'Author', 'argenta' );
	} elseif ( \Argenta\Settings::page_is( 'product' ) ) {
		$subtitle_text = wp_kses( \Argenta\Settings::get( 'woocommerce_header_subtitle', 'global' ), 'default' );
	} elseif ( \Argenta\Settings::page_is( 'shop' ) ) {
		$title_text = esc_html__( 'Shop', 'argenta' );
	} elseif ( \Argenta\Settings::page_is( 'product_category' ) ) {
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		$title_text = $cat->name;
		$subtitle_text = esc_html__( 'Product category', 'argenta' );
	} elseif ( \Argenta\Settings::page_is( 'product_tag' ) ) {
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		$title_text = $cat->name;
		$subtitle_text = esc_html__( 'Product tag', 'argenta' );
	} elseif ( \Argenta\Settings::page_is( 'page' ) ) {
		$subtitle_text = \Argenta\Settings::get( 'header_subtitle' );
	}
?>

<?php if ( $show_header_title ) : ?>
<div class="header-title<?php if ( ! $show_header_cap ) { echo ' without-cap'; } echo esc_attr( $full_height_class ) . esc_attr( $title_align_class ); ?>">
	<div class="title-wrap">
		<div class="content">
		
			<div class="<?php echo esc_attr( $page_wrapped ) ? 'wrapped-container' : 'full-width-container'; ?>">
				<h1 class="page-title"><?php echo wp_kses( $title_text, 'default' ); ?></h1>
				<?php if ( $subtitle_text && $show_header_subtitle ) : ?>
					<br>
					<p class="subtitle"><?php echo wp_kses($subtitle_text, 'post'); ?></p>
				<?php endif; ?>
			</div>

		</div>
	</div>
</div> <!-- .header-title -->
<?php endif;