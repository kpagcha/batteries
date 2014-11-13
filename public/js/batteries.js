/* Initial values and actions */

$('#home').addClass('active');

/* --------------------------------------------------------------------------------------------------------------------/*

/* Batteries management */

var notice;

function renderBatteries(url, notice) {
	if (url === undefined || url === null) url = '/battery/all';
	$.get(url, function(data) {
			$('#content').empty();
			$('#content').append(data['view']);
			if (data['empty']) {
				$('#batteries-list').empty();
				$('#content').append('<div class="alert alert-info top-buffer col-md-6 col-md-offset-3 text-center">No batteries found in the database.</div>');
			}
			if (notice) {
				$('#success').html(notice);
				notice = null;
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
			notice = data['message'];
			$('#success').html(notice);
			$('#add-new-battery').modal('hide');
		} else {
			$('#success').addClass('hidden');
			$('#errors').removeClass('hidden');
			$('#errors').html(data['errors']);
			$('#errors').addClass('top-buffer');
		}
	});
});

/* Reload batteries after closing modal */
$(document).on('hidden.bs.modal', '#add-new-battery', function(e) {
	renderBatteries(null, notice);
});

/* Edit battery */
$(document).on('click', '.glyphicon-pencil', function(event) {
	var row = $(this).closest('tr');
	var id = row.find("input[name='edit-id']").val();
	$.get('/battery/' + id + '/edit', function(data) {
		var edit = row.html(data['view']).find('div#edit-form-container');
		edit.hide().slideDown('400');
	});
});

/* Update battery */
$(document).on('click', '.glyphicon-floppy-disk', function(event) {
	var id = $(this).closest('tr').find("input[name='update-id']").val();
	$.ajax({
		url: '/battery/' + id,
		type: 'put',
		data: $('#edit-battery-form').serialize(),
		context: this
	})
	.done(function(data) {
		if (data['status']) {
			$(this).closest('tr').find('div#edit-form-container').slideUp('400').delay('400', function() {
				notice = data['message'];
				renderBatteries(curPage);
			});
		} else {
			$('#edit-errors').find('ul').html(data['errors']);
			$('#edit-errors').modal();
		}
	});
});

/* Cancel edit battery */
$(document).on('click', '.glyphicon-ban-circle', function(event) {
	$(this).closest('tr').find('div#edit-form-container').slideUp('400').delay('400', function() {
		renderBatteries(curPage);
	});
});