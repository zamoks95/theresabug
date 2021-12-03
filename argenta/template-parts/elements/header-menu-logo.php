<?php
	$logo = \Argenta\Settings::get_logo();
	$logo_for_fixed = \Argenta\Settings::get_logo( false, true );
	$logo_as_image = is_array( $logo );
	$logo_for_fixed_as_image = is_array( $logo_for_fixed );
?>

<div class="site-branding">
	<p class="site-title">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<span class="first-logo">
				<?php if ( $logo_as_image ) : ?>
					<?php if ( $logo['default'] || $logo['retina'] || $logo['mobile'] ) : ?>
						<?php if ( $logo['mobile'] ) : ?>
							<?php if ( $logo['default'] || $logo['retina'] ) : ?>
								<img src="<?php echo esc_url( ( $logo['default'] ) ? $logo['default'] : $logo['retina'] ); ?>" class="logo-hidden-sm <?php if ( $logo['have_vector'] ) { echo ' svg-logo'; } ?>"<?php if ( $logo['retina'] ) { echo ' srcset="' . $logo['retina'] . ' 2x"'; } ?> alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
							<?php endif; ?>
							<img src="<?php echo esc_url( $logo['mobile'] ); ?>" class="logo-visible-sm<?php if ( $logo['have_vector'] ) { echo ' svg-logo'; } ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						<?php else: ?>
							<?php if ( $logo['default'] || $logo['retina'] ) : ?>
								<img src="<?php echo esc_url( ( $logo['default'] ) ? $logo['default'] : $logo['retina'] ); ?>" <?php if ( $logo['have_vector'] ) { echo ' class="svg-logo"'; } ?><?php if ( $logo['retina'] ) { echo ' srcset="' . $logo['retina'] . ' 2x"'; } ?> alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php else : ?>
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				<?php endif; ?>
			</span>
			
			<span class="second-logo">
				<?php if ( $logo_for_fixed_as_image ) : ?>
					<?php if ( $logo_for_fixed['default'] || $logo_for_fixed['retina'] || $logo_for_fixed['mobile'] ) : ?>
						<?php if ( $logo_for_fixed['mobile'] ) : ?>
							<?php if ( $logo_for_fixed['default'] || $logo_for_fixed['retina'] ) : ?>
								<img src="<?php echo esc_url( ( $logo_for_fixed['default'] ) ? $logo_for_fixed['default'] : $logo_for_fixed['retina'] ); ?>" class="logo-hidden-sm <?php if ( $logo_for_fixed['have_vector'] ) { echo ' svg-logo'; } ?>"<?php if ( $logo_for_fixed['retina'] ) { echo ' srcset="' . $logo_for_fixed['retina'] . ' 2x"'; } ?> alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
							<?php endif; ?>
							<img src="<?php echo esc_url( $logo_for_fixed['mobile'] ); ?>" class="logo-visible-sm<?php if ( $logo_for_fixed['have_vector'] ) { echo ' svg-logo'; } ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						<?php else: ?>
							<?php if ( $logo_for_fixed['default'] || $logo_for_fixed['retina'] ) : ?>
								<img src="<?php echo esc_url( ( $logo_for_fixed['default'] ) ? $logo_for_fixed['default'] : $logo_for_fixed['retina'] ); ?>" <?php if ( $logo_for_fixed['have_vector'] ) { echo ' class="svg-logo"'; } ?><?php if ( $logo_for_fixed['retina'] ) { echo ' srcset="' . $logo_for_fixed['retina'] . ' 2x"'; } ?> alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php else : ?>
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				<?php endif; ?>
			</span>
		</a>
	</p>
</div><!-- .site-branding -->