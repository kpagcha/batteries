/* Initial values and actions */

$('#home').addClass('active');

/* --------------------------------------------------------------------------------------------------------------------/*

/* Batteries management */

var notice;

function renderBatteries(url) {
	if (url === undefined || url === null) url = '/battery/all';
	$.get(url, function(data) {
			$('#content').empty();
			$('#content').append(data['view']);
			if (data['empty']) {
				$('#batteries-list').empty();
				$('#manage-batteries-container').append('<div class="alert alert-info top-buffer col-md-6 col-md-offset-3 text-center">No batteries found in the database.</div>');
			}
			if (notice) {
				$('#success').html(notice);
				$('#success').removeClass('hidden');
				notice = null;
			} else {
				$('#success').addClass('hidden');
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

/* Clear active links */
function clearActiveLinks() {
	$('#navbar-collapse li').removeClass('active');
}

/* Click on menu: manage batteries */
$(document).on('click', '#manage-batteries', function (event) {
    event.preventDefault();
    clearActiveLinks();
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
	renderBatteries();
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


/* Returns the value of a parameter in an URL */
function getURLParameter(url, parameter) {
	if (url == undefined) {
		return '1';
	}
	var pos = url.indexOf(parameter);
	if (pos === -1) {
		return false;
	}
	pos += parameter.length + 1;
	substr = url.substr(pos);
	end = substr.indexOf('&');
	if (end === -1) {
		return substr;
	}
	return substr.substr(0, end);
}

/* Returns the previous page */
function previousPageURL(url, parameter) {
	var pos = url.indexOf(parameter);
	if (pos === -1) {
		return false;
	}
	pos += parameter.length + 1;
	substr = url.substr(pos);
	end = substr.indexOf('&');
	page_value = (end === -1) ? substr : substr.substr(0, end);
	end += pos + page_value.length;
	first_chunk = url.substr(0, pos);
	last_chunk = url.substr(end + 1, url.length);
	prev_page = parseInt(page_value) - 1;
	prev_page_url = first_chunk + prev_page + last_chunk;
	return prev_page_url;
}

/* Returns the next page */
function nextPageURL(url, parameter) {
	var pos = url.indexOf(parameter);
	if (pos === -1) {
		return false;
	}
	pos += parameter.length + 1;
	substr = url.substr(pos);
	end = substr.indexOf('&');
	page_value = (end === -1) ? substr : substr.substr(0, end);
	end += pos + page_value.length;
	first_chunk = url.substr(0, pos);
	last_chunk = url.substr(end + 1, url.length);
	next_page = parseInt(page_value) + 1;
	next_page_url = first_chunk + next_page + last_chunk;
	return next_page_url;
}

/* Delete battery */
$(document).on('click', '.glyphicon-remove', function(event) {
	var thiz = $(this);
	var id = thiz.next('input:hidden').val();

	$.ajax({
		url: '/battery/' + id,
		type: 'DELETE'
	})
	.done(function(data) {
		notice = null;
		var executed = false;
		thiz.closest('tr')
			.find('td')
			.wrapInner('<div style="display: block;" />')
			.parent()
			.find('td > div')
			//.find('div')
			.slideUp(200)
			.delay(200, function() {
				if (!executed) {
					thiz.closest('td').remove();
					if ($('.table > tbody > tr').length > 1) {
						renderBatteries(curPage);
					} else {
						var page = getURLParameter(curPage, 'page');
						if (page !== '1') {
							prevPage = previousPageURL(curPage, 'page');
							renderBatteries(prevPage);
							curPage = prevPage;
						} else {
							renderBatteries();
						}
					}
					executed = true;
				}
			});
	});
});