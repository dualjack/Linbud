$(document).ready(function(){
	
	$('.slider').bjqs({
        // width and height need to be provided to enforce consistency
		// if responsive is set to true, these values act as maximum dimensions
		width : 920,
		height : 150,

		// animation values
		animtype : 'slide', // accepts 'fade' or 'slide'
		animduration : 450, // how fast the animation are
		animspeed : 4000, // the delay between each slide
		automatic : true, // automatic

		// control and marker configuration
		showcontrols : true, // show next and prev controls
		centercontrols : true, // center controls verically
		nexttext : '<img src="/elements/images/s_arrow_right.png">', // Text for 'next' button (can use HTML)
		prevtext : '<img src="/elements/images/s_arrow_left.png">', // Text for 'previous' button (can use HTML)
		showmarkers : true, // Show individual slide markers
		centermarkers : true, // Center markers horizontally

		// interaction values
		keyboardnav : false, // enable keyboard navigation
		hoverpause : true, // pause the slider on hover

		// presentational options
		usecaptions : true, // show captions for images using the image title tag
		randomstart : true, // start slider at random slide
		responsive : true // enable responsive capabilities (beta)
    });
    
    // --------------
    // NOTYFIKACJA
    // --------------
    
    $(".notify")
	.delay(200).fadeIn(500)
	.delay(4000).fadeOut(500);
	
});
