/* "Working" functions or those with bussiness logic */

function renderHomePage() {
	$.get('/home/main', function(data) {
		$('#content').empty();
		$('#content').append(data['view']);
	});
}

/* --------------------------------------------------------------------------------------------------------------------/*

/* "Assign to view" or "respond to click" functions */

$(document).on('click', '#home, #home-brand', function (event) {
	event.preventDefault();
    $('#manage-batteries').removeClass('active');
    $('#home').addClass('active');
	renderHomePage();
});