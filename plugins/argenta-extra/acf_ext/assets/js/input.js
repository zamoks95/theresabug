(function($){

	function create_new_typo_scope( $wrapper ) {
		var argenta_typo = {
			id: false,
			$wrapper: false,
			$hidden:  false,
			$data_size: false,
			$data_style: false,
			$data_color: false,
			$data_height: false,
			$data_weight: false,
			$data_spacing: false,
			$data_font_family: false,
			$data_font_variants: false,
			$data_font_subsets: false,

			initialize_fields: function() {
				this.id = this.$wrapper.find( '.argenta-typo-field-content' ).attr( 'data-uniqid' );
				
				this.$hidden = this.$wrapper.find( 'input[type="hidden"]' );
				this.$data_size = this.$wrapper.find( 'input[name="typo-size"]' );
				this.$data_style = this.$wrapper.find( 'select[name="typo-style"]' );
				this.$data_color = this.$wrapper.find( 'input[name="typo-color"]' );
				this.$data_height = this.$wrapper.find( 'input[name="typo-height"]' );
				this.$data_weight = this.$wrapper.find( 'select[name="typo-weight"]' );
				this.$data_spacing = this.$wrapper.find( 'input[name="typo-spacing"]' );
				this.$data_font_family = this.$wrapper.find( 'select[name="typo-font-family"]' );
				this.$data_font_variants = this.$wrapper.find( '.variants_value' );
				this.$data_font_subsets = this.$wrapper.find( '.subsets_value' );

				var that = this;
				this.$data_size.change( function() { that.update_hidden(); } );
				this.$data_style.change( function() { that.update_hidden(); } );
				this.$data_color.change( function() { that.update_hidden(); } );
				this.$data_height.change( function() { that.update_hidden(); } );
				this.$data_weight.change( function() { that.update_hidden(); } );
				this.$data_spacing.change( function() { that.update_hidden(); } );
				this.$data_font_variants.on( 'change', 'input[type="checkbox"]', function() { that.update_hidden(); } );
				this.$data_font_subsets.on( 'change', 'input[type="checkbox"]', function() { that.update_hidden(); } );

				this.$data_font_family.change( function() {
					var selected_font = $(this).val();
					$(this).blur();
					if ( selected_font ) {
						that.font_selector_blocker( true );
						jQuery.post( ajaxurl, {
							'action': 'argenta_get_font',
							'font_family': selected_font
						}, function( response ) {
							if ( response ) {
								that.update_font( JSON.parse( response ) );
							}
							that.font_selector_blocker( false );
							that.update_hidden();
						} );
					} else {
						that.update_font();
						that.update_hidden();
					}		
				} );
			},

			serialize_fields: function() {
				var result = {};
				if ( this.$data_size.val() ) { result.size = this.$data_size.val(); }
				if ( this.$data_style.val() ) { result.style = this.$data_style.val(); }
				if ( this.$data_color.val() ) { result.color = this.$data_color.val(); }
				if ( this.$data_height.val() ) { result.height = this.$data_height.val(); }
				if ( this.$data_weight.val() ) { result.weight = this.$data_weight.val(); }
				if ( this.$data_spacing.val() ) { result.spacing = this.$data_spacing.val(); }
				if ( this.$data_font_family.val() ) {
					result.font_family = this.$data_font_family.val();
					this.$data_font_variants.find( 'input[type="checkbox"]' ).each( function() {
						if ( $(this).is( ':checked' ) ) {
							if ( result.font_variants == undefined ) {
								result.font_variants = [ $(this).attr( 'name' ) ];
							} else {
								result.font_variants.push( $(this).attr( 'name' ) );
							}
						}
					} );
					this.$data_font_subsets.find( 'input[type="checkbox"]' ).each( function() {
						if ( $(this).is( ':checked' ) ) {
							if ( result.font_subsets == undefined ) {
								result.font_subsets = [ $(this).attr( 'name' ) ];
							} else {
								result.font_subsets.push( $(this).attr( 'name' ) );
							}
						}
					} );
				}
				return JSON.stringify( result );
			},

			update_hidden: function() {
				var fields_json = this.serialize_fields();
				this.$hidden.val( fields_json );
			},

			update_font: function( font_object ) {
				if ( font_object ) {
					// prepare font preview
					$( 'link#' + this.id ).remove();

					var font_link  = document.createElement( 'link' );
					font_link.type = 'text/css';
					font_link.id   = this.id;
					font_link.rel  = 'stylesheet';
					font_link.href = 'https://fonts.googleapis.com/css?family=' + font_object.family.replace( /\s/, '+' );
					$( 'head' ).append( $( font_link ) );
					this.$wrapper.find( '.font-preview' ).attr( 'style', 'font-family: \'' + font_object.family + '\';' ).show();

					// prepare variants
					var variants_layout = '';
					for (var i = font_object.variants.length - 1; i >= 0; i--) {
						variants_layout += '<div class="checkbox_row">';
						variants_layout += '<label><input type="checkbox" name="' + font_object.variants[ i ] + '" checked> ';
						variants_layout += font_object.variants[ i ];
						variants_layout += '</label>';
						variants_layout += '</div>';
					}
					this.$wrapper.find( '.checkboxes.variants_value' ).html( variants_layout );

					// prepare subsets
					var subsets_layout = '';
					for (var i = font_object.subsets.length - 1; i >= 0; i--) {
						subsets_layout += '<div class="checkbox_row">';
						subsets_layout += '<label><input type="checkbox" name="' + font_object.subsets[ i ] + '" checked> ';
						subsets_layout += font_object.subsets[ i ];
						subsets_layout += '</label>';
						subsets_layout += '</div>';
					}
					this.$wrapper.find( '.checkboxes.subsets_value' ).html( subsets_layout );

					// fallback animation for from-empty-to-filled effect
					this.$wrapper.find( '.checkboxes' ).slideDown( 250 );
					this.$wrapper.find( '.no_content' ).hide();
				} else {
					// clear
					this.$wrapper.find( '.font-preview' ).slideUp( 250 );
					this.$wrapper.find( '.no_content' ).slideDown( 250 );
					this.$wrapper.find( '.checkboxes' ).hide().html( '' );
				}
			},

			font_selector_blocker: function( show ) {
				if ( show ) {
					this.$wrapper.find('.font-picker .pick_blocker').fadeIn( 250 );
				} else {
					this.$wrapper.find('.font-picker .pick_blocker').fadeOut( 250 );
				}
			}
		}

		argenta_typo.$wrapper = $wrapper;

		return argenta_typo;
	}






	if( typeof acf.add_action !== 'undefined' ) {
		acf.add_action('ready append', function( $el ){
			acf.get_fields( { type : 'argenta_typo' }, $el ).each( function(){
				var argenta_typo = create_new_typo_scope( $( this ) );
				argenta_typo.initialize_fields();
			} );
		});
	} else {
		$(document).on( 'acf/setup_fields', function( e, postbox ){
			$( postbox ).find('.field[data-field_type="argenta_typo"]').each( function(){
				var argenta_typo = create_new_typo_scope( $( this ) );
				argenta_typo.initialize_fields();
			} );
		});
	}

})(jQuery);



