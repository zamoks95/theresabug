<?php


	/**
	* String filtering
	*/
	function argenta_extra_filter_string( $string, $filter_type = 'string', $default = false ) {
		$filter_result = $default;
		$string = wp_check_invalid_utf8( trim( $string ) );
		switch ( $filter_type ) {
			case 'attr':
				$string = esc_attr( $string );
				break;
			case 'url':
				$string = esc_url( urldecode( $string ) );
				break;
		}
		if ( ! empty( $string ) ) {
			$filter_result = $string;
		}
		return $filter_result;
	}



	/**
	* Boolean filtering
	*/
	function argenta_extra_filter_boolean( $value ) {
		return (bool) $value;
	}
