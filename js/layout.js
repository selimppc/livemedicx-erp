// JavaScript Document

$(document).ready(function(){
	window_height = $(window).height();
	top_header_height = $('#top-header').height();
	subheader_height = $('#sub-header').height();
	optimized_veiw_height = $('#optimized-veiw').height();
	secondary_navigation_holder = $('.secondary-navigation-holder').height();
	status_container_height = $('.status-container').height();
	footer_height = $('.footer').height();
	content_row_height = $('.viewport .content-row').height();
	
	privary_nav_height = window_height - top_header_height - subheader_height - status_container_height - footer_height; //for primary navigation
	
	viewport_height = window_height - top_header_height - subheader_height - status_container_height - footer_height - secondary_navigation_holder-30; //for form layout
	
	schedule_viewport_height = window_height - top_header_height - subheader_height - status_container_height - footer_height - secondary_navigation_holder; //for schedule layout
	
	//for form layout
	$('.content-grid .viewport').css('height', viewport_height+'px');
	$('.content-grid .viewport').perfectScrollbar();
	
	//for schedule layout
	$('.schedule-content-grid .viewport').css('height', schedule_viewport_height+'px');
	$('.schedule-content-grid .viewport').perfectScrollbar();
	
	
	//inner scroller
	$('.inner-scroller').perfectScrollbar();
	
	//primary nav scroller
	$('.primary-nav-scroller').css('height', privary_nav_height+'px');
	$('.primary-nav-scroller').perfectScrollbar();
	
	
	$(window).resize(function() {
		
		$('.inner-scroller').perfectScrollbar('update');
		
		window_height = $(window).height();
		top_header_height = $('#top-header').height();
		subheader_height = $('#sub-header').height();
		optimized_veiw_height = $('#optimized-veiw').height();
		secondary_navigation_holder = $('.secondary-navigation-holder').height();
		status_container_height = $('.status-container').height();
		footer_height = $('.footer').height();
		content_row_height = $('.viewport .content-row').height();
		
		privary_nav_height = window_height - top_header_height - subheader_height - status_container_height - footer_height; //for primary navigation
		
		viewport_height = window_height - top_header_height - subheader_height - status_container_height - footer_height - secondary_navigation_holder-30; //for form layout
	
		schedule_viewport_height = window_height - top_header_height - subheader_height - status_container_height - footer_height - secondary_navigation_holder; //for schedule layout
		
		//for form layout
		$('.content-grid .viewport').css('height', viewport_height+'px');
		$('.content-grid .viewport').perfectScrollbar('update');
		
		//for schedule layout
		$('.schedule-content-grid .viewport').css('height', schedule_viewport_height+'px');
		$('.schedule-content-grid .viewport').perfectScrollbar('update');
		
		//primary nav scroller
		$('.primary-nav-scroller').css('height', privary_nav_height+'px');
		$('.primary-nav-scroller').perfectScrollbar('update');

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
	
	
	
	//scheduling popups
	//generate variables and array for the table data index
	 var tabArray = []
	 var count = 0
	 
	 for(i=0;i<5;i++){
		  var left = 0
		  for(j=0;j<7;j++){
			   if(j==5){
				tabArray[count++] = 360
			   }
			   else if(j==6)
				tabArray[count++] = 480
			   else{
				tabArray[count++] = left
				left+=120
			   }
		  }
	 }
	 
	 //setting variables for header array
	 
	 var head_Array = []
	 var counter = 0
	 for(i=0;i<5;i++){
		
		for(j=0;j<7;j++){
			head_Array[counter++] = j
		} 
	 }
	 
	//console.log(head_Array)

		 
	$( ".table-data" ).each(function( index ) {
		$(this).click(function(){
			var date = $(this).find('div').eq(0).html();
			var bookmark = $(this).find('div').eq(1).html();
			
			$('.schedule-pop-list-container').show();
			$('.schedule-pop-list-container').css('left','0');
			$('.schedule-pop-list-container').css('left',tabArray[index]+'px');	

			//putting the value of associate
			$('.schedule-pop-date').html('');
			$('.pop-bookmark').html('');
			$('.schedule-pop-date').html(date);
			$('.pop-bookmark').html(bookmark);
			//console.log(index);	
			
			//console.log(head_Array[index]);
			$('.schedule-head').find('th').removeClass( "selected highlight" );
			$('.schedule-head').find('th').eq(head_Array[index]).addClass( "selected highlight" );

		});
		$('.pop-close-btn').click(function(){
			$('.schedule-head').find('th').eq(head_Array[index]).removeClass( "selected highlight" );
			$('.schedule-pop-list-container').css('left','0');	
			$('.schedule-pop-list-container').hide();	
		});
	});
	
	//scheduling popups ends
	
});