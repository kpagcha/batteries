/* "Working" functions or those with bussiness logic */

function renderHomePage() {
	$.get('/home/main', function(data) {
		$('#content').empty();
		$('#content').append(data['view']);
	});
}

/* --------------------------------------------------------------------------------------------------------------------/*

/* "Assign to view" or "respond to click" functions */

/* Clear active links */
function clearActiveLinks() {
	$('#home, #manage-batteries, #login, #signup').removeClass('active');
}

/* Go to main page */
$(document).on('click', '#home, #home-brand', function (event) {
	event.preventDefault();
    clearActiveLinks();
    $('#home').addClass('active');
	renderHomePage();
});