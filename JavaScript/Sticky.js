// hiding and make visible scrollUp button
$(window).scroll(function()
{

    if($(this).scrollTop()>200) 
    
        $('.scrollUp_button').fadeIn();

    else

        $('.scrollUp_button').fadeOut();

});

// set up scroll button
jQuery(function($)
{
    // reset scroll level
    $.scrollTo(0);

    // go to the top
    $('.scrollUp_button').click(function() { $.scrollTo($('body'), 1500); });

});


// function for menu to be on top all the time (sticky)
$(document).ready(function() 
{
	// save the "top" of the current div with a class ".toBeSticky"
	var MenuY = $('.toBeSticky').offset().top;
	
	// function to set Menu
	var StickyMenu = function() 
	{
		// save the "top" of the current window
		var ScrollY = $(window).scrollTop();
		
		// check if menu bar is not on top
		if (ScrollY > MenuY)
		{
			// if not - make it on top by adding class Sticky
			$('.toBeSticky').addClass('Sticky');
		} else
		{
			// if is normally on top remove class and do nothing
			$('.toBeSticky').removeClass('Sticky');
		}
	};
	
	StickyMenu();
	
	// when scrolling call function StickyMenu
	$(window).scroll(function()
	{
		StickyMenu();
	});
});
