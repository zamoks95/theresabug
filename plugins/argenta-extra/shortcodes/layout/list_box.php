<ul class="list-box<?php echo $list_box_class . $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $list_box_uniqid . '"';  } ?>>
	
	<?php if ( $list_style == 'default' && $list_value_type1 ) : ?>
		<?php foreach ( $list_value_type1 as $list_object ) : ?>
		<li>
			<?php if ( $list_object->list_title ) : ?>
			<h4 class="title"><?php echo $list_object->list_title; ?></h4>
			<?php endif; ?>
			<?php if ( $list_object->list_subtitle ) : ?>
			<p class="subtitle"><?php echo $list_object->list_subtitle; ?></p>
			<?php endif; ?>
		</li>
		<?php endforeach; ?>
	<?php elseif ( ( $list_style == 'icon' || $list_style == 'shape_icon' ) && $list_value_type2 ) : ?>
		<?php foreach ( $list_value_type2 as $list_object ) : ?>
		<li>
			<?php if ( $list_object->list_image ) : ?>
			<img src="<?php echo $list_object->list_image; ?>" alt="">
			<?php elseif ( $list_object->list_icon ) : ?>
			<span class="icon<?php if ( $list_style == 'shape_icon' ) echo '-shape'; ?> <?php echo $list_object->list_icon; ?>"></span>
			<?php $icons_collection[] = $list_object->list_icon; ?>
			<?php endif; ?>
			<?php if ( $list_object->list_title ) : ?>
			<h4 class="title"><?php echo $list_object->list_title; ?></h4>
			<?php endif; ?>
			<?php if ( $list_object->list_subtitle ) : ?>
			<p class="subtitle"><?php echo $list_object->list_subtitle; ?></p>
			<?php endif; ?>
		</li>
		<?php endforeach; ?>
	<?php endif; ?>

</ul>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $title_css ) {
			$_style_block .= '#' . $list_box_uniqid . ' li h4.title{';
			$_style_block .= $title_css;
			$_style_block .= '}';
		}
		if ( $subtitle_css ) {
			$_style_block .= '#' . $list_box_uniqid . ' li p.subtitle{';
			$_style_block .= $subtitle_css;
			$_style_block .= '}';
		}
		if ( $icon_css ) {
			$_style_block .= '#' . $list_box_uniqid . ' li .icon,';
			$_style_block .= '#' . $list_box_uniqid . ' li .icon-shape{';
			$_style_block .= $icon_css;
			$_style_block .= '}';
		}
		if ( $shape_icon_css ) {
			$_style_block .= '#' . $list_box_uniqid . ' li .icon-shape{';
			$_style_block .= $shape_icon_css;
			$_style_block .= '}';
		}
		if ( $border_css ) {
			$_style_block .= '#' . $list_box_uniqid . ' li,';
			$_style_block .= '#' . $list_box_uniqid . ' li:first-child{';
			$_style_block .= $border_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>