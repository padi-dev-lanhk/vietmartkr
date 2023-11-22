(()=>{"use strict";var e={n:t=>{var n=t&&t.__esModule?()=>t.default:()=>t;return e.d(n,{a:n}),n},d:(t,n)=>{for(var a in n)e.o(n,a)&&!e.o(t,a)&&Object.defineProperty(t,a,{enumerable:!0,get:n[a]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r:e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}},t={};e.r(t);const n=window.jQuery;var a=e.n(n);function o(e){var t=a()(e).next().is(".hasDatepicker")?"minDate":"maxDate",n="minDate"===t?a()(e).next():a()(e).prev(),o=a()(e).datepicker("getDate");a()(n).datepicker("option",t,o),a()(e).change()}function i(){return{language:{errorLoading:function(){return wc_enhanced_select_params.i18n_searching},inputTooLong:function(e){var t=e.input.length-e.maximum;return 1===t?wc_enhanced_select_params.i18n_input_too_long_1:wc_enhanced_select_params.i18n_input_too_long_n.replace("%qty%",t)},inputTooShort:function(e){var t=e.minimum-e.input.length;return 1===t?wc_enhanced_select_params.i18n_input_too_short_1:wc_enhanced_select_params.i18n_input_too_short_n.replace("%qty%",t)},loadingMore:function(){return wc_enhanced_select_params.i18n_load_more},maximumSelected:function(e){return 1===e.maximum?wc_enhanced_select_params.i18n_selection_too_long_1:wc_enhanced_select_params.i18n_selection_too_long_n.replace("%qty%",e.maximum)},noResults:function(){return wc_enhanced_select_params.i18n_no_matches},searching:function(){return wc_enhanced_select_params.i18n_searching}}}}window.window.serializeJSON,a()(document).on("wooccm-enhanced-between-dates",(function(e){a()(".wooccm-enhanced-between-dates").filter(":not(.enhanced)").each((function(){a()(this).find("input").datepicker({defaultDate:"",dateFormat:"yy-mm-dd",numberOfMonths:1,showButtonPanel:!0,onSelect:function(){o(a()(this))}}),a()(this).find("input").each((function(){o(a()(this))}))}))})),a()(document).on("wooccm-enhanced-options",(function(e){a()("table.wc_gateways tbody").sortable({items:"tr",cursor:"move",axis:"y",handle:"td.sort",scrollSensitivity:40,helper:function(e,t){return t.children().each((function(){a()(this).width(a()(this).width())})),t.css("left","0"),t},start:function(e,t){t.item.css("background-color","#f6f6f6")},stop:function(e,t){t.item.removeAttr("style"),t.item.trigger("updateMoveButtons")},update:function(e,t){a()(this).find("tr").each((function(e,t){var n=a()(t).find("input.check");n.length>0&&n.prop("disabled",0==e),a()(t).find("input.add-order").val(e).trigger("change")}))}}),a()(".wooccm-enhanced-options").each((function(){var e=a()(this),t=e.find(".add-option"),n=e.find(".remove-options");t.on("click",(function(t){var o=e.find("tbody > tr"),i=o.children("td").children(".label").toArray().reduce(((e,t)=>{let n=Number(a()(t).prop("name").match(/\d+/)[0]);return n>e?n:e}),0)+1,c=o.first().clone().html().replace(/options\[([0-9]+)\]/g,"options["+i+"]").replace('disabled="disabled"',"").replace('checked="checked"',"").replace('<input value="0"','<input value="'+i+'"').replace('<input value="0"','<input value="'+i+'"');o.last().after(a()("<tr>"+c+"</tr>")).find("input").trigger("change"),n.removeProp("disabled")})),n.on("click",(function(t){e.find("tbody > tr").length<2||e.find("tbody > tr").length<=e.find("tr > td.check-column input:checked").length?alert("You cant delete all options."):(e.find("tr > td.check-column input:checked").closest("tr").remove(),e.find("tbody > tr").first().find("input").trigger("change"))})),a()(document).ready((function(){a()("input[type=radio][name=default]").click((function(){if(1==a()(this).data("waschecked"))a()(this).prop("checked",!1),a()(this).data("waschecked",!1),a()(this).trigger("change");else{const e=a()(this);e.data("waschecked",!0),a()("input[type=radio][name=default]").each((function(){const t=a()(this);e.val()!==t.val()&&(t.prop("checked",!1),t.data("waschecked",!1))}))}}))}))}))})),a()(document).on("wooccm-enhanced-select",(function(e){a()(".wooccm-enhanced-select").filter(":not(.enhanced)").each((function(){var e=a().extend({minimumResultsForSearch:10,allowClear:!!a()(this).data("allow_clear"),placeholder:a()(this).data("placeholder")},i());a()(this).attr("name"),a()(this).selectWoo(e).addClass("enhanced")})),a()(".wooccm-product-search").filter(":not(.enhanced)").each((function(){var e={allowClear:!!a()(this).data("allow_clear"),placeholder:a()(this).data("placeholder"),minimumInputLength:a()(this).data("minimum_input_length")?a()(this).data("minimum_input_length"):"3",escapeMarkup:function(e){return e},ajax:{url:wc_enhanced_select_params.ajax_url,dataType:"json",delay:250,data:function(e){return{term:e.term,action:a()(this).data("action")||"wooccm_select_search_products",security:wc_enhanced_select_params.search_products_nonce,selected:a()(this).select2("val")||0,exclude:a()(this).data("exclude"),include:a()(this).data("include"),limit:a()(this).data("limit"),display_stock:a()(this).data("display_stock")}},processResults:function(e){var t=[];return e&&a().each(e,(function(e,n){t.push({id:e,text:n})})),{results:t}},cache:!0}};if(e=a().extend(e,i()),a()(this).attr("name"),a()(this).selectWoo(e).addClass("enhanced"),a()(this).data("sortable")){var t=a()(this),n=a()(this).next(".select2-container").find("ul.select2-selection__rendered");n.sortable({placeholder:"ui-state-highlight select2-selection__choice",forcePlaceholderSize:!0,items:"li:not(.select2-search__field)",tolerance:"pointer",stop:function(){a()(n.find(".select2-selection__choice").get().reverse()).each((function(){var e=a()(this).data("data").id,n=t.find('option[value="'+e+'"]')[0];t.prepend(n)}))}})}else a()(this).prop("multiple")&&a()(this).on("change",(function(){var e=a()(this).children();e.filter("option").sort((function(e,t){var n=e.text.toLowerCase(),a=t.text.toLowerCase();return n>a?1:n<a?-1:0})),a()(this).html(e)}))}))})),a()(".wooccm-enhanced-search").filter(":not(.enhanced)").each((function(){var e={allowClear:!!a()(this).data("allow_clear"),placeholder:a()(this).data("placeholder"),minimumInputLength:a()(this).data("minimum_input_length")||"3",escapeMarkup:function(e){return e},ajax:{url:wooccm_admin.ajax_url,dataType:"json",cache:!0,delay:250,data:function(e){return{term:e.term,key:a()(this).data("key"),action:"wooccm_search_field",nonce:wooccm_admin.nonce}},processResults:function(e,t){var n=[];return e&&a().each(e,(function(e,t){n.push({id:e,text:t})})),{results:n}}}};e=a().extend(e,i()),a()(this).select2(e).addClass("enhanced")})),window.wp.util,window.window.Backbone,window.window.uiDatepicker,function(e){var t,n=0,a=function(){e("#wooccm_modal").removeClass("processing")};_.mixin({sortOptions:function(e){return _.sortBy(e,(function(e){return e.order}))},escapeHtml:function(e){return e.replace("&amp;",/&/g).replace(/&gt;/g,">").replace(/&lt;/g,"<").replace(/&quot;/g,'"').replace(/&#039;/g,"'")},getFormData:function(e){let t=e.serializeJSON({checkboxUncheckedValue:"false",parseBooleans:!0,parseNulls:!0}),n=Object.assign({},wooccm_field.args);return Object.assign(n,t)}});var o=Backbone.Model.extend({defaults:Object.create(wooccm_field.args)}),i=Backbone.View.extend({initialize:function(t){var n=e(t.target).closest("[data-field_id]").data("field_id"),a=new o;a.set({id:n}),new c({model:a}).render()}}),c=Backbone.View.extend({events:{"change input":"enableSave","change textarea":"enableSave","change select":"enableSave","click .media-modal-backdrop":"close","click .media-modal-close":"close","click .media-modal-prev":"edit","click .media-modal-next":"edit","click .media-modal-tab":"tab","change .media-modal-parent":"parent","change .media-modal-render-tabs":"renderTabs","change #datepicker-enhance-bahaviour":"renderPanels","change #datepicker-date-limit":"renderPanels",'change .media-modal-render-panels input[type="text"]':"renderPanels","change .media-modal-render-info":"renderInfo","submit .media-modal-form":"submit"},templates:{},initialize:function(){_.bindAll(this,"open","tab","edit","load","render","close","submit","parent"),this.init(),this.open()},init:function(){this.templates.window=wp.template("wooccm-modal-main")},assign:function(e,t){e.setElement(this.$(t)).render()},updateModel:function(e){e&&e.preventDefault();var t=this.$el.find("#wooccm_modal").find("form"),n=_.getFormData(t);this.model.set(n)},reload:function(e){this.$el.find("#wooccm_modal").hasClass("reload")?location.reload():this.remove()},close:function(t){t.preventDefault(),this.undelegateEvents(),e(document).off("focusin"),e("body").removeClass("modal-open"),this.$el.find("#wooccm_modal").addClass("reload"),this.reload(t)},enableSave:function(t){e(".media-modal-submit").prop("disabled",!1),this.updateModel(t)},disableSave:function(t){e(".media-modal-submit").prop("disabled",!0)},tab:function(t){t.preventDefault();var n=this.$el.find("#wooccm_modal"),a=e(t.currentTarget),o=n.find("ul.wc-tabs"),i=a.find("a").attr("href").replace("#","");o.find(".active").removeClass("active"),a.addClass("active"),this.model.attributes.panel=i,this.model.changed.panel=i,this.renderPanels(t)},renderTabs:function(e){this.renderPanels(e),this.tabs.render()},renderPanels:function(e){this.updateModel(e),this.panels.render()},render:function(){var e=this;e.$el.html(e.templates.window(e.model.attributes)),this.tabs=new l({model:e.model}),this.panels=new d({model:e.model}),this.info=new s({model:e.model}),this.assign(this.tabs,"#wooccm-modal-tabs"),this.assign(this.panels,"#wooccm-modal-panels"),this.assign(this.info,"#wooccm-modal-info")},open:function(t){e("body").addClass("modal-open").append(this.$el),null!=this.model.attributes.id?this.load():_.delay((function(){a()}),100)},load:function(){var t=this;null!=t.model.attributes.id?e.ajax({url:wooccm_field.ajax_url,data:{action:"wooccm_load_field",nonce:wooccm_field.nonce,field_id:this.model.attributes.id},dataType:"json",type:"POST",complete:function(){a()},error:function(){alert("Error!")},success:function(e){console.log("response",e),e.success?(t.model.set(e.data),t.render()):alert(e.data)}}):t.render()},edit:function(a){a.preventDefault();var o=this,i=e(a.target),c=parseInt(e(".wc_gateways tr[data-field_id]").length),l=parseInt(o.model.get("order"));n++,t&&clearTimeout(t),t=setTimeout((function(){l=i.hasClass("media-modal-next")?Math.min(l+n,c):Math.max(l-n,1),o.model.set({id:parseInt(e(".wc_gateways tr[data-field_order="+l+"]").data("field_id"))}),n=0,o.load()}),300)},submit:function(t){t.preventDefault();var n=this,a=n.$el.find("#wooccm_modal"),o=a.find(".settings-save-status .spinner"),i=a.find(".settings-save-status .saved");return e.ajax({url:wooccm_field.ajax_url,data:{action:"wooccm_save_field",nonce:wooccm_field.nonce,field_data:JSON.stringify(n.model.attributes)},dataType:"json",type:"POST",beforeSend:function(){e(".media-modal-submit").prop("disabled",!0),o.addClass("is-active")},complete:function(){i.addClass("is-active"),o.removeClass("is-active"),_.delay((function(){i.removeClass("is-active")}),1e3)},error:function(e){alert("Error!")},success:function(e){e.success?null==n.model.attributes.id&&(a.addClass("reload"),n.reload(t),n.close(t)):alert(e.data)}}),!1},renderInfo:function(){this.info.render()},parent:function(t){t.preventDefault();var n=this,a=n.$el.find("#wooccm_modal").find(".attachment-details");return this.updateModel(t),e.ajax({url:wooccm_field.ajax_url,data:{action:"wooccm_load_parent",nonce:wooccm_field.nonce,conditional_parent_key:n.model.attributes.conditional_parent_key},dataType:"json",type:"POST",beforeSend:function(){n.disableSave(),a.addClass("save-waiting")},complete:function(){a.addClass("save-complete"),a.removeClass("save-waiting"),n.enableSave()},error:function(){alert("Error!")},success:function(e){e.success?(n.model.attributes.parent=e.data,n.model.changed.parent=e.data,n.renderInfo()):alert(e.data)}}),!1}}),l=Backbone.View.extend({templates:{},initialize:function(){this.templates.window=wp.template("wooccm-modal-tabs")},render:function(){this.model.attributes.panel="general",this.$el.html(this.templates.window(this.model.attributes))}}),d=Backbone.View.extend({templates:{},initialize:function(){this.templates.window=wp.template("wooccm-modal-panels")},render:function(){this.$el.html(this.templates.window(this.model.attributes)),this.$el.trigger("wooccm-enhanced-options"),this.$el.trigger("wooccm-enhanced-select"),this.$el.trigger("init_tooltips")}}),s=Backbone.View.extend({templates:{},initialize:function(){this.templates.window=wp.template("wooccm-modal-info")},render:function(){this.$el.html(this.templates.window(this.model.attributes)),this.$el.trigger("wooccm-enhanced-select"),this.$el.trigger("init_tooltips")}});e("#wooccm_billing_settings_add, #wooccm_shipping_settings_add, #wooccm_additional_settings_add").on("click",(function(e){e.preventDefault(),new i(e)})),e("#wooccm_billing_settings_reset, #wooccm_shipping_settings_reset, #wooccm_additional_settings_reset").on("click",(function(t){return t.preventDefault(),e(t.target),!!confirm(wooccm_field.message.reset)&&(e.ajax({url:wooccm_field.ajax_url,data:{action:"wooccm_reset_fields",nonce:wooccm_field.nonce},dataType:"json",type:"POST",beforeSend:function(){},complete:function(){},error:function(){alert("Error!")},success:function(e){e.success?location.reload():alert(e.data)}}),!1)})),e(".wooccm_billing_settings_edit, .wooccm_shipping_settings_edit, .wooccm_additional_settings_edit").on("click",(function(e){e.preventDefault(),new i(e)})),e(".wooccm_billing_settings_delete, .wooccm_shipping_settings_delete, .wooccm_additional_settings_delete").on("click",(function(t){t.preventDefault();var n=e(t.target).closest("[data-field_id]"),a=n.data("field_id");return!!confirm(wooccm_field.message.remove)&&(e.ajax({url:wooccm_field.ajax_url,data:{action:"wooccm_delete_field",nonce:wooccm_field.nonce,field_id:a},dataType:"json",type:"POST",beforeSend:function(){},complete:function(){},error:function(){alert("Error!")},success:function(e){e.success?n.remove():alert(e.data)}}),!1)})),e(document).on("click",".wooccm-field-toggle-attribute",(function(t){t.preventDefault();var n=e(this),a=n.closest("tr"),o=n.find(".woocommerce-input-toggle");return e.ajax({url:wooccm_field.ajax_url,data:{action:"wooccm_toggle_field_attribute",nonce:wooccm_field.nonce,field_attr:e(this).data("field_attr"),field_id:a.data("field_id")},dataType:"json",type:"POST",beforeSend:function(e){o.addClass("woocommerce-input-toggle--loading")},success:function(e){!0===e.data?(o.removeClass("woocommerce-input-toggle--enabled, woocommerce-input-toggle--disabled"),o.addClass("woocommerce-input-toggle--enabled"),o.removeClass("woocommerce-input-toggle--loading")):!0!==e.data&&(o.removeClass("woocommerce-input-toggle--enabled, woocommerce-input-toggle--disabled"),o.addClass("woocommerce-input-toggle--disabled"),o.removeClass("woocommerce-input-toggle--loading"))}}),!1})),e(document).on("change",".wooccm-field-change-attribute",(function(t){t.preventDefault();var n=e(this),a=n.closest("tr");return e.ajax({url:wooccm_field.ajax_url,data:{action:"wooccm_change_field_attribute",nonce:wooccm_field.nonce,field_attr:n.data("field_attr"),field_value:n.val(),field_id:a.data("field_id")},dataType:"json",type:"POST",beforeSend:function(e){n.prop("disabled",!0)},success:function(e){console.log(e.data)},complete:function(e){n.prop("disabled",!1)}}),!1}))}(jQuery),(window.tiktok=window.tiktok||{}).backend=t})();