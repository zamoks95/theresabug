<div class="google-maps" id="<?php echo $google_maps_uniqid; ?>" data-google-map="true" data-google-map-zoom="<?php echo $map_zoom; ?>"
	data-google-map-zoom-enable="<?php echo $map_zoom_enable; ?>" data-google-map-marker="<?php echo $map_marker; ?>" data-google-map-style="<?php echo $map_style; ?>">
	<div class="google-maps-wrap"></div>
	<div class="hidden" data-google-map-markers="true"><?php echo $marker_locations; ?></div>
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $map_height ) {
			$_style_block .= '#' . $google_maps_uniqid . '{';
			$_style_block .= 'height:' . $map_height . ';position:relative;';
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>