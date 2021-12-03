<div class="progress-bar<?php echo $progress_bar_class; ?><?php echo $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $progress_bar_uniqid . '"';  } ?>>

	<p class="progress-bar-title"><?php echo $name; ?></p>
	<p class="progress-bar-percent"><strong><span class="count">0</span>%</strong> </p>
	<div class="progress-bar-line<?php if ( $layout == 'outline' ) { echo ' brand-border-color'; } ?>">
		<?php if ( $layout == 'split' ): ?>
			<?php for ( $i = 0; $i < 10; $i++ ): ?>
				<div class="progress-bar-line-block brand-bg-color"></div>
			<?php endfor; ?>
		<?php endif; ?>
		<div class="progress-bar-line-fill brand-bg-color" data-progress-bar-fill="<?php echo $percent; ?>"></div>
	</div>

</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $bar_css ) {
			$_style_block .= '#' . $progress_bar_uniqid . '.progress-bar .progress-bar-line-fill{';
			$_style_block .= $bar_css;
			$_style_block .= '}';
		}
		if ( $bar_wrap_css ) {
			$_style_block .= '#' . $progress_bar_uniqid . '.progress-bar .progress-bar-line{';
			$_style_block .= $bar_wrap_css;
			$_style_block .= '}';
		}
		if ( $name_css ) {
			$_style_block .= '#' . $progress_bar_uniqid . '.progress-bar .progress-bar-title{';
			$_style_block .= $name_css;
			$_style_block .= '}';
		}
		if ( $percent_css ) {
			$_style_block .= '#' . $progress_bar_uniqid . '.progress-bar .progress-bar-percent{';
			$_style_block .= $percent_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>
