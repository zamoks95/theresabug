<?php
	// Settings
	$prev_post = get_adjacent_post( false, '', false );
	$next_post = get_adjacent_post( false, '', true );
	$toggle_post_column = ( ! empty( $prev_post ) && ! empty( $next_post ) ) ? '6' : '12';

	$hide_prev_n_next = get_field( 'global_post_hide_previous_n_next', 'option' );

	if ( ( $prev_post || $next_post ) && ! $hide_prev_n_next ) :
?>

	<div class="vc_row toggle">
	<?php if ( ! empty( $prev_post ) ) : ?>
		<div class="vc_col-md-<?php echo esc_attr( $toggle_post_column ); ?>">
			<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
				<table class="toggle-post">
					<tbody>
						<tr>
							<td class="arrow">
								<span class="ion-ios-arrow-left"></span>
							</td>
							<td class="image left">
								<?php echo get_the_post_thumbnail( $prev_post, 'argenta_thumbnail_next_and_prev' ); ?>
							</td>
							<td class="content text-left">
								<p class="subtitle small"><?php esc_html_e( 'Previous post', 'argenta' ); ?></p>
								<h3 class="title text-left">
									<?php
										$prev_title = get_the_title( $prev_post->ID );
										if ( empty( $prev_title ) ) {
											echo wp_kses( '[' . get_the_date( false, $prev_post->ID ) . ']', 'default' );
										} else {
											echo wp_kses( $prev_title, 'default' );
										}
									?>
								</h3>
							</td>
						</tr>
					</tbody>
				</table>
			</a>
		</div>
	<?php endif; ?>
	<?php if ( ! empty( $next_post ) ) : ?>
		<div class="vc_col-md-<?php echo esc_attr( $toggle_post_column ); ?>">
			<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
				<table class="toggle-post">
					<tbody>
						<tr>
							<td class="content text-left">
								<p class="subtitle small"><?php esc_html_e( 'Next post', 'argenta' ); ?></p>
								<h3 class="title text-left">
									<?php
										$next_title = get_the_title( $next_post->ID );
										if ( empty( $next_title ) ) {
											echo wp_kses( '[' . get_the_date( false, $next_post->ID ) . ']', 'default' );
										} else {
											echo wp_kses( $next_title, 'default' );
										}
									?>
								</h3>	
							</td>
							<td class="image right">
								<?php echo get_the_post_thumbnail( $next_post, 'argenta_thumbnail_next_and_prev' ); ?>
							</td>
							<td class="arrow">
								<span class="ion-ios-arrow-right"></span>
							</td>
						</tr>
					</tbody>
				</table>
			</a>
		</div>
	<?php endif; ?>
	</div>
	<?php endif; ?>