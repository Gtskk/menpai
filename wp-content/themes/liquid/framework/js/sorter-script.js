jQuery(document).ready(function($) {
	
	$(".of-sorter .sorter-list").sortable({
        handle : ".sorter-handle",
        placeholder: "placeholder",
        stop : function(event, ui) {
            rename_field($(this).parents('.of-sorter'));
        }
    });
    $(".sorter-body").hide();
	
	// Sorter UI - add items
	$('.of-sorter .sorter-more').on('click', function() {
        var p = jQuery(this).closest('.of-sorter');
        var temp = $('.sorter-source', p).clone();
        html = temp.html();
        $(".sorter-list", p).append('<li class="list-item">' + html + '</li>');
        rename_field(p);
		$('p').iconPicker();
		return false;
    });
	
	//  Sorter UI - toggle & close
	$(".sorter-edit").live( 'click', function(){		
		$(this).parent().toggleClass("active").next().slideToggle("fast");
		return false;
	});	
	$(".sorter-close").live( 'click', function(){		
		$(this).closest('.sorter-body').removeClass("active").slideUp("fast");
		return false;
	});
	
	// Sorter UI - remove
    $('.of-sorter li .sorter-widget .sorter-delete').live('click', function() {
        var agree = confirm("Are you sure you wish to delete?");
        if(agree){
	        var g = $(this).parents('.of-sorter');
	        var p = $(this).parents('li');
	        p.remove(); rename_field(g);  return false;
	    }else{
	        return false;
	    }
    });

    // Sorter UI - title keyup
    $('.sorter-widget .sorter-title').live('keyup', function() {
        var p = $(this).closest('.sorter-widget');
        var t = $('.sorter-title', p).val();
        $('.sorter-handle strong', p).text(t);
    });
	
	// Sorter UI - rename fileds
	function rename_field(k) {
        var name_temp = $('.sorter-temp', k).val();
		$('li', k).each(function(i) {
            var li = $(this);
			$('.sorter-title', li).attr('name', name_temp + '[' + i + '][title]');
            $('.sorter-hook', li).attr('name', name_temp + '[' + i + '][hook]');
			$('.sorter-content', li).attr('name', name_temp + '[' + i + '][content]');
			$('.sorter-icon', li).attr('name', name_temp + '[' + i + '][icon]');
			$('.sorter-image', li).attr('name', name_temp + '[' + i + '][image]');
            $('.sorter-url', li).attr('name', name_temp + '[' + i + '][url]');
            $('.sorter-autop', li).attr('name', name_temp + '[' + i + '][autop]');
        });
    }
	
	// Upload WP 3.5
	var my_original_editor = window.send_to_editor;
	$('.sorter_media_upload_btn').live("click",function() {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var formfield = $(this).prev('input').attr('name');
		wp.media.editor.send.attachment = function(props, attachment) {
			$('[name="' + formfield + '"]' ).val(attachment.url);
			wp.media.editor.send.attachment = send_attachment_bkp;
		}
	
		wp.media.editor.open();
		window.send_to_editor = my_original_editor;
		return false;       
	});
});