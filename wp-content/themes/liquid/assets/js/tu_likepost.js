jQuery(document).ready(function($){

	$(document).on('click', '.tu-likepost',function() {
		var link = $(this);
		if(link.hasClass('active')) return false;
		
		var id = $(this).attr('id'),
			suffix = link.find('.tu-likepost-suffix').text();
		
		$.post(tu_likepost_ajax.ajaxurl, { action:'tu-likepost', recommend_id:id, suffix:suffix }, function(data){
			link.html(data).addClass('active').attr('title','You already liked this post');
		});
		
		return false;
	});
 
});