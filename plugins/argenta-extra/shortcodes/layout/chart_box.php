<div class="chart-box<?php echo $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $chart_box_uniqid . '"';  } ?>>
	
	<div class="chart-box-pie" data-chart-box="true" data-percent="<?php echo $percent; ?>"<?php if ( $chart_color ) echo ' data-color="' . $chart_color . '"'; ?>>
		<div class="chart-box-pie-content">
			<?php if ( $layout == "icon" && $icon_as_icon ): ?>
			<span class="icon icon-large <?php echo $icon_as_icon; ?>"></span>
			<?php else: ?>
				<?php if ( $layout == "icon_with_percent" && $icon_as_icon && $icon_position == 'left' ): ?>
					<span class="icon <?php echo $icon_as_icon; ?>"></span>
				<?php endif; ?>
				<span class="percent-wrap">
					<span class="percent">0</span>%
				</span>
				<?php if ( $layout == "icon_with_percent" && $icon_as_icon && $icon_position == 'right' ): ?>
					<span class="icon <?php echo $icon_as_icon; ?>"></span>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php if ( $subtitle && $subtitle_position == "top" ): ?>
	<p class="subtitle"><?php echo $subtitle; ?></p>
	<?php endif; ?>
	<?php if ( $title ): ?>
	<h3 class="title"><?php echo $title; ?></h3>
	<?php endif; ?>
	<?php if ( $subtitle && $subtitle_position == "bottom" ): ?>
	<p class="subtitle"><?php echo $subtitle; ?></p>
	<?php endif; ?>

</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $title_css ) {
			$_style_block .= '#' . $chart_box_uniqid . '.chart-box h3.title{';
			$_style_block .= $title_css;
			$_style_block .= '}';
		}
		if ( $subtitle_css ) {
			$_style_block .= '#' . $chart_box_uniqid . '.chart-box p.subtitle{';
			$_style_block .= $subtitle_css;
			$_style_block .= '}';
		}
		if ( $chart_content_css ) {
			$_style_block .= '#' . $chart_box_uniqid . '.chart-box .chart-box-pie-content{';
			$_style_block .= $chart_content_css;
			$_style_block .= '}';
		}
		if ( $percent_css ) {
			$_style_block .= '#' . $chart_box_uniqid . '.chart-box span.percent-wrap{';
			$_style_block .= $percent_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>