jQuery(function($){
"use strict";
if ( typeof vc !== 'undefined' ) {

	$('body, iframe').on('click','.vc_container_for_children.vc_empty-container, #vc_add-new-element, [data-vc-element="add-element-action"], .vc_controls [data-vc-control="add"], [data-vc-element="add-element-action"], #vc_add-new-element, .vc_control-btn-prepend, .vc_control-btn-append, .vc_controls [data-vc-control="prepend"], .vc_controls [data-vc-control="append"]',function() {
		$('#vc_ui-panel-add-element .vc_edit-form-tab-control button:contains("Argenta")').trigger('click');
	});


	/* Testimonial shortcode VC view */
	window.VcArgentaTestimonialView = vc.shortcode_view.extend( {
		elementTemplate: false,
		$wrapper: false,
		changeShortcodeParams: function ( model ) {
			var params;

			window.VcArgentaTestimonialView.__super__.changeShortcodeParams.call( this, model );
			params = _.extend( {}, model.get( 'params' ) );
			if ( ! this.elementTemplate ) {
				this.elementTemplate = this.$el.find( '.vc_argenta_testimonial-container' ).html();
			}
			if ( ! this.$wrapper ) {
				this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
			}
			if ( _.isObject( params ) ) {
				var $element = this.elementTemplate.replace(/%%author%%/g, ((params.author) ? params.author : '...'));
				this.$wrapper.find( '.vc_argenta_testimonial-container' ).html( $element );
			}
		}
	} );


	/* Team member shortcode VC view */
	window.VcArgentaTeamMemberView = vc.shortcode_view.extend( {
		elementTemplate: false,
		$wrapper: false,
		changeShortcodeParams: function ( model ) {
			var params;

			window.VcArgentaTeamMemberView.__super__.changeShortcodeParams.call( this, model );
			params = _.extend( {}, model.get( 'params' ) );
			if ( ! this.elementTemplate ) {
				this.elementTemplate = this.$el.find( '.vc_argenta_team_member-container' ).html();
			}
			if ( ! this.$wrapper ) {
				this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
			}
			if ( _.isObject( params ) ) {
				var $element = this.elementTemplate.replace(/%%name%%/g, ((params.name) ? params.name : '...'));
				this.$wrapper.find( '.vc_argenta_team_member-container' ).html( $element );
			}
		}
	} );


	/* Team member inner shortcode VC view */
	window.VcArgentaTeamMemberInnerView = vc.shortcode_view.extend( {
		elementTemplate: false,
		$wrapper: false,
		changeShortcodeParams: function ( model ) {
			var params;

			window.VcArgentaTeamMemberInnerView.__super__.changeShortcodeParams.call( this, model );
			params = _.extend( {}, model.get( 'params' ) );
			if ( ! this.elementTemplate ) {
				this.elementTemplate = this.$el.find( '.vc_argenta_team_member_inner-container' ).html();
			}
			if ( ! this.$wrapper ) {
				this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
			}
			if ( _.isObject( params ) ) {
				var $element = this.elementTemplate.replace(/%%name%%/g, ((params.name) ? params.name : '...'));
				this.$wrapper.find( '.vc_argenta_team_member_inner-container' ).html( $element );
			}
		}
	} );


	/* Icon box shortcode VC view */
	window.VcArgentaIconBoxView = vc.shortcode_view.extend( {
		elementTemplate: false,
		$wrapper: false,
		changeShortcodeParams: function ( model ) {
			var params;

			window.VcArgentaIconBoxView.__super__.changeShortcodeParams.call( this, model );
			params = _.extend( {}, model.get( 'params' ) );
			if ( ! this.elementTemplate ) {
				this.elementTemplate = this.$el.find( '.vc_argenta_icon_box-container' ).html();
			}
			if ( ! this.$wrapper ) {
				this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
			}
			if ( _.isObject( params ) ) {
				var $element = this.elementTemplate.replace(/%%title%%/g, ((params.title) ? params.title : '...'));
				var as_icon = '';
				if ( params.icon_as_icon ) {
					as_icon = '<span class="' + params.icon_as_icon + '"></span>';
				}
				if ( params.icon_as_image ) {
					as_icon = '<span class="small my-icon-fil-image"></span><br>...';
				}
				$element = $element.replace(/%%icon%%/g, as_icon);
				this.$wrapper.find( '.vc_argenta_icon_box-container' ).html( $element );
			}
		}
	} );


	/* Progess bar */
	window.VcArgentaProgressBarView = vc.shortcode_view.extend( {
		elementTemplate: false,
		$wrapper: false,
		changeShortcodeParams: function ( model ) {
			var params;

			window.VcArgentaProgressBarView.__super__.changeShortcodeParams.call( this, model );
			params = _.extend( {}, model.get( 'params' ) );
			if ( ! this.elementTemplate ) {
				this.elementTemplate = this.$el.find( '.vc_argenta_progress_bar-container' ).html();
			}
			if ( ! this.$wrapper ) {
				this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
			}
			if ( _.isObject( params ) ) {
				var title_text = '[Empty]';
				if ( ( params.name && params.name.length ) || ( params.percent && params.percent.length ) ) {
					if ( params.name == undefined ) {
						params.name = '[Empty]';
					}
					title_text = params.name + ': ' + intval(params.percent) + '%'
				}
				var $element = this.elementTemplate.replace(/%%title%%/g, title_text);
				this.$wrapper.find( '.vc_argenta_progress_bar-container' ).html( $element );
			}
		}
	} );


	/* Subscribe */
	window.VcArgentaSubscribeView = vc.shortcode_view.extend( {
		elementTemplate: false,
		$wrapper: false,
		changeShortcodeParams: function ( model ) {
			var params;

			window.VcArgentaSubscribeView.__super__.changeShortcodeParams.call( this, model );
			params = _.extend( {}, model.get( 'params' ) );
			if ( ! this.elementTemplate ) {
				this.elementTemplate = this.$el.find( '.vc_argenta_subscribe-container' ).html();
			}
			if ( ! this.$wrapper ) {
				this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
			}
			if ( _.isObject( params ) ) {
				var title_text = '[Recipient is empty]';
				if ( params.feedburner_name && params.feedburner_name.length ) {
					title_text = '@' + params.feedburner_name;
				}
				var $element = this.elementTemplate.replace(/%%title%%/g, title_text);
				this.$wrapper.find( '.vc_argenta_subscribe-container' ).html( $element );
			}
		}
	} );


	/* Icon box shortcode VC view */
	window.VcArgentaContactInnerView = vc.shortcode_view.extend( {
		elementTemplate: false,
		$wrapper: false,
		changeShortcodeParams: function ( model ) {
			var params;

			window.VcArgentaContactInnerView.__super__.changeShortcodeParams.call( this, model );
			params = _.extend( {}, model.get( 'params' ) );
			if ( ! this.elementTemplate ) {
				this.elementTemplate = this.$el.find( '.vc_argenta_contact_inner-container' ).html();
			}
			if ( ! this.$wrapper ) {
				this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
			}
			if ( _.isObject( params ) ) {
				var $element = this.elementTemplate.replace(/%%info%%/g, ((params.info) ? params.info : '...'));
				var heading = '';
				if (params.block_type_layout != 'without_heading') {
					heading = (params.heading) ? params.heading : '...';
					heading = '<div class="heading">' + heading + '</div>';
				}
				$element = $element.replace(/%%heading%%/g, heading);
				this.$wrapper.find( '.vc_argenta_contact_inner-container' ).html( $element );
			}
		}
	} );


	/* Icon box shortcode VC view */
	window.VcArgentaAccordionInnerView = vc.shortcode_view.extend( {
		elementTemplate: false,
		$wrapper: false,
		changeShortcodeParams: function ( model ) {
			var params;
			window.VcArgentaAccordionInnerView.__super__.changeShortcodeParams.call( this, model );
			params = _.extend( {}, model.get( 'params' ) );
			if ( ! this.elementTemplate ) {
				this.elementTemplate = this.$el.find( '.vc_argenta_accordion_inner-container' ).html();
			}
			if ( ! this.$wrapper ) {
				this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
			}
			if ( _.isObject( params ) ) {
				var $element = this.elementTemplate.replace(/%%heading%%/g, ((params.heading) ? params.heading : '...'));
				this.$wrapper.find( '.vc_argenta_accordion_inner-container' ).html( $element );
			}
		}
	} );


	/* Banner box shortcode VC view */
	window.VcArgentaBannerBoxView = vc.shortcode_view.extend( {
		elementTemplate: false,
		$wrapper: false,
		changeShortcodeParams: function ( model ) {
			var params;

			window.VcArgentaBannerBoxView.__super__.changeShortcodeParams.call( this, model );
			params = _.extend( {}, model.get( 'params' ) );
			if ( ! this.elementTemplate ) {
				this.elementTemplate = this.$el.find( '.vc_argenta_banner_box-container' ).html();
			}
			if ( ! this.$wrapper ) {
				this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
			}
			if ( _.isObject( params ) ) {
				var $element = this.elementTemplate.replace(/%%title%%/g, ((params.title) ? params.title : '...'));
				$element = $element.replace(/%%subtitle%%/g, ((params.subtitle) ? params.subtitle : '...'));
				this.$wrapper.find( '.vc_argenta_banner_box-container' ).html( $element );
			}
		}
	} );


	/* Banner box inner shortcode VC view */
	window.VcArgentaBannerBoxInnerView = vc.shortcode_view.extend( {
		elementTemplate: false,
		$wrapper: false,
		changeShortcodeParams: function ( model ) {
			var params;

			window.VcArgentaBannerBoxInnerView.__super__.changeShortcodeParams.call( this, model );
			params = _.extend( {}, model.get( 'params' ) );
			if ( ! this.elementTemplate ) {
				this.elementTemplate = this.$el.find( '.vc_argenta_banner_box_inner-container' ).html();
			}
			if ( ! this.$wrapper ) {
				this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
			}
			if ( _.isObject( params ) ) {
				var $element = this.elementTemplate.replace(/%%title%%/g, ((params.title) ? params.title : '...'));
				$element = $element.replace(/%%subtitle%%/g, ((params.subtitle) ? params.subtitle : '...'));
				this.$wrapper.find( '.vc_argenta_banner_box_inner-container' ).html( $element );
			}
		}
	} );


	/* Pricing table shortcode VC view */
	window.VcArgentaPricingTableView = vc.shortcode_view.extend( {
		elementTemplate: false,
		$wrapper: false,
		changeShortcodeParams: function ( model ) {
			var params;

			window.VcArgentaPricingTableView.__super__.changeShortcodeParams.call( this, model );
			params = _.extend( {}, model.get( 'params' ) );
			if ( ! this.elementTemplate ) {
				this.elementTemplate = this.$el.find( '.vc_argenta_pricing_table-container' ).html();
			}
			if ( ! this.$wrapper ) {
				this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
			}
			if ( _.isObject( params ) ) {
				var $element = this.elementTemplate.replace(/%%title%%/g, ((params.title) ? params.title : '...'));
				$element = $element.replace(/%%price%%/g, ((params.price) ? params.price : '...'));
				this.$wrapper.find( '.vc_argenta_pricing_table-container' ).html( $element );
			}
		}
	} );


	/* Pricing table shortcode VC view */
	window.VcArgentaPricingTableFeaturesView = vc.shortcode_view.extend( {
		elementTemplate: false,
		$wrapper: false,
		changeShortcodeParams: function ( model ) {
			var params;

			window.VcArgentaPricingTableFeaturesView.__super__.changeShortcodeParams.call( this, model );
			params = _.extend( {}, model.get( 'params' ) );
			if ( ! this.elementTemplate ) {
				this.elementTemplate = this.$el.find( '.vc_argenta_pricing_table_features-container' ).html();
			}
			if ( ! this.$wrapper ) {
				this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
			}
			if ( _.isObject( params ) ) {
				var $element = this.elementTemplate.replace(/%%title%%/g, ((params.title) ? params.title : '...'));
				this.$wrapper.find( '.vc_argenta_pricing_table_features-container' ).html( $element );
			}
		}
	} );


	/* Team Member Inner */
	window.VcArgentaGroupColumnView = vc.shortcode_view.extend({
		events: {
			'click > .vc_controls [data-vc-control="delete"]': "deleteShortcode",
			'click > .vc_controls [data-vc-control="add"]': "addElement",
			'click > .vc_controls [data-vc-control="edit"]': "editElement",
			'click > .vc_controls [data-vc-control="clone"]': "clone",
			"click > .wpb_element_wrapper > .vc_empty-container": "addToEmpty"
		},
		current_column_width: !1,
		initialize: function(options) {
			window.VcArgentaGroupColumnView.__super__.initialize.call(this, options), _.bindAll(this, "setDropable", "dropButton")
		},
		ready: function(e) {
			return window.VcArgentaGroupColumnView.__super__.ready.call(this, e), this.setDropable(), this
		},
		render: function() {
			return window.VcArgentaGroupColumnView.__super__.render.call(this), this.current_column_width = this.model.get("params").width || "1/1", this.$el.attr("data-width", this.current_column_width), this.setEmpty(), this
		},
		changeShortcodeParams: function(model) {
			window.VcArgentaGroupColumnView.__super__.changeShortcodeParams.call(this, model), this.setColumnClasses(), this.buildDesignHelpers()
		},
		designHelpersSelector: "> .vc_controls .column_add",
		buildDesignHelpers: function() {
			var matches, image, color, css = this.model.getParam("css"),
				$column_toggle = this.$el.find(this.designHelpersSelector).get(0);
			this.$el.find("> .vc_controls .vc_column_color").remove(), this.$el.find("> .vc_controls .vc_column_image").remove(), matches = css.match(/background\-image:\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (image = matches[1]), matches = css.match(/background\-color:\s*([^\s\;]+)\b/), matches && !_.isUndefined(matches[1]) && (color = matches[1]), matches = css.match(/background:\s*([^\s]+)\b\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (color = matches[1], image = matches[2]), image && jQuery('<span class="vc_column_image" style="background-image: url(' + image + ');" title="' + i18nLocale.column_background_image + '"></span>').insertBefore($column_toggle), color && jQuery('<span class="vc_column_color" style="background-color: ' + color + '" title="' + i18nLocale.column_background_color + '"></span>').insertBefore($column_toggle)
		},
		setColumnClasses: function() {
			var current_css_class_width, offset = this.model.getParam("offset") || "",
				width = this.model.getParam("width") || "1/1",
				css_class_width = this.convertSize(width);
			this.current_offset_class && this.$el.removeClass(this.current_offset_class), this.current_column_width !== width && (current_css_class_width = this.convertSize(this.current_column_width), this.$el.attr("data-width", width).removeClass(current_css_class_width).addClass(css_class_width), this.current_column_width = width), offset.match(/vc_col\-sm\-\d+/) && this.$el.removeClass(css_class_width), _.isEmpty(offset) || this.$el.addClass(offset), this.current_offset_class = offset
		},
		addToEmpty: function(e) {
			row =  vc.shortcodes.create({
				shortcode: "argenta_sc_team_member_inner",
				params: [],
				parent_id: this.model.id
			});
			//e.preventDefault(), jQuery(e.target).hasClass("vc_empty-container") && this.addElement(e)
		},
		addElement: function(e) {
			row =  vc.shortcodes.create({
				shortcode: "argenta_sc_team_member_inner",
				params: [],
				parent_id: this.model.id
			});
		},
		setDropable: function() {
			return this.$content.droppable({
				greedy: !0,
				accept: "vc_column_inner" === this.model.get("shortcode") ? ".dropable_el" : ".dropable_el,.dropable_row",
				hoverClass: "wpb_ui-state-active",
				drop: this.dropButton
			}), this
		},
		dropButton: function(event, ui) {
			ui.draggable.is("#wpb-add-new-element") ? new vc.element_block_view({
				model: {
					position_to_add: "end"
				}
			}).show(this) : ui.draggable.is("#wpb-add-new-row") && this.createRow()
		},
		setEmpty: function() {
			this.$el.addClass("vc_empty-column"), "edit" !== vc_user_access().getState("shortcodes") && this.$content.addClass("vc_empty-container")
		},
		unsetEmpty: function() {
			this.$el.removeClass("vc_empty-column"), this.$content.removeClass("vc_empty-container")
		},
		checkIsEmpty: function() {
			vc.shortcodes.where({
				parent_id: this.model.id
			}).length ? this.unsetEmpty() : this.setEmpty(), window.VcArgentaGroupColumnView.__super__.checkIsEmpty.call(this)
		},
		createRow: function() {
			var row_params, column_params, row;
			return row_params = {}, "undefined" != typeof window.vc_settings_presets.vc_row_inner && (row_params = _.extend(row_params, window.vc_settings_presets.vc_row_inner)), column_params = {
				width: "1/1"
			}, "undefined" != typeof window.vc_settings_presets.vc_column_inner && (column_params = _.extend(column_params, window.vc_settings_presets.vc_column_inner)), row = Shortcodes.create({
				shortcode: "vc_row_inner",
				params: row_params,
				parent_id: this.model.id
			}), vc.shortcodes.create({
				shortcode: "vc_column_inner",
				params: column_params,
				parent_id: row.id
			}), row
		},
		convertSize: function(width) {
			var prefix = "vc_col-sm-",
				numbers = width ? width.split("/") : [1, 1],
				range = _.range(1, 13),
				num = !_.isUndefined(numbers[0]) && 0 <= _.indexOf(range, parseInt(numbers[0], 10)) ? parseInt(numbers[0], 10) : !1,
				dev = !_.isUndefined(numbers[1]) && 0 <= _.indexOf(range, parseInt(numbers[1], 10)) ? parseInt(numbers[1], 10) : !1;
			return !1 !== num && !1 !== dev ? prefix + 12 * num / dev : prefix + "12"
		},
		deleteShortcode: function(e) {
			var parent, parent_id = this.model.get("parent_id");
			_.isObject(e) && e.preventDefault();
			var answer = confirm(window.i18nLocale.press_ok_to_delete_section);
			return !0 !== answer ? !1 : (this.model.destroy(), void(parent_id && !vc.shortcodes.where({
				parent_id: parent_id
			}).length ? (parent = vc.shortcodes.get(parent_id), _.contains(["vc_column", "vc_column_inner"], parent.get("shortcode")) || parent.destroy()) : parent_id && (parent = vc.shortcodes.get(parent_id), parent && parent.view && parent.view.setActiveLayoutButton && parent.view.setActiveLayoutButton())))
		},
		remove: function() {
			this.$content && this.$content.data("uiSortable") && this.$content.sortable("destroy"), this.$content && this.$content.data("uiDroppable") && this.$content.droppable("destroy"), delete vc.app.views[this.model.id], window.VcColumnView.__super__.remove.call(this)
		}
	});


	/* Banner Box Inner */
	window.VcArgentaBannersGroupColumnView = vc.shortcode_view.extend({
		events: {
			'click > .vc_controls [data-vc-control="delete"]': "deleteShortcode",
			'click > .vc_controls [data-vc-control="add"]': "addElement",
			'click > .vc_controls [data-vc-control="edit"]': "editElement",
			'click > .vc_controls [data-vc-control="clone"]': "clone",
			"click > .wpb_element_wrapper > .vc_empty-container": "addToEmpty"
		},
		current_column_width: !1,
		initialize: function(options) {
			window.VcArgentaBannersGroupColumnView.__super__.initialize.call(this, options), _.bindAll(this, "setDropable", "dropButton")
		},
		ready: function(e) {
			return window.VcArgentaBannersGroupColumnView.__super__.ready.call(this, e), this.setDropable(), this
		},
		render: function() {
			return window.VcArgentaBannersGroupColumnView.__super__.render.call(this), this.current_column_width = this.model.get("params").width || "1/1", this.$el.attr("data-width", this.current_column_width), this.setEmpty(), this
		},
		changeShortcodeParams: function(model) {
			window.VcArgentaBannersGroupColumnView.__super__.changeShortcodeParams.call(this, model), this.setColumnClasses(), this.buildDesignHelpers()
		},
		designHelpersSelector: "> .vc_controls .column_add",
		buildDesignHelpers: function() {
			var matches, image, color, css = this.model.getParam("css"),
				$column_toggle = this.$el.find(this.designHelpersSelector).get(0);
			this.$el.find("> .vc_controls .vc_column_color").remove(), this.$el.find("> .vc_controls .vc_column_image").remove(), matches = css.match(/background\-image:\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (image = matches[1]), matches = css.match(/background\-color:\s*([^\s\;]+)\b/), matches && !_.isUndefined(matches[1]) && (color = matches[1]), matches = css.match(/background:\s*([^\s]+)\b\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (color = matches[1], image = matches[2]), image && jQuery('<span class="vc_column_image" style="background-image: url(' + image + ');" title="' + i18nLocale.column_background_image + '"></span>').insertBefore($column_toggle), color && jQuery('<span class="vc_column_color" style="background-color: ' + color + '" title="' + i18nLocale.column_background_color + '"></span>').insertBefore($column_toggle)
		},
		setColumnClasses: function() {
			var current_css_class_width, offset = this.model.getParam("offset") || "",
				width = this.model.getParam("width") || "1/1",
				css_class_width = this.convertSize(width);
			this.current_offset_class && this.$el.removeClass(this.current_offset_class), this.current_column_width !== width && (current_css_class_width = this.convertSize(this.current_column_width), this.$el.attr("data-width", width).removeClass(current_css_class_width).addClass(css_class_width), this.current_column_width = width), offset.match(/vc_col\-sm\-\d+/) && this.$el.removeClass(css_class_width), _.isEmpty(offset) || this.$el.addClass(offset), this.current_offset_class = offset
		},
		addToEmpty: function(e) {
			row =  vc.shortcodes.create({
				shortcode: "argenta_sc_banner_box_inner",
				params: [],
				parent_id: this.model.id
			});
			//e.preventDefault(), jQuery(e.target).hasClass("vc_empty-container") && this.addElement(e)
		},
		addElement: function(e) {
			row =  vc.shortcodes.create({
				shortcode: "argenta_sc_banner_box_inner",
				params: [],
				parent_id: this.model.id
			});
		},
		setDropable: function() {
			return this.$content.droppable({
				greedy: !0,
				accept: "vc_column_inner" === this.model.get("shortcode") ? ".dropable_el" : ".dropable_el,.dropable_row",
				hoverClass: "wpb_ui-state-active",
				drop: this.dropButton
			}), this
		},
		dropButton: function(event, ui) {
			ui.draggable.is("#wpb-add-new-element") ? new vc.element_block_view({
				model: {
					position_to_add: "end"
				}
			}).show(this) : ui.draggable.is("#wpb-add-new-row") && this.createRow()
		},
		setEmpty: function() {
			this.$el.addClass("vc_empty-column"), "edit" !== vc_user_access().getState("shortcodes") && this.$content.addClass("vc_empty-container")
		},
		unsetEmpty: function() {
			this.$el.removeClass("vc_empty-column"), this.$content.removeClass("vc_empty-container")
		},
		checkIsEmpty: function() {
			vc.shortcodes.where({
				parent_id: this.model.id
			}).length ? this.unsetEmpty() : this.setEmpty(), window.VcArgentaBannersGroupColumnView.__super__.checkIsEmpty.call(this)
		},
		createRow: function() {
			var row_params, column_params, row;
			return row_params = {}, "undefined" != typeof window.vc_settings_presets.vc_row_inner && (row_params = _.extend(row_params, window.vc_settings_presets.vc_row_inner)), column_params = {
				width: "1/1"
			}, "undefined" != typeof window.vc_settings_presets.vc_column_inner && (column_params = _.extend(column_params, window.vc_settings_presets.vc_column_inner)), row = Shortcodes.create({
				shortcode: "vc_row_inner",
				params: row_params,
				parent_id: this.model.id
			}), vc.shortcodes.create({
				shortcode: "vc_column_inner",
				params: column_params,
				parent_id: row.id
			}), row
		},
		convertSize: function(width) {
			var prefix = "vc_col-sm-",
				numbers = width ? width.split("/") : [1, 1],
				range = _.range(1, 13),
				num = !_.isUndefined(numbers[0]) && 0 <= _.indexOf(range, parseInt(numbers[0], 10)) ? parseInt(numbers[0], 10) : !1,
				dev = !_.isUndefined(numbers[1]) && 0 <= _.indexOf(range, parseInt(numbers[1], 10)) ? parseInt(numbers[1], 10) : !1;
			return !1 !== num && !1 !== dev ? prefix + 12 * num / dev : prefix + "12"
		},
		deleteShortcode: function(e) {
			var parent, parent_id = this.model.get("parent_id");
			_.isObject(e) && e.preventDefault();
			var answer = confirm(window.i18nLocale.press_ok_to_delete_section);
			return !0 !== answer ? !1 : (this.model.destroy(), void(parent_id && !vc.shortcodes.where({
				parent_id: parent_id
			}).length ? (parent = vc.shortcodes.get(parent_id), _.contains(["vc_column", "vc_column_inner"], parent.get("shortcode")) || parent.destroy()) : parent_id && (parent = vc.shortcodes.get(parent_id), parent && parent.view && parent.view.setActiveLayoutButton && parent.view.setActiveLayoutButton())))
		},
		remove: function() {
			this.$content && this.$content.data("uiSortable") && this.$content.sortable("destroy"), this.$content && this.$content.data("uiDroppable") && this.$content.droppable("destroy"), delete vc.app.views[this.model.id], window.VcColumnView.__super__.remove.call(this)
		}
	});


	/* Split Screen */
	window.VcArgentaSplitScreensView = vc.shortcode_view.extend({
		events: {
			'click > .vc_controls [data-vc-control="delete"]': "deleteShortcode",
			'click > .vc_controls [data-vc-control="add"]': "addElement",
			'click > .vc_controls [data-vc-control="edit"]': "editElement",
			'click > .vc_controls [data-vc-control="clone"]': "clone",
			"click > .wpb_element_wrapper > .vc_empty-container": "addToEmpty"
		},
		current_column_width: !1,
		initialize: function(options) {
			window.VcArgentaSplitScreensView.__super__.initialize.call(this, options), _.bindAll(this, "setDropable", "dropButton")
		},
		ready: function(e) {
			return window.VcArgentaSplitScreensView.__super__.ready.call(this, e), this.setDropable(), this
		},
		render: function() {
			return window.VcArgentaSplitScreensView.__super__.render.call(this), this.current_column_width = this.model.get("params").width || "1/1", this.$el.attr("data-width", this.current_column_width), this.setEmpty(), this
		},
		changeShortcodeParams: function(model) {
			window.VcArgentaSplitScreensView.__super__.changeShortcodeParams.call(this, model), this.setColumnClasses(), this.buildDesignHelpers()
		},
		designHelpersSelector: "> .vc_controls .column_add",
		buildDesignHelpers: function() {
			var matches, image, color, css = this.model.getParam("css"),
				$column_toggle = this.$el.find(this.designHelpersSelector).get(0);
			this.$el.find("> .vc_controls .vc_column_color").remove(), this.$el.find("> .vc_controls .vc_column_image").remove(), matches = css.match(/background\-image:\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (image = matches[1]), matches = css.match(/background\-color:\s*([^\s\;]+)\b/), matches && !_.isUndefined(matches[1]) && (color = matches[1]), matches = css.match(/background:\s*([^\s]+)\b\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (color = matches[1], image = matches[2]), image && jQuery('<span class="vc_column_image" style="background-image: url(' + image + ');" title="' + i18nLocale.column_background_image + '"></span>').insertBefore($column_toggle), color && jQuery('<span class="vc_column_color" style="background-color: ' + color + '" title="' + i18nLocale.column_background_color + '"></span>').insertBefore($column_toggle)
		},
		setColumnClasses: function() {
			var current_css_class_width, offset = this.model.getParam("offset") || "",
				width = this.model.getParam("width") || "1/1",
				css_class_width = this.convertSize(width);
			this.current_offset_class && this.$el.removeClass(this.current_offset_class), this.current_column_width !== width && (current_css_class_width = this.convertSize(this.current_column_width), this.$el.attr("data-width", width).removeClass(current_css_class_width).addClass(css_class_width), this.current_column_width = width), offset.match(/vc_col\-sm\-\d+/) && this.$el.removeClass(css_class_width), _.isEmpty(offset) || this.$el.addClass(offset), this.current_offset_class = offset
		},
		addToEmpty: function(e) {
			row =  vc.shortcodes.create({
				shortcode: "argenta_sc_split_screen",
				params: [],
				parent_id: this.model.id
			});
			//e.preventDefault(), jQuery(e.target).hasClass("vc_empty-container") && this.addElement(e)
		},
		addElement: function(e) {
			row =  vc.shortcodes.create({
				shortcode: "argenta_sc_split_screen",
				params: [],
				parent_id: this.model.id
			});
			return false;
		},
		setDropable: function() {
			return this.$content.droppable({
				greedy: !0,
				accept: "vc_column_inner" === this.model.get("shortcode") ? ".dropable_el" : ".dropable_el,.dropable_row",
				hoverClass: "wpb_ui-state-active",
				drop: this.dropButton
			}), this
		},
		dropButton: function(event, ui) {
			ui.draggable.is("#wpb-add-new-element") ? new vc.element_block_view({
				model: {
					position_to_add: "end"
				}
			}).show(this) : ui.draggable.is("#wpb-add-new-row") && this.createRow()
		},
		setEmpty: function() {
			this.$el.addClass("vc_empty-column"), "edit" !== vc_user_access().getState("shortcodes") && this.$content.addClass("vc_empty-container")
		},
		unsetEmpty: function() {
			this.$el.removeClass("vc_empty-column"), this.$content.removeClass("vc_empty-container")
		},
		checkIsEmpty: function() {
			vc.shortcodes.where({
				parent_id: this.model.id
			}).length ? this.unsetEmpty() : this.setEmpty(), window.VcArgentaSplitScreensView.__super__.checkIsEmpty.call(this)
		},
				createRow: function() {
			var row_params, column_params, row;
			return row_params = {}, "undefined" != typeof window.vc_settings_presets.vc_row_inner && (row_params = _.extend(row_params, window.vc_settings_presets.vc_row_inner)), column_params = {
				width: "1/1"
			}, "undefined" != typeof window.vc_settings_presets.vc_column_inner && (column_params = _.extend(column_params, window.vc_settings_presets.vc_column_inner)), row = Shortcodes.create({
				shortcode: "vc_row_inner",
				params: row_params,
				parent_id: this.model.id
			}), vc.shortcodes.create({
				shortcode: "vc_column_inner",
				params: column_params,
				parent_id: row.id
			}), row
		},
		convertSize: function(width) {
			var prefix = "vc_col-sm-",
				numbers = width ? width.split("/") : [1, 1],
				range = _.range(1, 13),
				num = !_.isUndefined(numbers[0]) && 0 <= _.indexOf(range, parseInt(numbers[0], 10)) ? parseInt(numbers[0], 10) : !1,
				dev = !_.isUndefined(numbers[1]) && 0 <= _.indexOf(range, parseInt(numbers[1], 10)) ? parseInt(numbers[1], 10) : !1;
			return !1 !== num && !1 !== dev ? prefix + 12 * num / dev : prefix + "12"
		},
		deleteShortcode: function(e) {
			var parent, parent_id = this.model.get("parent_id");
			_.isObject(e) && e.preventDefault();
			var answer = confirm(window.i18nLocale.press_ok_to_delete_section);
			return !0 !== answer ? !1 : (this.model.destroy(), void(parent_id && !vc.shortcodes.where({
				parent_id: parent_id
			}).length ? (parent = vc.shortcodes.get(parent_id), _.contains(["vc_column", "vc_column_inner"], parent.get("shortcode")) || parent.destroy()) : parent_id && (parent = vc.shortcodes.get(parent_id), parent && parent.view && parent.view.setActiveLayoutButton && parent.view.setActiveLayoutButton())))
		},
		remove: function() {
			this.$content && this.$content.data("uiSortable") && this.$content.sortable("destroy"), this.$content && this.$content.data("uiDroppable") && this.$content.droppable("destroy"), delete vc.app.views[this.model.id], window.VcColumnView.__super__.remove.call(this)
		}
	});


	/* Split Screen Column */
	window.VcArgentaSplitScreenView = vc.shortcode_view.extend({
		events: {
			'click > .vc_controls [data-vc-control="delete"]': "deleteShortcode",
			'click > .vc_controls [data-vc-control="add"]': "addElement",
			'click > .vc_controls [data-vc-control="edit"]': "editElement",
			'click > .vc_controls [data-vc-control="clone"]': "clone",
			"click > .wpb_element_wrapper > .vc_empty-container": "addToEmpty"
		},
		current_column_width: !1,
		initialize: function(options) {
			window.VcArgentaSplitScreenView.__super__.initialize.call(this, options), _.bindAll(this, "setDropable", "dropButton")
		},
		ready: function(e) {
			return window.VcArgentaSplitScreenView.__super__.ready.call(this, e), this.setDropable(), this
		},
		render: function() {
			return window.VcArgentaSplitScreenView.__super__.render.call(this), this.current_column_width = this.model.get("params").width || "1/1", this.$el.attr("data-width", this.current_column_width), this.setEmpty(), this
		},
		changeShortcodeParams: function(model) {
			window.VcArgentaSplitScreenView.__super__.changeShortcodeParams.call(this, model), this.setColumnClasses(), this.buildDesignHelpers()
		},
		designHelpersSelector: "> .vc_controls .column_add",
		buildDesignHelpers: function() {
			var matches, image, color, css = this.model.getParam("css"),
				$column_toggle = this.$el.find(this.designHelpersSelector).get(0);
			this.$el.find("> .vc_controls .vc_column_color").remove(), this.$el.find("> .vc_controls .vc_column_image").remove(), matches = css.match(/background\-image:\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (image = matches[1]), matches = css.match(/background\-color:\s*([^\s\;]+)\b/), matches && !_.isUndefined(matches[1]) && (color = matches[1]), matches = css.match(/background:\s*([^\s]+)\b\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (color = matches[1], image = matches[2]), image && jQuery('<span class="vc_column_image" style="background-image: url(' + image + ');" title="' + i18nLocale.column_background_image + '"></span>').insertBefore($column_toggle), color && jQuery('<span class="vc_column_color" style="background-color: ' + color + '" title="' + i18nLocale.column_background_color + '"></span>').insertBefore($column_toggle)
		},
		setColumnClasses: function() {
			var current_css_class_width, offset = this.model.getParam("offset") || "",
				width = this.model.getParam("width") || "1/1",
				css_class_width = this.convertSize(width);
			this.current_offset_class && this.$el.removeClass(this.current_offset_class), this.current_column_width !== width && (current_css_class_width = this.convertSize(this.current_column_width), this.$el.attr("data-width", width).removeClass(current_css_class_width).addClass(css_class_width), this.current_column_width = width), offset.match(/vc_col\-sm\-\d+/) && this.$el.removeClass(css_class_width), _.isEmpty(offset) || this.$el.addClass(offset), this.current_offset_class = offset
		},
		addToEmpty: function(e) {
			row =  vc.shortcodes.create({
				shortcode: "argenta_sc_split_screen_column",
				params: [],
				parent_id: this.model.id
			});
			//e.preventDefault(), jQuery(e.target).hasClass("vc_empty-container") && this.addElement(e)
		},
		addElement: function(e) {
			row =  vc.shortcodes.create({
				shortcode: "argenta_sc_split_screen_column",
				params: [],
				parent_id: this.model.id
			});
			return false;
		},
		setDropable: function() {
			return this.$content.droppable({
				greedy: !0,
				accept: "vc_column_inner" === this.model.get("shortcode") ? ".dropable_el" : ".dropable_el,.dropable_row",
				hoverClass: "wpb_ui-state-active",
				drop: this.dropButton
			}), this
		},
		dropButton: function(event, ui) {
			ui.draggable.is("#wpb-add-new-element") ? new vc.element_block_view({
				model: {
					position_to_add: "end"
				}
			}).show(this) : ui.draggable.is("#wpb-add-new-row") && this.createRow()
		},
		setEmpty: function() {
			this.$el.addClass("vc_empty-column"), "edit" !== vc_user_access().getState("shortcodes") && this.$content.addClass("vc_empty-container")
		},
		unsetEmpty: function() {
			this.$el.removeClass("vc_empty-column"), this.$content.removeClass("vc_empty-container")
		},
		checkIsEmpty: function() {
			vc.shortcodes.where({
				parent_id: this.model.id
			}).length ? this.unsetEmpty() : this.setEmpty(), window.VcArgentaSplitScreenView.__super__.checkIsEmpty.call(this)
		},
				createRow: function() {
			var row_params, column_params, row;
			return row_params = {}, "undefined" != typeof window.vc_settings_presets.vc_row_inner && (row_params = _.extend(row_params, window.vc_settings_presets.vc_row_inner)), column_params = {
				width: "1/1"
			}, "undefined" != typeof window.vc_settings_presets.vc_column_inner && (column_params = _.extend(column_params, window.vc_settings_presets.vc_column_inner)), row = Shortcodes.create({
				shortcode: "vc_row_inner",
				params: row_params,
				parent_id: this.model.id
			}), vc.shortcodes.create({
				shortcode: "vc_column_inner",
				params: column_params,
				parent_id: row.id
			}), row
		},
		convertSize: function(width) {
			var prefix = "vc_col-sm-",
				numbers = width ? width.split("/") : [1, 1],
				range = _.range(1, 13),
				num = !_.isUndefined(numbers[0]) && 0 <= _.indexOf(range, parseInt(numbers[0], 10)) ? parseInt(numbers[0], 10) : !1,
				dev = !_.isUndefined(numbers[1]) && 0 <= _.indexOf(range, parseInt(numbers[1], 10)) ? parseInt(numbers[1], 10) : !1;
			return !1 !== num && !1 !== dev ? prefix + 12 * num / dev : prefix + "12"
		},
		deleteShortcode: function(e) {
			var parent, parent_id = this.model.get("parent_id");
			_.isObject(e) && e.preventDefault();
			var answer = confirm(window.i18nLocale.press_ok_to_delete_section);
			return !0 !== answer ? !1 : (this.model.destroy(), void(parent_id && !vc.shortcodes.where({
				parent_id: parent_id
			}).length ? (parent = vc.shortcodes.get(parent_id), _.contains(["vc_column", "vc_column_inner"], parent.get("shortcode")) || parent.destroy()) : parent_id && (parent = vc.shortcodes.get(parent_id), parent && parent.view && parent.view.setActiveLayoutButton && parent.view.setActiveLayoutButton())))
		},
		remove: function() {
			this.$content && this.$content.data("uiSortable") && this.$content.sortable("destroy"), this.$content && this.$content.data("uiDroppable") && this.$content.droppable("destroy"), delete vc.app.views[this.model.id], window.VcColumnView.__super__.remove.call(this)
		}
	});


	/* Contacts Inner */
	window.VcArgentaContactsGroupColumnView = vc.shortcode_view.extend({
		events: {
			'click > .vc_controls [data-vc-control="delete"]': "deleteShortcode",
			'click > .vc_controls [data-vc-control="add"]': "addElement",
			'click > .vc_controls [data-vc-control="edit"]': "editElement",
			'click > .vc_controls [data-vc-control="clone"]': "clone",
			"click > .wpb_element_wrapper > .vc_empty-container": "addToEmpty"
		},
		current_column_width: !1,
		initialize: function(options) {
			window.VcArgentaContactsGroupColumnView.__super__.initialize.call(this, options), _.bindAll(this, "setDropable", "dropButton")
		},
		ready: function(e) {
			return window.VcArgentaContactsGroupColumnView.__super__.ready.call(this, e), this.setDropable(), this
		},
		render: function() {
			return window.VcArgentaContactsGroupColumnView.__super__.render.call(this), this.current_column_width = this.model.get("params").width || "1/1", this.$el.attr("data-width", this.current_column_width), this.setEmpty(), this
		},
		changeShortcodeParams: function(model) {
			window.VcArgentaContactsGroupColumnView.__super__.changeShortcodeParams.call(this, model), this.setColumnClasses(), this.buildDesignHelpers()
		},
		designHelpersSelector: "> .vc_controls .column_add",
		buildDesignHelpers: function() {
			var matches, image, color, css = this.model.getParam("css"),
				$column_toggle = this.$el.find(this.designHelpersSelector).get(0);
			this.$el.find("> .vc_controls .vc_column_color").remove(), this.$el.find("> .vc_controls .vc_column_image").remove(), matches = css.match(/background\-image:\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (image = matches[1]), matches = css.match(/background\-color:\s*([^\s\;]+)\b/), matches && !_.isUndefined(matches[1]) && (color = matches[1]), matches = css.match(/background:\s*([^\s]+)\b\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (color = matches[1], image = matches[2]), image && jQuery('<span class="vc_column_image" style="background-image: url(' + image + ');" title="' + i18nLocale.column_background_image + '"></span>').insertBefore($column_toggle), color && jQuery('<span class="vc_column_color" style="background-color: ' + color + '" title="' + i18nLocale.column_background_color + '"></span>').insertBefore($column_toggle)
		},
		setColumnClasses: function() {
			var current_css_class_width, offset = this.model.getParam("offset") || "",
				width = this.model.getParam("width") || "1/1",
				css_class_width = this.convertSize(width);
			this.current_offset_class && this.$el.removeClass(this.current_offset_class), this.current_column_width !== width && (current_css_class_width = this.convertSize(this.current_column_width), this.$el.attr("data-width", width).removeClass(current_css_class_width).addClass(css_class_width), this.current_column_width = width), offset.match(/vc_col\-sm\-\d+/) && this.$el.removeClass(css_class_width), _.isEmpty(offset) || this.$el.addClass(offset), this.current_offset_class = offset
		},
		addToEmpty: function(e) {
			row =  vc.shortcodes.create({
				shortcode: "argenta_sc_contact_inner",
				params: [],
				parent_id: this.model.id
			});
			//e.preventDefault(), jQuery(e.target).hasClass("vc_empty-container") && this.addElement(e)
		},
		addElement: function(e) {
			row =  vc.shortcodes.create({
				shortcode: "argenta_sc_contact_inner",
				params: [],
				parent_id: this.model.id
			});
			return false;
		},
		setDropable: function() {
			return this.$content.droppable({
				greedy: !0,
				accept: "vc_column_inner" === this.model.get("shortcode") ? ".dropable_el" : ".dropable_el,.dropable_row",
				hoverClass: "wpb_ui-state-active",
				drop: this.dropButton
			}), this
		},
		dropButton: function(event, ui) {
			ui.draggable.is("#wpb-add-new-element") ? new vc.element_block_view({
				model: {
					position_to_add: "end"
				}
			}).show(this) : ui.draggable.is("#wpb-add-new-row") && this.createRow()
		},
		setEmpty: function() {
			this.$el.addClass("vc_empty-column"), "edit" !== vc_user_access().getState("shortcodes") && this.$content.addClass("vc_empty-container")
		},
		unsetEmpty: function() {
			this.$el.removeClass("vc_empty-column"), this.$content.removeClass("vc_empty-container")
		},
		checkIsEmpty: function() {
			vc.shortcodes.where({
				parent_id: this.model.id
			}).length ? this.unsetEmpty() : this.setEmpty(), window.VcArgentaContactsGroupColumnView.__super__.checkIsEmpty.call(this)
		},
		createRow: function() {
			var row_params, column_params, row;
			return row_params = {}, "undefined" != typeof window.vc_settings_presets.vc_row_inner && (row_params = _.extend(row_params, window.vc_settings_presets.vc_row_inner)), column_params = {
				width: "1/1"
			}, "undefined" != typeof window.vc_settings_presets.vc_column_inner && (column_params = _.extend(column_params, window.vc_settings_presets.vc_column_inner)), row = Shortcodes.create({
				shortcode: "vc_row_inner",
				params: row_params,
				parent_id: this.model.id
			}), vc.shortcodes.create({
				shortcode: "vc_column_inner",
				params: column_params,
				parent_id: row.id
			}), row
		},
		convertSize: function(width) {
			var prefix = "vc_col-sm-",
				numbers = width ? width.split("/") : [1, 1],
				range = _.range(1, 13),
				num = !_.isUndefined(numbers[0]) && 0 <= _.indexOf(range, parseInt(numbers[0], 10)) ? parseInt(numbers[0], 10) : !1,
				dev = !_.isUndefined(numbers[1]) && 0 <= _.indexOf(range, parseInt(numbers[1], 10)) ? parseInt(numbers[1], 10) : !1;
			return !1 !== num && !1 !== dev ? prefix + 12 * num / dev : prefix + "12"
		},
		deleteShortcode: function(e) {
			var parent, parent_id = this.model.get("parent_id");
			_.isObject(e) && e.preventDefault();
			var answer = confirm(window.i18nLocale.press_ok_to_delete_section);
			return !0 !== answer ? !1 : (this.model.destroy(), void(parent_id && !vc.shortcodes.where({
				parent_id: parent_id
			}).length ? (parent = vc.shortcodes.get(parent_id), _.contains(["vc_column", "vc_column_inner"], parent.get("shortcode")) || parent.destroy()) : parent_id && (parent = vc.shortcodes.get(parent_id), parent && parent.view && parent.view.setActiveLayoutButton && parent.view.setActiveLayoutButton())))
		},
		remove: function() {
			this.$content && this.$content.data("uiSortable") && this.$content.sortable("destroy"), this.$content && this.$content.data("uiDroppable") && this.$content.droppable("destroy"), delete vc.app.views[this.model.id], window.VcColumnView.__super__.remove.call(this)
		}
	});


	/* Split Box Column */
	window.VcArgentaSplitBoxColumnView = vc.shortcode_view.extend({
		events: {
			'click > .vc_controls [data-vc-control="delete"]': "deleteShortcode",
			'click > .vc_controls [data-vc-control="edit"]': "editElement",
			'click > .vc_controls [data-vc-control="clone"]': "clone"
		},
		current_column_width: !1,
		initialize: function(options) {
			window.VcArgentaSplitBoxColumnView.__super__.initialize.call(this, options), _.bindAll(this, "setDropable", "dropButton")
		},
		ready: function(e) {
			return window.VcArgentaSplitBoxColumnView.__super__.ready.call(this, e), this.setDropable(), this
		},
		render: function() {
			return window.VcArgentaSplitBoxColumnView.__super__.render.call(this), this.current_column_width = this.model.get("params").width || "1/1", this.$el.attr("data-width", this.current_column_width), this.setEmpty(), this
		},
		changeShortcodeParams: function(model) {
			window.VcArgentaSplitBoxColumnView.__super__.changeShortcodeParams.call(this, model), this.setColumnClasses(), this.buildDesignHelpers()
		},
		designHelpersSelector: "> .vc_controls .column_add",
		buildDesignHelpers: function() {
			var matches, image, color, css = this.model.getParam("css"),
				$column_toggle = this.$el.find(this.designHelpersSelector).get(0);
			this.$el.find("> .vc_controls .vc_column_color").remove(), this.$el.find("> .vc_controls .vc_column_image").remove(), matches = css.match(/background\-image:\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (image = matches[1]), matches = css.match(/background\-color:\s*([^\s\;]+)\b/), matches && !_.isUndefined(matches[1]) && (color = matches[1]), matches = css.match(/background:\s*([^\s]+)\b\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (color = matches[1], image = matches[2]), image && jQuery('<span class="vc_column_image" style="background-image: url(' + image + ');" title="' + i18nLocale.column_background_image + '"></span>').insertBefore($column_toggle), color && jQuery('<span class="vc_column_color" style="background-color: ' + color + '" title="' + i18nLocale.column_background_color + '"></span>').insertBefore($column_toggle)
		},
		setColumnClasses: function() {
			var current_css_class_width, offset = this.model.getParam("offset") || "",
				width = this.model.getParam("width") || "1/1",
				css_class_width = this.convertSize(width);
			this.current_offset_class && this.$el.removeClass(this.current_offset_class), this.current_column_width !== width && (current_css_class_width = this.convertSize(this.current_column_width), this.$el.attr("data-width", width).removeClass(current_css_class_width).addClass(css_class_width), this.current_column_width = width), offset.match(/vc_col\-sm\-\d+/) && this.$el.removeClass(css_class_width), _.isEmpty(offset) || this.$el.addClass(offset), this.current_offset_class = offset
		},
		addToEmpty: function(e) {
			return false;
		},
		addElement: function(e) {
			return false;
		},
		setDropable: function() {
			return this.$content.droppable({
				greedy: !0,
				accept: "vc_column_inner" === this.model.get("shortcode") ? ".dropable_el" : ".dropable_el,.dropable_row",
				hoverClass: "wpb_ui-state-active",
				drop: this.dropButton
			}), this
		},
		dropButton: function(event, ui) {
			ui.draggable.is("#wpb-add-new-element") ? new vc.element_block_view({
				model: {
					position_to_add: "end"
				}
			}).show(this) : ui.draggable.is("#wpb-add-new-row") && this.createRow()
		},
		setEmpty: function() {
			this.$el.addClass("vc_empty-column"), "edit" !== vc_user_access().getState("shortcodes") && this.$content.addClass("vc_empty-container")
		},
		unsetEmpty: function() {
			this.$el.removeClass("vc_empty-column"), this.$content.removeClass("vc_empty-container")
		},
		checkIsEmpty: function() {
			vc.shortcodes.where({
				parent_id: this.model.id
			}).length ? this.unsetEmpty() : this.setEmpty(), window.VcArgentaSplitBoxColumnView.__super__.checkIsEmpty.call(this)
		},
		createRow: function() {
			var row_params, column_params, row;
			return row_params = {}, "undefined" != typeof window.vc_settings_presets.vc_row_inner && (row_params = _.extend(row_params, window.vc_settings_presets.vc_row_inner)), column_params = {
				width: "1/1"
			}, "undefined" != typeof window.vc_settings_presets.vc_column_inner && (column_params = _.extend(column_params, window.vc_settings_presets.vc_column_inner)), row = Shortcodes.create({
				shortcode: "vc_row_inner",
				params: row_params,
				parent_id: this.model.id
			}), vc.shortcodes.create({
				shortcode: "vc_column_inner",
				params: column_params,
				parent_id: row.id
			}), row
		},
		convertSize: function(width) {
			var prefix = "vc_col-sm-",
				numbers = width ? width.split("/") : [1, 1],
				range = _.range(1, 13),
				num = !_.isUndefined(numbers[0]) && 0 <= _.indexOf(range, parseInt(numbers[0], 10)) ? parseInt(numbers[0], 10) : !1,
				dev = !_.isUndefined(numbers[1]) && 0 <= _.indexOf(range, parseInt(numbers[1], 10)) ? parseInt(numbers[1], 10) : !1;
			return !1 !== num && !1 !== dev ? prefix + 12 * num / dev : prefix + "12"
		},
		deleteShortcode: function(e) {
			var parent, parent_id = this.model.get("parent_id");
			_.isObject(e) && e.preventDefault();
			var answer = confirm(window.i18nLocale.press_ok_to_delete_section);
			return !0 !== answer ? !1 : (this.model.destroy(), void(parent_id && !vc.shortcodes.where({
				parent_id: parent_id
			}).length ? (parent = vc.shortcodes.get(parent_id), _.contains(["vc_column", "vc_column_inner"], parent.get("shortcode")) || parent.destroy()) : parent_id && (parent = vc.shortcodes.get(parent_id), parent && parent.view && parent.view.setActiveLayoutButton && parent.view.setActiveLayoutButton())))
		},
		remove: function() {
			this.$content && this.$content.data("uiSortable") && this.$content.sortable("destroy"), this.$content && this.$content.data("uiDroppable") && this.$content.droppable("destroy"), delete vc.app.views[this.model.id], window.VcColumnView.__super__.remove.call(this)
		}
	});


	/* Split Box Inner */
	window.VcArgentaSplitBoxColumnInnerView = vc.shortcode_view.extend({
		events: {
			'click > .vc_controls [data-vc-control="add"]': "addElement",
			"click > .wpb_element_wrapper > .vc_empty-container": "addToEmpty"
		},
		current_column_width: !1,
		initialize: function(options) {
			window.VcArgentaSplitBoxColumnInnerView.__super__.initialize.call(this, options), _.bindAll(this, "setDropable", "dropButton")
		},
		ready: function(e) {
			return window.VcArgentaSplitBoxColumnInnerView.__super__.ready.call(this, e), this.setDropable(), this
		},
		render: function() {
			return window.VcArgentaSplitBoxColumnInnerView.__super__.render.call(this), this.current_column_width = this.model.get("params").width || "1/1", this.$el.attr("data-width", this.current_column_width), this.setEmpty(), this
		},
		changeShortcodeParams: function(model) {
			window.VcArgentaSplitBoxColumnInnerView.__super__.changeShortcodeParams.call(this, model), this.setColumnClasses(), this.buildDesignHelpers()
		},
		designHelpersSelector: "> .vc_controls .column_add",
		buildDesignHelpers: function() {
			var matches, image, color, css = this.model.getParam("css"),
				$column_toggle = this.$el.find(this.designHelpersSelector).get(0);
			this.$el.find("> .vc_controls .vc_column_color").remove(), this.$el.find("> .vc_controls .vc_column_image").remove(), matches = css.match(/background\-image:\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (image = matches[1]), matches = css.match(/background\-color:\s*([^\s\;]+)\b/), matches && !_.isUndefined(matches[1]) && (color = matches[1]), matches = css.match(/background:\s*([^\s]+)\b\s*url\(([^\)]+)\)/), matches && !_.isUndefined(matches[1]) && (color = matches[1], image = matches[2]), image && jQuery('<span class="vc_column_image" style="background-image: url(' + image + ');" title="' + i18nLocale.column_background_image + '"></span>').insertBefore($column_toggle), color && jQuery('<span class="vc_column_color" style="background-color: ' + color + '" title="' + i18nLocale.column_background_color + '"></span>').insertBefore($column_toggle)
		},
		setColumnClasses: function() {
			var current_css_class_width, offset = this.model.getParam("offset") || "",
				width = this.model.getParam("width") || "1/1",
				css_class_width = this.convertSize(width);
			this.current_offset_class && this.$el.removeClass(this.current_offset_class), this.current_column_width !== width && (current_css_class_width = this.convertSize(this.current_column_width), this.$el.attr("data-width", width).removeClass(current_css_class_width).addClass(css_class_width), this.current_column_width = width), offset.match(/vc_col\-sm\-\d+/) && this.$el.removeClass(css_class_width), _.isEmpty(offset) || this.$el.addClass(offset), this.current_offset_class = offset
		},
		addToEmpty: function(e) {
			e.preventDefault(), jQuery(e.target).hasClass("vc_empty-container") && this.addElement(e)
		},
		setDropable: function() {
			return this.$content.droppable({
				greedy: !0,
				accept: "vc_column_inner" === this.model.get("shortcode") ? ".dropable_el" : ".dropable_el,.dropable_row",
				hoverClass: "wpb_ui-state-active",
				drop: this.dropButton
			}), this
		},
		dropButton: function(event, ui) {
			ui.draggable.is("#wpb-add-new-element") ? new vc.element_block_view({
				model: {
					position_to_add: "end"
				}
			}).show(this) : ui.draggable.is("#wpb-add-new-row") && this.createRow()
		},
		setEmpty: function() {
			this.$el.addClass("vc_empty-column"), "edit" !== vc_user_access().getState("shortcodes") && this.$content.addClass("vc_empty-container")
		},
		unsetEmpty: function() {
			this.$el.removeClass("vc_empty-column"), this.$content.removeClass("vc_empty-container")
		},
		checkIsEmpty: function() {
			vc.shortcodes.where({
				parent_id: this.model.id
			}).length ? this.unsetEmpty() : this.setEmpty(), window.VcArgentaSplitBoxColumnInnerView.__super__.checkIsEmpty.call(this)
		},
		createRow: function() {
			var row_params, column_params, row;
			return row_params = {}, "undefined" != typeof window.vc_settings_presets.vc_row_inner && (row_params = _.extend(row_params, window.vc_settings_presets.vc_row_inner)), column_params = {
				width: "1/1"
			}, "undefined" != typeof window.vc_settings_presets.vc_column_inner && (column_params = _.extend(column_params, window.vc_settings_presets.vc_column_inner)), row = Shortcodes.create({
				shortcode: "vc_row_inner",
				params: row_params,
				parent_id: this.model.id
			}), vc.shortcodes.create({
				shortcode: "vc_column_inner",
				params: column_params,
				parent_id: row.id
			}), row
		},
		convertSize: function(width) {
			var prefix = "vc_col-sm-",
				numbers = width ? width.split("/") : [1, 1],
				range = _.range(1, 13),
				num = !_.isUndefined(numbers[0]) && 0 <= _.indexOf(range, parseInt(numbers[0], 10)) ? parseInt(numbers[0], 10) : !1,
				dev = !_.isUndefined(numbers[1]) && 0 <= _.indexOf(range, parseInt(numbers[1], 10)) ? parseInt(numbers[1], 10) : !1;
			return !1 !== num && !1 !== dev ? prefix + 12 * num / dev : prefix + "12"
		},
		deleteShortcode: function(e) {
			return false;
			/*var parent, parent_id = this.model.get("parent_id");
			_.isObject(e) && e.preventDefault();
			var answer = confirm(window.i18nLocale.press_ok_to_delete_section);
			return !0 !== answer ? !1 : (this.model.destroy(), void(parent_id && !vc.shortcodes.where({
				parent_id: parent_id
			}).length ? (parent = vc.shortcodes.get(parent_id), _.contains(["vc_column", "vc_column_inner"], parent.get("shortcode")) || parent.destroy()) : parent_id && (parent = vc.shortcodes.get(parent_id), parent && parent.view && parent.view.setActiveLayoutButton && parent.view.setActiveLayoutButton())))
		*/},
		remove: function() {
			return false;
			/*this.$content && this.$content.data("uiSortable") && this.$content.sortable("destroy"), this.$content && this.$content.data("uiDroppable") && this.$content.droppable("destroy"), delete vc.app.views[this.model.id], window.VcColumnView.__super__.remove.call(this)
		*/}
	});


	if (window.VcBackendTtaViewInterface) {
		/* Custom VC Accordion */
		window.VcArgentaBackendTtaAccordionView = VcBackendTtaViewInterface.extend({
			sortableSelector: "> .vc_tta-panel:not(.vc_tta-section-append)",
			sortableSelectorCancel: ".vc-non-draggable",
			sortableUpdateModelIdSelector: "data-model-id",
			defaultSectionTitle: window.i18nLocale.section,
			render: function() {
				return window.VcBackendTtaTabsView.__super__.render.call(this), this.$navigation = this.$content, this.$sortable = this.$content, vc_user_access().shortcodeAll("vc_tta_section") || this.$content.find(".vc_tta-section-append").hide(), this
			},
			removeSection: function(model) {
				var $viewTab, $nextTab, tabIsActive;
				$viewTab = this.findSection(model.get("id")), tabIsActive = $viewTab.hasClass(this.activeClass), tabIsActive && ($nextTab = this.getNextTab($viewTab), $nextTab.addClass(this.activeClass))
			},
			addSection: function(prepend) {
				var newTabTitle, params, shortcode;
				return newTabTitle = this.defaultSectionTitle, params = {
					shortcode: "argenta_sc_accordion_inner",
					params: {
						title: newTabTitle
					},
					parent_id: this.model.get("id"),
					order: _.isBoolean(prepend) && prepend ? vc.add_element_block_view.getFirstPositionIndex() : vc.shortcodes.getNextOrder(),
					prepend: prepend
				}, shortcode = vc.shortcodes.create(params)
			},
			addShortcode: function(view) {
				var beforeShortcode;
				beforeShortcode = _.last(vc.shortcodes.filter(function(shortcode) {
					return shortcode.get("parent_id") === this.get("parent_id") && parseFloat(shortcode.get("order")) < parseFloat(this.get("order"))
				}, view.model)), beforeShortcode ? view.render().$el.insertAfter("[data-model-id=" + beforeShortcode.id + "]") : this.$content.prepend(view.render().el)
			}
		});


		/* Custom VC Tabs */
		window.VcArgentaBackendTtaTabsView = window.VcBackendTtaViewInterface.extend({
			sortableSelector: "> [data-vc-tab]",
			sortableSelectorCancel: ".vc-non-draggable-container",
			sortablePlaceholderClass: "vc_placeholder-tta-tab",
			navigationSectionTemplate: null,
			navigationSectionTemplateParsed: null,
			$navigationSectionAdd: null,
			sortingPlaceholder: "vc_placeholder-tab vc_tta-tab",
			render: function() {
				return window.VcArgentaBackendTtaTabsView.__super__.render.call(this), this.$navigation = this.$el.find("> .wpb_element_wrapper .vc_tta-tabs-list"), this.$sortable = this.$navigation, this.$navigationSectionAdd = this.$navigation.children(".vc_tta-tab:first-child"), this.setNavigationSectionTemplate(this.$navigationSectionAdd.prop("outerHTML")), vc_user_access().shortcodeAll("vc_tta_section") ? this.$navigationSectionAdd.addClass("vc_tta-section-append").removeAttr("data-vc-target-model-id").removeAttr("data-vc-tab").find("[data-vc-target]").html('<i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>').removeAttr("data-vc-tabs").removeAttr("data-vc-target").removeAttr("data-vc-target-model-id").removeAttr("data-vc-toggle") : this.$navigationSectionAdd.hide(), this
			},
			setNavigationSectionTemplate: function(html) {
				this.navigationSectionTemplate = html, this.navigationSectionTemplateParsed = vc.template(this.navigationSectionTemplate, vc.templateOptions.custom)
			},
			getNavigationSectionTemplate: function() {
				return this.navigationSectionTemplate
			},
			getParsedNavigationSectionTemplate: function(data) {
				return this.navigationSectionTemplateParsed(data)
			},
			changeNavigationSectionTitle: function(modelId, title) {
				this.findNavigationTab(modelId).find("[data-vc-target]").text(title)
			},
			changeActiveSection: function(modelId) {
				window.VcArgentaBackendTtaTabsView.__super__.changeActiveSection.call(this, modelId), this.$navigation.children("." + this.activeClass).removeClass(this.activeClass), this.findNavigationTab(modelId).addClass(this.activeClass)
			},
			notifySectionRendered: function(model) {
				var $element, title, $insertAfter, clonedFrom;
				window.VcArgentaBackendTtaTabsView.__super__.notifySectionRendered.call(this, model), title = model.getParam("title"), $element = jQuery(this.getParsedNavigationSectionTemplate({
					model_id: model.get("id"),
					section_title: _.isString(title) && 0 < title.length ? title : this.defaultSectionTitle
				})), model.get("cloned") ? (clonedFrom = model.get("cloned_from"), _.isObject(clonedFrom) && ($insertAfter = this.$navigation.children('[data-vc-target-model-id="' + clonedFrom.id + '"]'), $insertAfter.length ? $element.insertAfter($insertAfter) : $element.insertBefore(this.$navigation.children(".vc_tta-section-append")))) : model.get("prepend") ? $element.insertBefore(this.$navigation.children(":first-child")) : $element.insertBefore(this.$navigation.children(":last-child"))
			},
			notifySectionChanged: function(model) {
				var title;
				window.VcArgentaBackendTtaTabsView.__super__.notifySectionChanged.call(this, model), title = model.getParam("title"), _.isString(title) && title.length || (title = this.defaultSectionTitle), this.changeNavigationSectionTitle(model.get("id"), title), model.view.$el.find("> .wpb_element_wrapper > .vc_tta-panel-body > .vc_controls .vc_element-name").removeClass("vc_element-move")
			},
			makeFirstSectionActive: function() {
				var $tab;
				$tab = this.$navigation.children(":first-child:not(.vc_tta-section-append)").addClass(this.activeClass), $tab.length && this.findSection($tab.data("vc-target-model-id")).addClass(this.activeClass)
			},
			findNavigationTab: function(modelId) {
				return this.$navigation.children('[data-vc-target-model-id="' + modelId + '"]')
			},
			addSection: function(prepend) {
				var newTabTitle, params, shortcode;
				return newTabTitle = this.defaultSectionTitle, params = {
					shortcode: "argenta_sc_tabs_inner",
					params: {
						title: newTabTitle
					},
					parent_id: this.model.get("id"),
					order: _.isBoolean(prepend) && prepend ? vc.add_element_block_view.getFirstPositionIndex() : vc.shortcodes.getNextOrder(),
					prepend: prepend
				}, shortcode = vc.shortcodes.create(params)
			},
			removeSection: function(model) {
				var $viewTab, $nextTab, tabIsActive;
				$viewTab = this.findNavigationTab(model.get("id")), tabIsActive = $viewTab.hasClass(this.activeClass), tabIsActive && ($nextTab = this.getNextTab($viewTab), $nextTab.addClass(this.activeClass), this.changeActiveSection($nextTab.data("vc-target-model-id"))), $viewTab.remove()
			},
			renderSortingPlaceholder: function(event, currentItem) {
				var helper, currentItemWidth, currentItemHeight;
				return helper = currentItem, currentItemWidth = currentItem.width() + 1, currentItemHeight = currentItem.height(), helper.width(currentItemWidth), helper.height(currentItemHeight), helper
			}
		});

		/* Slider Inner */
		window.VcArgentaBackendTtaSliderView = window.VcBackendTtaViewInterface.extend({
			sortableSelector: "> [data-vc-tab]",
			sortableSelectorCancel: ".vc-non-draggable-container",
			sortablePlaceholderClass: "vc_placeholder-tta-tab",
			navigationSectionTemplate: null,
			navigationSectionTemplateParsed: null,
			$navigationSectionAdd: null,
			sortingPlaceholder: "vc_placeholder-tab vc_tta-tab",
			defaultSectionTitle: "Section",
			render: function() {
				return window.VcArgentaBackendTtaSliderView.__super__.render.call(this), this.$navigation = this.$el.find("> .wpb_element_wrapper .vc_tta-tabs-list"), this.$sortable = this.$navigation, this.$navigationSectionAdd = this.$navigation.children(".vc_tta-tab:first-child"), this.setNavigationSectionTemplate(this.$navigationSectionAdd.prop("outerHTML")), vc_user_access().shortcodeAll("vc_tta_section") ? this.$navigationSectionAdd.addClass("vc_tta-section-append").removeAttr("data-vc-target-model-id").removeAttr("data-vc-tab").find("[data-vc-target]").html('<i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>').removeAttr("data-vc-tabs").removeAttr("data-vc-target").removeAttr("data-vc-target-model-id").removeAttr("data-vc-toggle") : this.$navigationSectionAdd.hide(), this
			},
			setNavigationSectionTemplate: function(html) {
				this.navigationSectionTemplate = html, this.navigationSectionTemplateParsed = vc.template(this.navigationSectionTemplate, vc.templateOptions.custom)
			},
			getNavigationSectionTemplate: function() {
				return this.navigationSectionTemplate
			},
			getParsedNavigationSectionTemplate: function(data) {
				return this.navigationSectionTemplateParsed(data)
			},
			changeNavigationSectionTitle: function(modelId, title) {
				this.findNavigationTab(modelId).find("[data-vc-target]").text(title)
			},
			changeActiveSection: function(modelId) {
				window.VcArgentaBackendTtaSliderView.__super__.changeActiveSection.call(this, modelId), this.$navigation.children("." + this.activeClass).removeClass(this.activeClass), this.findNavigationTab(modelId).addClass(this.activeClass)
			},
			notifySectionRendered: function(model) {
				var $element, title, $insertAfter, clonedFrom;
				window.VcArgentaBackendTtaSliderView.__super__.notifySectionRendered.call(this, model), title = model.getParam("title"), $element = jQuery(this.getParsedNavigationSectionTemplate({
					model_id: model.get("id"),
					section_title: _.isString(title) && 0 < title.length ? title : this.defaultSectionTitle
				})), model.get("cloned") ? (clonedFrom = model.get("cloned_from"), _.isObject(clonedFrom) && ($insertAfter = this.$navigation.children('[data-vc-target-model-id="' + clonedFrom.id + '"]'), $insertAfter.length ? $element.insertAfter($insertAfter) : $element.insertBefore(this.$navigation.children(".vc_tta-section-append")))) : model.get("prepend") ? $element.insertBefore(this.$navigation.children(":first-child")) : $element.insertBefore(this.$navigation.children(":last-child"))
			},
			notifySectionChanged: function(model) {
				var title;
				window.VcArgentaBackendTtaSliderView.__super__.notifySectionChanged.call(this, model), title = model.getParam("title"), _.isString(title) && title.length || (title = this.defaultSectionTitle), this.changeNavigationSectionTitle(model.get("id"), title), model.view.$el.find("> .wpb_element_wrapper > .vc_tta-panel-body > .vc_controls .vc_element-name").removeClass("vc_element-move")
			},
			makeFirstSectionActive: function() {
				var $tab;
				$tab = this.$navigation.children(":first-child:not(.vc_tta-section-append)").addClass(this.activeClass), $tab.length && this.findSection($tab.data("vc-target-model-id")).addClass(this.activeClass)
			},
			findNavigationTab: function(modelId) {
				return this.$navigation.children('[data-vc-target-model-id="' + modelId + '"]')
			},
			addSection: function(prepend) {
				var newTabTitle, params, shortcode;
				return newTabTitle = this.defaultSectionTitle, params = {
					shortcode: "argenta_sc_slider_inner",
					params: {
						title: newTabTitle
					},
					parent_id: this.model.get("id"),
					order: _.isBoolean(prepend) && prepend ? vc.add_element_block_view.getFirstPositionIndex() : vc.shortcodes.getNextOrder(),
					prepend: prepend
				}, shortcode = vc.shortcodes.create(params)
			},
			removeSection: function(model) {
				var $viewTab, $nextTab, tabIsActive;
				$viewTab = this.findNavigationTab(model.get("id")), tabIsActive = $viewTab.hasClass(this.activeClass), tabIsActive && ($nextTab = this.getNextTab($viewTab), $nextTab.addClass(this.activeClass), this.changeActiveSection($nextTab.data("vc-target-model-id"))), $viewTab.remove()
			},
			renderSortingPlaceholder: function(event, currentItem) {
				var helper, currentItemWidth, currentItemHeight;
				return helper = currentItem, currentItemWidth = currentItem.width() + 1, currentItemHeight = currentItem.height(), helper.width(currentItemWidth), helper.height(currentItemHeight), helper
			}
		});
	} else {
		// todo: fix custom view in frontend editor
	}
}


});