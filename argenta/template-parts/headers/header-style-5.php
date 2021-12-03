<?php
	// Settings
	$is_fixed = \Argenta\Settings::header_is_fixed();
	$use_wrapper = \Argenta\Settings::header_use_wrapper();
?>

<header id="masthead" class="site-header light-text header-5"<?php if ( $is_fixed ) { echo ' data-header-fixed="true"'; } ?>>
	<div class="header-wrap<?php if ( $use_wrapper ) { echo ' wrapped-container'; }; ?>">
		<?php get_template_part( 'template-parts/elements/header-menu-logo' ); ?>
		<div class="menu-wrap">
			<div class="wrap">
				<?php get_template_part( 'template-parts/elements/header-menu-nav' ); ?>
				<?php get_template_part( 'template-parts/elements/header-menu-optional-nav' ); ?>
				<?php get_template_part( 'template-parts/elements/header-menu-hamburger' ); ?>
				<div class="close-menu"></div>
			</div>
		</div>
	</div><!-- .header-wrap -->
</header><!-- .header-top -->

<?php get_template_part( 'template-parts/elements/header-menu-fullscreen-nav' ); ?>