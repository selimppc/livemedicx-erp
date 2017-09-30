// JavaScript Document

$(document).ready(function(){
	//$('.viewport').css('height','300px');
	window_height = $(window).height();
	top_header_height = $('#top-header').height();
	subheader_height = $('#sub-header').height();
	optimized_veiw_height = $('#optimized-veiw').height();
	secondary_navigation_holder = $('.secondary-navigation-holder').height();
	status_container_height = $('.status-container').height();
	footer_height = $('.footer').height();
	content_row_height = $('.viewport .content-row').height();
	
	viewport_height = window_height - top_header_height - subheader_height - status_container_height - footer_height - secondary_navigation_holder - 100;
	
	$('.viewport').css('height', viewport_height+'px');
	$('.has-scroll-bar').tinyscrollbar();
	//$('.has-scroll-bar').tinyscrollbar({ axis: 'x'});
	
	
	$(window).resize(function() {
		
		window_height = $(window).height();
		top_header_height = $('#top-header').height();
		subheader_height = $('#sub-header').height();
		optimized_veiw_height = $('#optimized-veiw').height();
		secondary_navigation_holder = $('.secondary-navigation-holder').height();
		status_container_height = $('.status-container').height();
		footer_height = $('.footer').height();
		content_row_height = $('.viewport .content-row').height();
		
		viewport_height = window_height - top_header_height - subheader_height - status_container_height - footer_height - secondary_navigation_holder - 100;
		
		$('.viewport').css('height', viewport_height+'px');
		
		$('.has-scroll-bar').tinyscrollbar();
		

	});
	
	
	//input width corrections
	$( ".has-border-bottom" ).each(function( index ) {
		var self_width = $('.has-border-bottom').eq(index).width();
		//console.log(self_width);

		var label_width = $(this).find('div').eq(0).width();
		//console.log(label_width);
		
		var req_width = self_width - label_width -8;
		//console.log(req_width);

		$('.has-border-bottom').eq(index).find('div').eq(1).find('input').css('width', req_width + 'px');
		
		
	});	
	
	
});