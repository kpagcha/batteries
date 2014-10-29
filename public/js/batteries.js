/* Initial values and actions */

$('#home').addClass('active');


/* --------------------------------------------------------------------------------------------------------------------/*

/* "Working" functions or those with bussiness logic */

function renderBatteries(url) {
	if (url === undefined || url === null) url = '/battery/all';
	$.get(url, function(data) {
			$('#content').empty();
			if (data['empty'] == false) {
				$('#content').append(data['view']);
			} else {
				$('#content').append('<div class="alert alert-info">No batteries found in the database.</div>');
			}
		});
}

/* --------------------------------------------------------------------------------------------------------------------/*

/* "Assign to view" or "respond to click" functions */

$(document).on('click', '#manage-batteries', function (event) {
    event.preventDefault();
    $('#home').removeClass('active');
    $('#manage-batteries').addClass('active');
    renderBatteries();
});