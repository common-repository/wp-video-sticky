(function() {
    tinymce.PluginManager.add('vdgk_mce_button', function(editor, url) {
        editor.addButton('vdgk_mce_button', {
            text: " Video",
            title: "Add Video",
            icon: true,
            image: url + "/image/video-icon.png",
			 onclick: function() {
                jQuery(".vdgk-mce-dialog").remove();
        var pluginbaseurl = "";
        var helpurl = "";
        var lightboxinstalled = false;
        
        var videotype = "iframe";
        var iframe = "";
        var iframe_vimeo = "";
        var mp4 = "";
        var vdgk_Height = "295";
        var vdgk_width = "525";
        var webm = "";
        var poster = "";
        var videowidth = 600;
        var videoheight = 400;
        var keepaspectratio = 1;
        var autoplay = 0;
        var loop = 0;
        var videocss = "position:relative;display:block;background-color:#000;overflow:hidden;max-width:100%;margin:0 auto;";
        var playbutton = pluginbaseurl + "engine/playvideo-64-64-0.png";
        var lightbox = 0;
        var lightboxsize = 1;
        var lightboxwidth = 960;
        var lightboxheight = 480;
        var lightboxtitle = "";
        var lightboxgroup = "";
        var lightboxshownavigation = 0;
        var autoopen = 0;
        var autoopendelay = 0;
        var autoclose = 0;
        var showimage = "";
        var lightboxoptions = "";
        var form = '<div class="vdgk-tab-container vdgk-mce-dialog" title="WP Video Sticky">';
        
        form += '<div class="vdgk-tab-help"><a href="' + helpurl + '" target="_blank">Help Document</a></div>';
        form += '<section class="vdgk-tab-content1 vdgk-tab-content vdgk-tab-content-selected" >';
        form += '<p class="vdgk-error-msg"></p>';
        form += '<p><label class="vdgk-tab-label-primary"><input type="radio" class="vdgk-videotype-input" name="vdgk-videotype" value="iframe" ' +
            (videotype == "iframe" ? "checked" : "") + " /> Enter YouTube Video URL:</label><span style='color: #c5c8ca;'> Ex: https://youtu.be/SXKlJuO07eM</span></p>";
        form += '<div class="vdgk-subtab-container vdgk-video-iframe-container" style="display:block;">';
        form += '<input class="vdgk-iframe-url widefat" type="text" name="vdgk-iframe" value="' + iframe + '" />'; 
        form += "</div>";
        form += '<p><label class="vdgk-tab-label-primary"><input type="radio" class="vdgk-videotype-input" name="vdgk-videotype" value="iframe_vimeo" ' +
            (videotype == "iframe_vimeo" ? "checked" : "") + " /> Enter Vimeo Video URL:</label><span style='color: #c5c8ca;'> Ex: https://vimeo.com/147088266 </span></p>";
        form += '<div class="vdgk-subtab-container vdgk-video-iframe-container" style="display:block;">';
        form += '<input class="vdgk-iframe-url-vimeo widefat" type="text" name="vdgk-vimeo" value="' + iframe_vimeo + '" />';
        form += "</div>";
        form += '<p><label class="vdgk-tab-label-primary"><input type="radio" class="vdgk-videotype-input" name="vdgk-videotype" value="mp4" ' + (videotype == "mp4" ? "checked" : "") + " /> MP4/WebM Video</label></p>";
        form += '<div class="vdgk-subtab-container vdgk-video-mp4-container" style="display:block;">';
        form += "<p>";
        form += "<label>MP4 Video URL:</label><br>";
        form += '<input type="text" class="vdgk-mp4-url vdgk-regular-text" name="vdgk-mp4" value="' + mp4 + '" />';
        form += '<input type="button" class="vdgk-select-file vdgk-select-mp4 button" data-textfield="vdgk-mp4-url" data-texttype="video" value="Select an MP4 file" />';
        form += "</p>";
       form += "<hr>"
       form += "<h2>Video Settings</h2>"
       form += "<p>"
        form += "<label>Video Height</label><br>";
        form += '<input type="text" class="vdgk-regular-text" name="vdgk-height" value="' + vdgk_Height + '" />';
       form += "</p>"
       form += "<p>"
        form += "<label>Video Width</label><br>";
        form += '<input type="text" class="vdgk-regular-text" name="vdgk-width" value="' + vdgk_width + '" />';
       form += "</p>"
        form += '<p class="vdgk-submit-container"><input type="button" class="vdgk-mce-submit button-primary" value="Insert Video" name="vdgk-submit" /></p>';
        form += "</div>";
        jQuery(form).appendTo("body").hide();
        jQuery(".vdgk-mce-dialog").dialog({
            dialogClass: "wp-dialog",
            autoOpen: true,
            height: "auto",
            width: 800,
            modal: true
			
        });
        if (jQuery(".vdgk-mce-dialog").dialog("instance") && jQuery(".vdgk-mce-dialog").dialog("instance").uiDialog)
          
        jQuery(".vdgk-mce-submit").click(function() {
            var content = "[vdgk_video_sticky";
            var videotype =
                jQuery('input[name="vdgk-videotype"]:checked').val();
            if (videotype == "iframe") {
                var iframe = jQuery.trim(jQuery('input[name="vdgk-iframe"]').val());
                if (iframe.length <= 0) {
                    jQuery(".vdgk-error-msg").text("Please enter a YouTube video URL").show();
                    return
                }
				content += ' videotype="youtube"';
                content += ' src="' + iframe + '"'
            }
			else if (videotype == "iframe_vimeo") {
                var iframe_vimeo = jQuery.trim(jQuery('input[name="vdgk-vimeo"]').val());
                if (iframe_vimeo.length <= 0) {
                    jQuery(".vdgk-error-msg").text("Please enter a Vimeo video URL").show();
                    return
                }
				var minNumber = 1; // le minimum
				var maxNumber = 999999; // le maximum
				var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); console.log(randomnumber);
				content += ' videotype="vimeo"';
                content += ' src="' + iframe_vimeo + '" class="vimeo_add_'+ randomnumber +'"'
            }
			else if (videotype == "mp4"){
                content += ' videotype="mp4"';
                var mp4 = jQuery.trim(jQuery('input[name="vdgk-mp4"]').val());
                if (mp4.length <= 0) {
                    jQuery(".vdgk-error-msg").text("Please enter an MP4 video URL").show();
                    return
                }
                content += ' src="' + mp4 + '"';
                var webm = jQuery.trim(jQuery('input[name="vdgk-webm"]').val());
                if (webm.length > 0) content += ' webm="' + webm + '"';
                var poster = jQuery.trim(jQuery('input[name="vdgk-poster"]').val());
                if (poster.length > 0) content += ' poster="' + poster + '"'
            }
			var vdgk_Height = jQuery.trim(jQuery('input[name="vdgk-height"]').val());
			var vdgk_width = jQuery.trim(jQuery('input[name="vdgk-width"]').val());
			content +=' height="'+vdgk_Height+'"  width="'+vdgk_width+'"';
            if (jQuery('input[name="vdgk-lightbox"]').is(":checked")) {
                content += " lightbox=1";
                if (jQuery('input[name="vdgk-lightboxsize"]').is(":checked")) content += " lightboxsize=1 lightboxwidth=" + jQuery('input[name="vdgk-lightboxwidth"]').val() + " lightboxheight=" + jQuery('input[name="vdgk-lightboxheight"]').val();
                if (jQuery('input[name="vdgk-autoopen"]').is(":checked")) content += " autoopen=1 autoopendelay=" +
                    jQuery('input[name="vdgk-autoopendelay"]').val();
                if (jQuery('input[name="vdgk-autoclose"]').is(":checked")) content += " autoclose=1";
                var lightboxtitle = jQuery.trim(jQuery('input[name="vdgk-lightboxtitle"]').val());
                if (lightboxtitle.length > 0) content += ' lightboxtitle="' + double_escape_html(lightboxtitle) + '"';
                var lightboxgroup = jQuery.trim(jQuery('input[name="vdgk-lightboxgroup"]').val());
                if (lightboxgroup.length > 0) content += ' lightboxgroup="' + lightboxgroup + '"';
                if (jQuery('input[name="vdgk-lightboxshownavigation"]').is(":checked")) content += " lightboxshownavigation=1";
                var showimage = jQuery.trim(jQuery('input[name="vdgk-showimage"]').val());
                if (showimage.length > 0) content += ' showimage="' + showimage + '"';
                var lightboxoptions = jQuery.trim(jQuery('textarea[name="vdgk-lightboxoptions"]').val());
                if (lightboxoptions.length > 0) content += ' lightboxoptions="' + double_escape_html(lightboxoptions) + '"'
            }
            if (jQuery('input[name="vdgk-keepaspectratio"]').is(":checked")) content += " keepaspectratio=1";
            if (jQuery('input[name="vdgk-autoplay"]').is(":checked")) content += " autoplay=1";
            if (jQuery('input[name="vdgk-loop"]').is(":checked")) content += " loop=1";
            var videocss = jQuery.trim(jQuery('input[name="vdgk-videocss"]').val()).replace(/"/g, '\\"');
            if (videocss.length > 0) content += ' videocss="' + videocss + '"';
            var playbutton = jQuery.trim(jQuery('input[name="vdgk-playbutton"]').val());
            if (playbutton.length > 0) content += ' playbutton="' + playbutton + '"';
            content += "]";
            editor.insertContent(content);
            jQuery(".vdgk-mce-dialog").dialog("close")
        })
    }
            });
        });
    })(); 

 function escape_html(s) {
        return s.replace(/"/g, '\\"').replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;")
    }

    function double_escape_html(s) {
        return escape_html(s).replace(/&/g, "&amp;")
    }

