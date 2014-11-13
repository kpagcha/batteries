/* Initial values and actions */

$('#home').addClass('active');

/* --------------------------------------------------------------------------------------------------------------------/*

/* Batteries management */

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

var curPage = null;
$(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    if ( $(this).attr('href') != '#' ) {
        $("html, body").animate({ scrollTop: 0 }, "fast");
        curPage = $(this).attr('href');
        renderBatteries(curPage);
    }
});

/* --------------------------------------------------------------------------------------------------------------------/*

/* "Assign to view" or "respond to click" functions */

/* Click on menu: manage batteries */
$(document).on('click', '#manage-batteries', function (event) {
    event.preventDefault();
    $('#home').removeClass('active');
    $('#manage-batteries').addClass('active');
    renderBatteries();
});

/* Create new battery */
$(document).on('click', '#create-battery', function(event) {
	event.preventDefault();
	$.post('/battery', $('#create-battery-form').serialize(), function(data) {
		if (data['status'] == true) {
			$('#errors').addClass('hidden');
			$('#success').removeClass('hidden');
			$('#success').html(data['message']);
			$('#add-new-battery').modal('hide');
			//renderBatteries();
		} else {
			$('#success').addClass('hidden');
			$('#errors').removeClass('hidden');
			$('#errors').html(data['errors']);
			$('#errors').addClass('top-buffer');
		}
	});
});