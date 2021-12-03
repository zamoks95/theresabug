<?php

	namespace Argenta;

	class Helper {

		/* Return CSS code for element and add Google Fonts to queue */
		static function parse_acf_typo_to_css( $argenta_typo, $cond = false ) {
			$result_css = '';
			$result_fields = array(
				'font-family',
				'font-size',
				'font-style',
				'line-height',
				'font-weight',
				'letter-spacing',
				'color'
			);
			if ( $argenta_typo && is_string( $argenta_typo ) ) {
				$argenta_typo = json_decode( $argenta_typo );
			}

			if ( is_array( $cond ) && isset( $cond['rule'] ) && isset( $cond['fields'] ) ) {
				if ( $cond['rule'] == 'include' && is_array( $cond['fields'] ) ) {
					$result_fields = $cond['fields'];
				}
				if ( $cond['rule'] == 'exclude' ) {
					foreach ( $cond['fields'] as $field ) {
						if ( ( $key = array_search( $field, $result_fields ) ) !== false ) {
							unset( $result_fields[$key] );
						}
					}
				}
			}

			if ( $argenta_typo && is_object( $argenta_typo ) ) {

				if ( isset( $argenta_typo->font_family ) && in_array( 'font-family', $result_fields ) ) {
					$result_css .= 'font-family:\'' . $argenta_typo->font_family . '\', sans-serif;';
					
					$font_key_array = array();
					$font_key_array['font'] = $argenta_typo->font_family;
					$font_key_array['variants'] = array();
					$font_key_array['subsets'] = array();
					if ( isset( $argenta_typo->font_variants ) && is_array( $argenta_typo->font_variants ) ) {
						foreach ( $argenta_typo->font_variants as $font_variant ) {
							$font_key_array['variants'][] = $font_variant;
						}
					}
					if ( isset( $argenta_typo->font_subsets ) && is_array( $argenta_typo->font_subsets ) ) {
						foreach ( $argenta_typo->font_subsets as $font_subset ) {
							$font_key_array['subsets'][] = $font_subset;
						}
					}
					$GLOBALS['argenta_google_fonts'][] = $font_key_array;
				}
				if ( isset( $argenta_typo->size ) && $argenta_typo->size && in_array( 'font-size', $result_fields )  ) {
					$result_css .= 'font-size:' . $argenta_typo->size . ';';
				}
				if ( isset( $argenta_typo->style ) && $argenta_typo->style && in_array( 'font-style', $result_fields )  ) {
					$result_css .= 'font-style:' . $argenta_typo->style . ';';
				}
				if ( isset( $argenta_typo->height ) && $argenta_typo->height && in_array( 'line-height', $result_fields )  ) {
					$result_css .= 'line-height:' . $argenta_typo->height . ';';
				}
				if ( isset( $argenta_typo->weight ) && $argenta_typo->weight && in_array( 'font-weight', $result_fields )  ) {
					$result_css .= 'font-weight:' . $argenta_typo->weight . ';';
				}
				if ( isset( $argenta_typo->spacing ) && $argenta_typo->spacing && in_array( 'letter-spacing', $result_fields )  ) {
					$result_css .= 'letter-spacing:' . $argenta_typo->spacing . ';';
				}
				if ( isset( $argenta_typo->color ) && $argenta_typo->color && in_array( 'color', $result_fields ) ) {
					$result_css .= 'color:' . $argenta_typo->color . ';';
				}
			}
			return ( $result_css ) ? $result_css : false;
		}


		/* Parse global array with Google Fonts list */
		static function parse_google_fonts_to_query_string( $list ) {
			if ( is_array( $list ) && count( $list ) > 0 ) {
				$names = array();
				$subsets = array();
				foreach ( $list as $font_item ) {
					$_name = $font_item['font'];
					$_weights = array();
					if ( is_array( $font_item['variants'] ) ) {
						foreach ( $font_item['variants'] as $weight ) {
							if ( $weight == 'regular' ) {
								$weight = '400';
							}
							if ( $weight == 'italic' ) {
								$weight = '400italic';
							}
							$weight = str_replace( 'italic', 'i', $weight );
							$_weights[] = $weight;
						}
					}
					if ( count( $_weights ) > 0 ) {
						$_name .= ':' . implode(',', $_weights);
					}
					$names[] = $_name;

					if ( is_array( $font_item['subsets'] ) ) {
						foreach ( $font_item['subsets'] as $subset ) {
							if ( $subset != 'latin' ) {
								$subsets[] = $subset;
							}
						}
					}
				}
				$names = array_unique( $names );
				$family_string = implode('|', $names);
				if ( count( $subsets ) > 0 ) {
					$family_string .= '&subset=' . implode(',', $subsets);
				}
				return add_query_arg( 'family', urlencode( $family_string ), "//fonts.googleapis.com/css" );
			} else {
				return false;
			}
		}


		/* Format HEX-color to rgba with alpha value */
		static function hex_to_rgba( $color, $opacity = false ) {
			$default = 'rgb(0,0,0)';

			$opacity = (float) abs( $opacity );

			if( empty( $color ) ) { 
				return $default;
			} 
			if ( $color[0] == '#' ) {
				$color = substr( $color, 1 );
			}
			if ( strlen( $color ) == 6 ) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
				return $default;
			}

			$rgb = array_map( 'hexdec', $hex );

			if( $opacity && $opacity < 1 ){
				return 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
			} else {
				return 'rgb(' . implode( ",", $rgb ) . ')';
			}
		}

		/* Parse acf columns css */
		static function parse_columns_to_css( $value, $is_double = false, $parent = false ) {

			$value_array = explode( '-', $value );

			if ( $parent != false ) {
				$parent = explode( '-', $parent );

				for ( $i = 0; $i < count( $value_array ); $i++ ) {
					if ( $value_array[$i] == 'i' ) {
						$value_array[$i] = $parent[$i];
					}
				}
			}
			
			for ( $i = 0; $i < count( $value_array ); $i++ ) {
				switch ( $value_array[$i] ) {
					case '1':
						$value_array[$i] = 12;
						break;
					case '2':
						$value_array[$i] = ( $is_double ) ? 12 : 6;
						break;
					case '3':
						$value_array[$i] = ( $is_double ) ? 8 : 4;
						break;
					case '4':
						$value_array[$i] = ( $is_double ) ? 6 : 3;
						break;
					case '5':
						$value_array[$i] = ( $is_double ) ? '2_5th' : '5th';
						break;
					case '6':
						$value_array[$i] = ( $is_double ) ? 4 : 2;
						break;
					case '12':
						$value_array[$i] = ( $is_double ) ? 2 : 1;
						break;
				}
			}
			$classes = '';

			if ( isset( $value_array[0] ) ) {
				$classes .= ' vc_col-lg-' . $value_array[0];
			}
			if ( isset( $value_array[1] ) ) {
				$classes .= ' vc_col-md-' . $value_array[1];
			}
			if ( isset( $value_array[2] ) ) {
				$classes .= ' vc_col-sm-' . $value_array[2];
			}
			if ( isset( $value_array[3] ) ) {
				$classes .= ' vc_col-xs-' . $value_array[3];
			}

			return $classes;
		}

	}

?>