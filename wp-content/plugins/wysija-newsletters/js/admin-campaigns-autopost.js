var colorpicker=null;jQuery(function(e){function t(){e("#title_position_block")["title"===e('input[name="post_content"]:checked').val()?"hide":"show"](),e("#title_tag_list")["title"===e('input[name="post_content"]:checked').val()?"show":"hide"](),e("#advanced:visible").length>0&&(e("#title_tag_list:hidden").length>0&&"list"===e('input[name="title_tag"]:checked').val()&&e('input[name="title_tag"][value="h2"]').attr("checked","checked"),"list"===e('input[name="title_tag"]:checked').val()?i(["image","author","category","readmore","divider","bgcolor"]):a(["image","author","category","readmore","divider","bgcolor"]))}function i(t){e.each(t,function(t,i){e("#"+i+"-block").hide()})}function a(t){e.each(t,function(t,i){e("#"+i+"-block").show()})}function n(){e("#image_block")[e('input[name="title_tag"][value="list"]:checked').length>0?"hide":"show"]()}function o(t){e(".category_select").hide(),t===!0&&e(".category_ids").prop("selectedIndex",-1).trigger("chosen:updated");var i=e("#post_type").val();e('.category_select[data-post-type="'+i+'"]').length>0?(e('.category_select[data-post-type="'+i+'"]').show(),e("#categories_filters").show()):e("#categories_filters").hide()}function c(){var t=e('input[name="image_alignment"]:checked').val(),i=!0,a=32,n=325;"center"===t?n=564:"none"===t&&(i=!1),i===!0?(e("#image_width_block").show(),l(),slider.range=$R(a,n),slider.setValue(slider.value)):e("#image_width_block").hide()}function l(){var t=32,i=564,a=Math.min(Math.max(t,parseInt(e("#slider_info span").html())),i);slider=new Control.Slider("slider_handle","image_width_slider",{range:$R(t,i),slideValue:a,axis:"horizontal",onSlide:function(t){var i=parseInt(t,10);e("#slider_info").find("span").html(i),e("#image_width").val(i)},onChange:function(t){var i=parseInt(t,10);e("#slider_info").find("span").html(i),e("#image_width").val(i)}}),slider.setValue(a)}function r(){null===colorpicker&&(colorpicker=!0,e("input.color").modcoder_excolor({hue_bar:1,border_color:"#969696",anim_speed:"fast",round_corners:!1,shadow_size:2,shadow_color:"#f0f0f0",background_color:"#ececec",backlight:!1,label_color:"#333333",effect:"fade",show_input:!1,z_index:2e4,callback_on_open:function(){e("html, body").animate({scrollTop:e("#modcoder_colorpicker_wrapper:visible").offset().top},200)}}))}e("#toggle-advanced").toggle(function(){return e(this).html(wysijatrans.hide_advanced),e("#advanced").show(),l(),t(),c(),n(),r(),e(this).blur(),window.parent.WysijaPopup.setDimensions(),!1},function(){return e(this).html(wysijatrans.show_advanced),e("#advanced").hide(),e(this).blur(),window.parent.WysijaPopup.setDimensions(),!1}),e("#autopost-submit").click(function(){var t=[],i=["readmore","author_label","category_label"];return e("#autopost-form").serializeArray().each(function(e){i.include(e.name)&&(e.value=window.parent.Wysija.encodeHtmlValue(e.value)),t.push(e)}),wysijaAJAX.task="generate_auto_post",wysijaAJAX.wysijaData=t,jQuery.ajax({type:"POST",url:wysijaAJAX.ajaxurl,data:wysijaAJAX,success:function(e){void 0!==e.result&&""!==e.result?window.parent.WysijaPopup.success(e.result):window.parent.WysijaPopup.cancel()}}),!1}),e('input[name="image_alignment"]').click(function(){c()}),e('input[name="post_content"]').click(function(){t(),n(),c()}),e('input[name="title_tag"]').click(function(){t(),n(),c()}),e("#post_type").change(function(){return o(!0),!1}),e(function(){e(".category_ids").chosen({width:"400px"}),l(),t(),c(),n(),o()})});