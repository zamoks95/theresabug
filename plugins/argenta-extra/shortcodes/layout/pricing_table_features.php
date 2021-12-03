<div class="pricing-table pricing-table-boxed pricing-table-labels<?php echo $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $pricing_table_uniqid . '"'; } ?> <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	
	<h3 class="title text-left"><?php echo $title; ?></h3>
	<ul class="list-box-icon list-box-border-items text-left">
		<?php if ( $features_value ) : ?>
			<?php foreach ( $features_value as $feature_object ) : ?>
		<li>
			<?php if ( $feature_object->feature_image ) : ?>
			<img src="<?php echo $feature_object->feature_image; ?>" alt="">
			<?php elseif ( $feature_object->feature_icon ) : ?>
			<span class="icon <?php echo $feature_object->feature_icon; ?>"></span>
			<?php $icons_collection[] = $feature_object->feature_icon; ?>
			<?php endif; ?>
			<?php if ( $feature_object->feature_title ) : ?>
			<p><?php echo $feature_object->feature_title; ?></p>
			<?php endif; ?>
		</li>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul><!--.list-box-->

</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $space_gap_css ) {
			$_style_block .= '#' . $pricing_table_uniqid . '{';
			$_style_block .= $space_gap_css;
			$_style_block .= '}';
		}
		if ( $title_css ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' h3.title{';
			$_style_block .= $title_css;
			$_style_block .= '}';
		}
		if ( $features_title_css ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' li > p{';
			$_style_block .= $features_title_css;
			$_style_block .= '}';
		}
		if ( $icon_css ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' li .icon{';
			$_style_block .= $icon_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>