<div class="counter-box<?php echo $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $counter_box_uniqid . '"';  } ?>>
	
	<?php if ( $layout == "number_with_icon" && $icon_position == 'top' ): ?>

		<?php if ( $icon_as_icon  ): ?>
			<span class="counter-box-icon <?php echo $icon_as_icon; ?>"></span>
		<?php elseif ($icon_as_image): ?>
			<?php echo $icon_image; ?>
		<?php endif; ?>
	
	<?php endif; ?>
	<div class="counter-box-count" data-counter="<?php echo $count_number; ?>">

		<?php if ( $layout == "number_with_icon" && $icon_position == 'left' ): ?>
			<?php if ( $icon_as_icon  ): ?>
				<span class="counter-box-icon <?php echo $icon_as_icon; ?>"></span>
			<?php elseif ($icon_as_image): ?>
				<?php echo $icon_image; ?>
			<?php endif; ?>
		<?php endif; ?>

		<span class="count">0</span>
		<?php if ( $layout == "number_with_icon" && $icon_position == 'right' ): ?>
			<?php if ( $icon_as_icon  ): ?>
				<span class="counter-box-icon <?php echo $icon_as_icon; ?>"></span>
			<?php elseif ($icon_as_image): ?>
				<?php echo $icon_image; ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<?php if ( $subtitle && $subtitle_position == 'top' ): ?>
	<p class="subtitle"><?php echo $subtitle; ?></p>
	<?php endif; ?>
	<?php if ( $title ): ?>
	<h3 class="title"><?php echo $title; ?></h3>
	<?php endif; ?>
	<?php if ( $subtitle && $subtitle_position == 'bottom' ): ?>
	<p class="subtitle"><?php echo $subtitle; ?></p>
	<?php endif; ?>

</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $title_css ) {
			$_style_block .= '#' . $counter_box_uniqid . '.counter-box h3.title{';
			$_style_block .= $title_css;
			$_style_block .= '}';
		}
		if ( $subtitle_css ) {
			$_style_block .= '#' . $counter_box_uniqid . '.counter-box p.subtitle{';
			$_style_block .= $subtitle_css;
			$_style_block .= '}';
		}
		if ( $count_css ) {
			$_style_block .= '#' . $counter_box_uniqid . '.counter-box .counter-box-count .count{';
			$_style_block .= $count_css;
			$_style_block .= '}';
		}
		if ( $icon_css ) {
			$_style_block .= '#' . $counter_box_uniqid . '.counter-box .counter-box-icon{';
			$_style_block .= $icon_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>