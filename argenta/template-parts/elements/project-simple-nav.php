<?php 
	$project = argenta_gh_get_project_settings( $post );
?>
<div class="portfolio-nav-paginator <?php echo esc_attr( $project['navigation_position'] == 'top' ? 'border-bottom' : 'border-top' ); ?>">
	<?php if ( $project['prev'] ) : ?>
	<a href="<?php echo esc_url( $project['prev']['url'] ); ?>" class="left brand-color-hover">
		<i class="ion-ios-arrow-left"></i>
	</a>
	<?php else: ?>
	<div class="left cap"></div>
	<?php endif; ?>

	<?php if ( $project['link_to_all'] ) : ?>
	<a href="<?php echo esc_url( $project['link_to_all'] ); ?>" class="center brand-color-hover">
		<i class="ion-grid"></i>
	</a>
	<?php endif; ?>
	
	<?php if ( $project['next'] ) : ?>
	<a href="<?php echo esc_url( $project['next']['url'] ); ?>" class="right brand-color-hover">
		<i class="ion-ios-arrow-right"></i>
	</a>
	<?php else: ?>
	<div class="right cap"></div>
	<?php endif; ?>
</div>