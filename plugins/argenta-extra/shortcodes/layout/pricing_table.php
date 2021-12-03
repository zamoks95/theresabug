<div class="<?php echo $pricing_table_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $pricing_table_uniqid . '"'; } ?> <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

	<?php if ( $select_as_best ) : ?>
	<div class="pricing-table-feat-mark">
		<div class="wrap brand-bg-color"><?php echo $label_text; ?></div>
	</div>
	<?php endif; ?>

	<?php if ( $title ) : ?>
	<h3 class="title"><?php echo $title; ?></h3>
	<?php endif; ?>
	
	<?php if ( $subtitle ) : ?>
	<p class="subtitle small"><?php echo $subtitle; ?></p>
	<?php endif; ?>

	<div class="pricing-table-price">
		<h2 class="title">
			<?php if ( $price_currency ) : ?>
			<span class="icon"><?php echo $price_currency; ?></span>
			<?php endif; ?>
			<?php echo $price; ?>
		</h2>

		<?php if ( $price_caption ) : ?>
		<p class="pricing-table-time-interval"><?php echo $price_caption; ?></p>
		<?php endif;	?>

		<p class="subtitle"><?php echo $description; ?></p>
	</div><!--pricing-table-price-->

	<ul class="<?php echo $list_box_class; ?> list-box-border-items <?php echo $list_align_class; ?>">
		<?php switch ( $features_type ) :
						case 'default' : ?>
			<?php if ( $features_value_type1 ) : ?>
				<?php foreach ( $features_value_type1 as $feature_object ) : ?>
		<li>
			<?php if ( $feature_object->feature_title ) : ?>
			<h4 class="title"><?php echo $feature_object->feature_title; ?></h4>
			<?php endif; ?>
			<?php if ( $feature_object->feature_subtitle ) : ?>
			<p class="subtitle"><?php echo $feature_object->feature_subtitle; ?></p>
			<?php endif; ?>
		</li>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php break; ?>
			
			<?php case 'simple_list' : ?>
				<?php if ( $features_value_type2 ) : ?>
					<?php foreach ( $features_value_type2 as $feature_object ) : ?>
		<li>
			<?php if ( $feature_object->feature_image ) : ?>
			<img src="<?php echo $feature_object->feature_image; ?>" alt="">
			<?php elseif ( $feature_object->feature_icon ) : ?>
			<span class="icon brand-color <?php echo $feature_object->feature_icon; ?>"></span>
			<?php $icons_collection[] = $feature_object->feature_icon; ?>
			<?php endif; ?>
			<?php if ( $feature_object->feature_title ) : ?>
			<p><?php echo $feature_object->feature_title; ?></p>
			<?php endif; ?>
		</li>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php break; ?>
			
			<?php case 'only_icons' : ?>
				<?php if ( $features_value_type3 ) : ?>
					<?php foreach ( $features_value_type3 as $feature_object ) : ?>
		<li>
			<?php if ( $feature_object->feature_icon ) : ?>
				<?php if ( $feature_object->feature_icon == 'yes' ) : ?>
					<span class="icon-enable brand-color my-icon-ui-tick"></span>
				<?php else : ?>
					<span class="icon-disable my-icon-ui-cross"></span>
				<?php endif; ?>
			<?php endif; ?>
		</li>
						<?php endforeach; ?>
					<?php endif; ?>
			<?php break; ?>

		<?php endswitch; ?>
	</ul><!--.list-box-->

	<?php if ( $add_button ) : ?>
		<a href="<?php echo $button_link['url']; ?>" class="pricing-table-btn btn uppercase<?php echo $button_css['classes']; ?>"<?php if ( $button_link['blank'] ) { echo ' target="_blank"'; } ?>><?php echo $button_link['caption']; ?>
			<?php if ( $button_settings['type'] == 'arrow_link' ): ?>
			<span class="icon-arrow ion-ios-arrow-thin-right"></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $border_css ) {
			$_style_block .= '#' . $pricing_table_uniqid . '{';
			$_style_block .= $border_css;
			$_style_block .= '}';
		}
		if ( $title_css ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' h3.title{';
			$_style_block .= $title_css;
			$_style_block .= '}';
		}
		if ( $subtitle_css ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' > p.subtitle{';
			$_style_block .= $subtitle_css;
			$_style_block .= '}';
		}
		if ( $description_css ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' .pricing-table-price p.subtitle{';
			$_style_block .= $description_css;
			$_style_block .= '}';
		}
		if ( $price_css ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' .pricing-table-price h2{';
			$_style_block .= $price_css;
			$_style_block .= '}';
		}
		if ( $price_caption_css ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' .pricing-table-time-interval{';
			$_style_block .= $price_caption_css;
			$_style_block .= '}';
		}
		if ( $label_css ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' .pricing-table-feat-mark .wrap,';
			$_style_block .= '#' . $pricing_table_uniqid . ' .pricing-table-feat-mark:after,';
			$_style_block .= '#' . $pricing_table_uniqid . ' .pricing-table-feat-mark:before{';
			$_style_block .= $label_css;
			$_style_block .= '}';
		}
		if ( isset( $button_css['css'] ) && $button_css['css'] ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' .pricing-table-btn{';
			$_style_block .= $button_css['css'];
			$_style_block .= '}';
		}
		if ( isset( $button_css['hover-css']  ) && $button_css['hover-css'] ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' .pricing-table-btn:hover{';
			$_style_block .= $button_css['hover-css'] ;
			$_style_block .= '}';
		}
		if ( $features_title_css && $features_type == 'default' ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' h4.title{';
			$_style_block .= $features_title_css;
			$_style_block .= '}';
		}
		if ( $features_title_css && $features_type == 'simple_list' ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' li > p{';
			$_style_block .= $features_title_css;
			$_style_block .= '}';
		}
		if ( $features_subtitle_css ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' li > p.subtitle{';
			$_style_block .= $features_subtitle_css;
			$_style_block .= '}';
		}
		if ( $icon_css_type1 ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' li::after{';
			$_style_block .= $icon_css_type1;
			$_style_block .= '}';
		}
		if ( $icon_css_type2 ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' li .icon{';
			$_style_block .= $icon_css_type2;
			$_style_block .= '}';
		}
		if ( $icon_css_type3 ) {
			$_style_block .= '#' . $pricing_table_uniqid . ' .icon-enable,';
			$_style_block .= '#' . $pricing_table_uniqid . ' .icon-disable{';
			$_style_block .= $icon_css_type3;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>