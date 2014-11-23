/* "Working" functions or those with bussiness logic */

function renderHomePage() {
	$.get('/home/main', function(data) {
		$('#content').empty();
		$('#content').append(data['view']);
	});
}

/* Initialize Bootstrap tooltip opt-in */ 
$(function () {
  $('[data-toggle="tooltip"]').tooltip({
  	delay: { show: 700, hide: 100 }
  });
});

/* --------------------------------------------------------------------------------------------------------------------/*

/* "Assign to view" or "respond to click" functions */

/* Clear active links */
function clearActiveLinks() {
	$('#navbar-collapse li').removeClass('active');
}

/* Go to main page */
$(document).on('click', '#home, #home-brand', function (event) {
	event.preventDefault();
    clearActiveLinks();
    $('#home').addClass('active');
	renderHomePage();
});

/* Clear notice messages when navigating tabs */
$(document).on('click', 'li[role=presentation]', function(event) {
	event.preventDefault();
	$('#notice').addClass('hidden');
});