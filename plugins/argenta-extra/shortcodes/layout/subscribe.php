<div class="subscribe<?php echo $subscribe_append_class . $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $subscribe_uniqid . '"';  } ?> <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	<form action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner_name; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520'); return true">
		<table>
			<tr>
				<td>
					<input type="text" placeholder="<?php echo $input_placeholder; ?>" name="email">
					<input type="hidden" value="<?php echo $feedburner_name; ?>" name="uri"/>
					<input type="hidden" name="loc" value="en_US"/>
				</td>
				<td class="btn-wrap">
					<input type="submit" class="btn" value="<?php _e( 'Subscribe', 'argenta_extra' ); ?>">
				</td>
			</tr>
		</table>
	</form>
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $table_css ) {
			$_style_block .= '#' . $subscribe_uniqid . ' table{';
			$_style_block .= $table_css;
			$_style_block .= '}';
		}
		if ( $button_color_css ) {
			$_style_block .= '#' . $subscribe_uniqid . '.subscribe input.btn{';
			$_style_block .= $button_color_css;
			$_style_block .= '}';
		}
		if ( $button_color_hover_css ) {
			$_style_block .= '#' . $subscribe_uniqid . '.subscribe input.btn:hover{';
			$_style_block .= $button_color_css;
			$_style_block .= '}';
		}
		if ( $input_color_css ) {
			$_style_block .= '#' . $subscribe_uniqid . '.subscribe input[type="text"]{';
			$_style_block .= $input_color_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>