/*
	Argenta color picker
*/

(function($){

	function create_new_color_scope( $wrapper ) {
		var argenta_color = {
			id: false,
			$wrapper: false,
			$hidden:  false,
			$data_color: false,

			initialize_fields: function() {
				this.id = this.$wrapper.find( '.argenta-color-field-content' ).attr( 'data-uniqid' );
				this.$hidden = this.$wrapper.find( 'input[type="hidden"]' );
				this.$data_color = this.$wrapper.find( 'input[name="color"]' );

				var that = this;
				setTimeout( function() {
					that.$cleaner = that.$wrapper.find( '.wp-picker-clear' );
					that.$cleaner.click( function() { that.$data_color.trigger( 'change' ); } );
				}, 1000);
				this.$data_color.change( function() { that.update_hidden(); } );
			},

			serialize_fields: function() {
				return ( this.$data_color.val() ) ? this.$data_color.val() : '';
			},

			update_hidden: function() {
				var fields = this.serialize_fields();
				this.$hidden.val( fields );
			},
		}

		argenta_color.$wrapper = $wrapper;

		return argenta_color;
	}



	if( typeof acf.add_action !== 'undefined' ) {
		acf.add_action('ready append', function( $el ){
			acf.get_fields( { type : 'argenta_color' }, $el ).each( function(){
				var argenta_color = create_new_color_scope( $( this ) );
				argenta_color.initialize_fields();
			} );
		});
	} else {
		$(document).on( 'acf/setup_fields', function( e, postbox ){
			$( postbox ).find('.field[data-field_type="argenta_color"]').each( function(){
				var argenta_color = create_new_color_scope( $( this ) );
				argenta_color.initialize_fields();
			} );
		});
	}

})(jQuery);



/*
	Argenta color picker
*/

(function($){

	function create_new_columns_scope( $wrapper ) {
		var argenta_columns = {
			id: false,
			$wrapper: false,
			$hidden:  false,
			large: false,
			medium: false,
			small: false,
			extraSmall: false,

			initialize_fields: function() {
				this.id = this.$wrapper.find( '.argenta-acf-columns-field-content' ).attr( 'data-uniqid' );
				this.$hidden = this.$wrapper.find( 'input[type="hidden"]' );

				this.large = this.$wrapper.find( 'select[name="large"]' );
				this.medium = this.$wrapper.find( 'select[name="medium"]' );
				this.small = this.$wrapper.find( 'select[name="small"]' );
				this.extraSmall = this.$wrapper.find( 'select[name="extraSmall"]' );

				var self = this;
				$([
					this.large[0],
					this.medium[0],
					this.small[0],
					this.extraSmall[0]
				]).change( function(){ self.update_hidden() } );
			},

			serialize_fields: function() {
				return this.large.val() + '-' + this.medium.val() + '-' + this.small.val() + '-' + this.extraSmall.val();
			},

			update_hidden: function() {
				var fields = this.serialize_fields();
				this.$hidden.val( fields );
			},
		}

		argenta_columns.$wrapper = $wrapper;

		return argenta_columns;
	}



	if( typeof acf.add_action !== 'undefined' ) {
		acf.add_action( 'ready append', function( $el ){
			acf.get_fields( { type : 'argenta_columns' }, $el ).each( function(){
				var argenta_columns = create_new_columns_scope( $( this ) );
				argenta_columns.initialize_fields();
			} );
		});
	} else {
		$(document).on( 'acf/setup_fields', function( e, postbox ){
			$( postbox ).find('.field[data-field_type="argenta_columns"]').each( function(){
				var argenta_columns = create_new_columns_scope( $( this ) );
				argenta_columns.initialize_fields();
			} );
		});
	}

})(jQuery);