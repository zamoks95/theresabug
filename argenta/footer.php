<?php
	// Settings
	$hide_footer_setting = \Argenta\Settings::footer_is_hidden();
	$footer_wrapped = \Argenta\Settings::footer_is_wrapped();
	$footer_is_sticky = \Argenta\Settings::footer_is_sticky();
	$show_copyright = \Argenta\Settings::footer_copytight_is_displayed();
	$copyright_text = \Argenta\Settings::get( 'footer_copyright_text', 'global' );
	if ( $copyright_text === NULL && $show_copyright === NULL ) {
		$copyright_text = '&copy; 2020, Argenta theme by <a href="https://clbthemes.com">Colabrio</a>. All rights reserved.';
		$show_copyright = true;
	}
	$hide_footer_layout = ( $hide_footer_setting ) ? true : false;

	$project_layout_type = \Argenta\Settings::get( 'project_layout_type' );
	if ( $project_layout_type == 'inherit' ) {
		$project_layout_type = \Argenta\Settings::get( 'project_layout_type', 'global' );
	}
	if ( $project_layout_type == 'style_7' ) {
		$hide_footer_layout = true;
		$show_copyright = false;
	}

	$footer_widgets_count = 0;
	if ( is_active_sidebar( 'argenta-sidebar-footer-1' ) ) $footer_widgets_count++;
	if ( is_active_sidebar( 'argenta-sidebar-footer-2' ) ) $footer_widgets_count++;
	if ( is_active_sidebar( 'argenta-sidebar-footer-3' ) ) $footer_widgets_count++;
	if ( is_active_sidebar( 'argenta-sidebar-footer-4' ) ) $footer_widgets_count++;

	$header_menu_style = \Argenta\Settings::header_menu_style();
?>
	</div><!-- #content -->
	
	<?php if ( ! $hide_footer_setting || ( $show_copyright && $copyright_text ) ) : ?>
	<footer id="colophon" class="site-footer<?php if ( $footer_is_sticky ) { echo ' sticky'; } ?>">

		<?php if ( ! $hide_footer_setting ) : ?>
		<div class="<?php echo esc_attr( $footer_wrapped ) ? 'wrapped-container' : 'full-width-container'; ?>">
			<?php if ( $footer_widgets_count > 0 ) : ?>
			<div class="widgets">
				<?php if ( is_active_sidebar('argenta-sidebar-footer-1') ) : ?>
				<div class="vc_col-md-<?php echo esc_attr( intval( 12 / $footer_widgets_count ) ); ?> widgets-column">
					<ul><?php dynamic_sidebar( 'argenta-sidebar-footer-1' ); ?></ul>
				</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'argenta-sidebar-footer-2' ) ) : ?>
				<div class="vc_col-md-<?php echo esc_attr( intval( 12 / $footer_widgets_count ) ); ?> widgets-column">
					<ul><?php dynamic_sidebar( 'argenta-sidebar-footer-2' ); ?></ul>
				</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar('argenta-sidebar-footer-3') ) : ?>
				<div class="vc_col-md-<?php echo esc_attr( intval( 12 / $footer_widgets_count ) ); ?> widgets-column">
					<ul><?php dynamic_sidebar( 'argenta-sidebar-footer-3' ); ?></ul>
				</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar('argenta-sidebar-footer-4') ) : ?>
				<div class="vc_col-md-<?php echo esc_attr( intval( 12 / $footer_widgets_count ) ); ?> widgets-column">
					<ul><?php dynamic_sidebar( 'argenta-sidebar-footer-4' ); ?></ul>
				</div>
				<?php endif; ?>
				<div class="clear"></div>
			</div>
			<?php endif; ?>
		</div><!-- wrapper -->
		<?php endif; ?>

		<?php if ( $show_copyright && $copyright_text ) : ?>
		<div class="site-info">
			<?php
            $allowed_html = array(
                'a' => array(
                    'href'  => true,
                    'title' => true,
                    'target' => true,
                ),
                'em'     => array(),
                'strong' => array()
            );
            echo wp_kses($copyright_text, $allowed_html ); ?>
		</div><!-- .site-info -->
		<?php endif; ?>

	</footer><!-- #colophon -->
	<?php endif; ?>

</div><!-- #page -->

<?php if ( $header_menu_style == 'style6' ) : ?>
</div><!--.content-right-->
<?php endif; ?>

<?php if ( \Argenta\Settings::page_is_boxed() ) : ?>
</div> <!-- .boxed-container -->
<?php endif; ?>

<?php \Argenta\Layout::get_footer_buffer_content( true ); ?>

<style><?php \Argenta\Layout::get_shortcodes_css_buffer( true ); ?></style>


<?php wp_footer(); ?>
</body>
</html>
