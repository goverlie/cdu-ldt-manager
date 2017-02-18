$(document).ready(function () {
	var pathArray = window.location.pathname.split( '/' ); // Break URL into Array separated by /
	var secondLevelLocation = pathArray[1]; // Get the Controller
	if (secondLevelLocation === '') {secondLevelLocation = 'index';} // If no URL set to index
	$('.nav a[href$="' + secondLevelLocation + '"]').closest('li').addClass('active'); // Find li with href ends with controller as link
	

});
