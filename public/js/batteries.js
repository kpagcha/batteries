/* Initial values and actions */

$('#home').addClass('active');


/* --------------------------------------------------------------------------------------------------------------------/*

/* "Working" functions */
function renderBatteries(url) {
	if (url === undefined || url === null) url = '/battery/all';
	$.get(url, function(data) {
			alert(data['empty'])
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
    renderBatteries();
});