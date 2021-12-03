<div class="menu-list<?php echo $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $menu_list_uniqid . '"';  } ?> <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	
	<table>
		<tr>
			<td class="title">
				<?php if ( $name ): ?>
				<h4 class="title name text-left"><?php echo $name; ?></h4>
				<?php endif; ?>
			</td>
			<td class="line"></td>
			<td class="title">
				<h4 class="title price text-right">
					<?php if ( $regular_price && $sale_price ) : ?>
					<del><?php echo $regular_price; ?></del>
					<ins><?php echo $sale_price; ?></ins>
					<?php endif; ?>
					<?php if ( $regular_price && ! $sale_price ) : ?>
					<ins><?php echo $regular_price; ?></ins>
					<?php endif; ?>
					<?php if ( ! $regular_price && $sale_price ) : ?>
					<ins><?php echo $sale_price; ?></ins>
					<?php endif; ?>
				</h4>
			</td>
		</tr>			
	</table>

	<div class="content">
		<?php if ( $mark ): ?>
		<div class="brand-bg-color new"><?php _e( 'NEW', 'argenta_extra' ); ?></div>	
		<?php endif; ?>
		<p>
			<?php if ( $indigriends ) echo $indigriends; ?>
		</p>
	</div>

</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $name_css ) {
			$_style_block .= '#' . $menu_list_uniqid . '.menu-list table td.title h4.name{';
			$_style_block .= $name_css;
			$_style_block .= '}';
		}
		if ( ! $regular_price && $sale_price ) {
			if ( $regular_price_css ) {
				$_style_block .= '#' . $menu_list_uniqid . '.menu-list table td.title h4.price ins{';
				$_style_block .= $regular_price_css;
				$_style_block .= '}';
			}
		} else {
			if ( $sale_price_css ) {
				$_style_block .= '#' . $menu_list_uniqid . '.menu-list table td.title h4.price ins{';
				$_style_block .= $sale_price_css;
				$_style_block .= '}';
			}
		}
		if ( $regular_price_css ) {
			$_style_block .= '#' . $menu_list_uniqid . '.menu-list table td.title h4.price del{';
			$_style_block .= $regular_price_css;
			$_style_block .= '}';
		}
		if ( $border_css ) {
			$_style_block .= '#' . $menu_list_uniqid . '.menu-list table td.line:after{';
			$_style_block .= $border_css;
			$_style_block .= '}';
		}
		if ( $mark_css ) {
			$_style_block .= '#' . $menu_list_uniqid . '.menu-list .content .new{';
			$_style_block .= $mark_css;
			$_style_block .= '}';
		}
		if ( $indigriends_css ) {
			$_style_block .= '#' . $menu_list_uniqid . '.menu-list .content p{';
			$_style_block .= $indigriends_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>