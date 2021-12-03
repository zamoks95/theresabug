<?php
	// Settings
	$is_fixed = \Argenta\Settings::header_is_fixed();
	$use_wrapper = \Argenta\Settings::header_use_wrapper();
	$show_search = ! \Argenta\Settings::get( 'header_hide_search', 'global' );
?>

<header id="masthead" class="site-header dark-text header-4"<?php if ( $is_fixed ) { echo ' data-header-fixed="true"'; } ?>>
	<div class="header-wrap">
		
		<?php get_template_part( 'template-parts/elements/header-menu-logo' ); ?>

		<div class="menu-wrap">
			<?php if ( $use_wrapper ) : ?>
			<div class="wrapped-container">
			<?php endif; ?>
				<div class="wrap">
					<?php if ( $show_search ) : ?>
					<ul class="menu-other left">
						<li>
							<a href="#" class="search" data-nav-search="true">
								<span class="icon ion-ios-search"></span>
							</a>
						</li>
					</ul>
					<?php endif; ?>
					<?php get_template_part( 'template-parts/elements/header-menu-nav' ); ?>
					<?php get_template_part( 'template-parts/elements/header-menu-optional-nav' ); ?>
					<?php get_template_part( 'template-parts/elements/header-menu-hamburger' ); ?>
					<div class="close-menu"></div>
				</div>
			<?php if ( $use_wrapper ) : ?>
			</div>
			<?php endif; ?>
		</div><!-- .menu-wrap -->
	</div><!-- .header-wrap -->
</header><!-- #masthead -->

<?php get_template_part( 'template-parts/elements/header-menu-fullscreen-nav' ); ?>