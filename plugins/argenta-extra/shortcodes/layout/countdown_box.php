<div class="countdown-box<?php echo $countdown_box_class . $css_class; ?>" id="<?php echo $countdown_box_uniqid; ?>" data-countdown-box="template_<?php echo $countdown_box_uniqid; ?>" data-countdown-time="<?php echo $countdown_date; ?>"></div>

<?php if ( $layout == 'default' ): ?>
<script type="text/template" id="template_<?php echo $countdown_box_uniqid; ?>">
	<div class="box-time <%= label %>">
		<div class="title-lead box-count box-next">
			<span class="countdown-box-wrap-number"><%= next %></span>
		</div>
		<p class="box-label"><%= label %></p>
	</div>
</script>
<?php else: ?>
<script type="text/template" id="template_<?php echo $countdown_box_uniqid; ?>">
	<div class="box-time <%= label %>">
		<div class="title-lead box-count">
			<div class="box-current box-top">
				<span class="countdown-box-wrap-number"><%= current %></span>
			</div>
			<div class="box-next box-top">
				<span class="countdown-box-wrap-number"><%= next %></span>
				</div>
			<div class="box-next box-bottom">
				<span class="countdown-box-wrap-number"><%= next %></span>
				</div>
			<div class="box-current box-bottom">
				<span class="countdown-box-wrap-number"><%= current %></span>
			</div>
		</div>
		<p class="box-label"><%= label %></p>
	</div>
</script>
<?php endif; ?>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $numbers_css ) {
			$_style_block .= '#' . $countdown_box_uniqid . ' .countdown-box-wrap-number{';
			$_style_block .= $numbers_css;
			$_style_block .= '}';
		}
		if ( $titles_css ) {
			$_style_block .= '#' . $countdown_box_uniqid . ' .box-label{';
			$_style_block .= $titles_css;
			$_style_block .= '}';
		}
		if ( $box_css ) {
			$_style_block .= '#' . $countdown_box_uniqid . ' .box-top,';
			$_style_block .= '#' . $countdown_box_uniqid . ' .box-bottom{';
			$_style_block .= $box_css;
			$_style_block .= '}';
		}
		if ( $box_line_css ) {
			$_style_block .= '#' . $countdown_box_uniqid . ' .box-bottom:after{';
			$_style_block .= $box_line_css;
			$_style_block .= '}';
		}
		if ( $box_bg_css ) {
			$_style_block .= '#' . $countdown_box_uniqid . ' .box-count{';
			$_style_block .= $box_bg_css;
			$_style_block .= '}';
		}
		if ( $box_border_css ) {
			$_style_block .= '#' . $countdown_box_uniqid . ' .box-count:after,';
			$_style_block .= '#' . $countdown_box_uniqid . ' .box-count:before{';
			$_style_block .= $box_border_css;
			$_style_block .= '}';
		}
		if ( $divider_dots_css ) {
			$_style_block .= '#' . $countdown_box_uniqid . ' .box-time:after{';
			$_style_block .= $divider_dots_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>