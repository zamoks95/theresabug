<?php
	argenta_gh_add_required_script( 'project-scroll' );
	argenta_gh_add_required_script( 'one-page-scroll' );

	$project_layout_type = \Argenta\Settings::get( 'project_layout_type' );
	if ( $project_layout_type == 'inherit' ) {
		$project_layout_type = \Argenta\Settings::get( 'project_layout_type', 'global' );
	}

	get_header();
?>

<?php get_template_part( 'template-parts/elements/header-title' ); ?>

<?php
	if ( ! post_password_required() ) {
		switch ( $project_layout_type ) {
			case 'type_1':
				get_template_part( 'template-parts/portfolio/full-width' );
				break;
			case 'type_2':
				get_template_part( 'template-parts/portfolio/fixed-width' );
				break;
			case 'type_3':
				get_template_part( 'template-parts/portfolio/boxed' );
				break;
			case 'type_4':
				get_template_part( 'template-parts/portfolio/slider' );
				break;
			case 'type_5':
				get_template_part( 'template-parts/portfolio/bottom-grid' );
				break;
			case 'type_6':
				get_template_part( 'template-parts/portfolio/top-grid' );
				break;
			case 'type_7':
				get_template_part( 'template-parts/portfolio/fullscreen' );
				break;
			default:
				get_template_part( 'template-parts/portfolio/boxed' );
				break;
		}
	} else {
?>
	<div class="wrapped-container">
		<div class="vc_col-md-12 page-offset page-offset-bottom">
			<?php echo get_the_password_form(); ?>
		</div>
	</div>
<?php 
	}

	get_footer();