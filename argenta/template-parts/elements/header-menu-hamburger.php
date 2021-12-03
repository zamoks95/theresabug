<?php
	// Settings
	$menu_type = \Argenta\Settings::menu_type();
?>

<div class="hamburger-menu" id="hamburger-menu">
	<a class="btn-toggle" aria-controls="site-navigation" aria-expanded="false">
		<span class="btn-lines"></span>
	</a>
</div>
<?php if ( $menu_type == 'hamburger' ) : ?>
	<div class="hamburger-menu" id="hamburger-fullscreen-menu">
		<a class="btn-toggle" aria-controls="site-navigation" aria-expanded="false">
			<span class="btn-lines"></span>
		</a>
	</div>
<?php endif; ?>