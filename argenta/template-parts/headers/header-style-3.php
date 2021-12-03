<?php
	// Settings
	$is_fixed = \Argenta\Settings::header_is_fixed();
	$add_header_cap = \Argenta\Settings::header_cap_is_displayed();
?>

<header id="masthead" class="site-header dark-text header-3<?php if ( $add_header_cap ) { echo ' with-header-cap'; } ?>"<?php if ( $is_fixed ) { echo ' data-header-fixed="true"'; } ?>>
	<div class="wrapped-container">
		<div class="header-wrap">
			<?php get_template_part( 'template-parts/elements/header-menu-logo' ); ?>
			<div class="right">
				<?php get_template_part( 'template-parts/elements/header-menu-nav' ); ?>
				<?php get_template_part( 'template-parts/elements/header-menu-optional-nav' ); ?>
				<?php get_template_part( 'template-parts/elements/header-menu-hamburger' ); ?>
				<div class="close-menu"></div>
			</div>
		</div>
	</div><!-- .header-wrap -->
</header><!-- #masthead -->

<?php get_template_part( 'template-parts/elements/header-menu-fullscreen-nav' ); ?>