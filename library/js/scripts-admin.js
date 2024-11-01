(function($) {
    $(document).ready(function() {
        $(document).on("click", ".vdgk-tab-label", function() {
            var parent_con = $(this).closest(".vdgk-tab-container");
            parent_con.find(".vdgk-tab-label").removeClass("vdgk-tab-label-selected");
            $(this).addClass("vdgk-tab-label-selected");
            parent_con.find(".vdgk-tab-content").removeClass("vdgk-tab-content-selected");
            parent_con.find("." + $(this).data("contentclass")).addClass("vdgk-tab-content-selected");
            window.vdgk_activetab = $(this).data("contentclass")
        });
        $(document).on("widget-updated",
            function() {
                if (window.vdgk_activetab) {
                    $(".vdgk-tab-label").removeClass("vdgk-tab-label-selected");
                    $(".vdgk-tab-content").removeClass("vdgk-tab-content-selected");
                    $(".vdgk-tab-label").each(function() {
                        if (window.vdgk_activetab == $(this).data("contentclass")) {
                            $(this).addClass("vdgk-tab-label-selected");
                            $("." + $(this).data("contentclass")).addClass("vdgk-tab-content-selected")
                        }
                    })
                }
            });
        $(document).on("click", ".vdgk-videotype-input", function() {
            if ($(this).closest(".vdgk-mce-dialog").length > 0) return;
            var parent_con =
                $(this).closest(".vdgk-tab-container");
            if ($(this).attr("checked") && $(this).attr("value") == "mp4") {
                parent_con.find(".vdgk-video-iframe-container").hide();
                parent_con.find(".vdgk-video-mp4-container").show()
            } else {
                parent_con.find(".vdgk-video-iframe-container").show();
                parent_con.find(".vdgk-video-mp4-container").hide()
            }
        });
        $(document).on("click", ".vdgk-select-file", function() {
            var parent_con = $(this).closest(".vdgk-tab-container");
            var text_field = parent_con.find("." + $(this).data("textfield"));
            var text_type =
                $(this).data("texttype");
            var media_uploader = wp.media({
                title: "Select an " + (text_type == "video" ? "Video" : "Image"),
                multiple: false,
                library: {
                    type: text_type
                },
                button: {
                    text: "Insert into widget"
                }
            });
            media_uploader.on("select", function() {
                var attachment = media_uploader.state().get("selection").first().toJSON();
                text_field.val(attachment.url)
            });
            media_uploader.open();
            return false
        });
        $(document).on("change", ".vdgk-select-playbutton-preloaded", function() {
            var parent_con = $(this).closest(".vdgk-tab-container");
            parent_con.find(".vdgk-playbutton-url").val($(this).val())
        })
    })
})(jQuery);
jQuery( document ).ready(function() {
		jQuery(".vdgk-switch-draggable").click(function(){
			
			if (jQuery("#vdgk_draggable_on").prop("checked") == true) {
			   jQuery(".vdgk_draggable_active").hide();
			}
			else{
			   jQuery(".vdgk_draggable_active").show();
			}
		});
		/* 
		jQuery(".vdgk-switch-Sticky_Video").click(function(){
			
			if (jQuery("#vdgk_Sticky_Video").prop("checked") == true) {
			   jQuery(this).closest('tr').nextAll('tr').show();
			   if (jQuery("#vdgk_draggable_on").prop("checked") == true) {
				   jQuery(".vdgk_draggable_active").hide();
				}
				else{
				   jQuery(".vdgk_draggable_active").show();
				}
			}
			else{
			   jQuery(this).closest('tr').nextAll('tr').hide()
			}
		}); */
	});