/* "Working" functions or those with bussiness logic */

var notice;

/* Load the view returned by url */
function render(url) {
	$.get(url, function(data) {
		$('#content').html(data['view']);
	});
}

/* Load the users list */
function renderUsers(url) {
	if (url === undefined || url === null) url = '/user';
	$.get(url, function(data) {
		if (!data['empty']) {
			$('#content').html(data['view']);
		} else {
			$('#content').html('<div class="alert alert-info top-buffer col-md-6 col-md-offset-3 text-center">No users found in the database.</div>');
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
/* Clear active links */
function clearActiveLinks() {
	$('#navbar-collapse li').removeClass('active');
}

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
/* --------------------------------------------------------------------------------------------------------------------/*

/* "Assign to view" or "respond to click" functions */

/* Login form */
$(document).on('click', '#login', function(event) {
	event.preventDefault();
    clearActiveLinks();
    $('#login').addClass('active');
	render('/login');
});

/* Login */
$(document).on('click', '#login-submit', function(event) {
	event.preventDefault();
	$.post('/login', $('#login-form').serialize(), function(data) {
		if (data['status'] == true) {
			$('#content').empty();
			$('#notice').removeClass('hidden');
			$('#notice').html(data['notice']);
			setTimeout(function() {
			    window.location.replace('/home/main');
			}, 500);
		} else {
			$('#error').removeClass('hidden');
			$('#error').html(data['error']);
		}
	});
});

/* Register form */
$(document).on('click', '#register', function(event) {
	event.preventDefault();
    clearActiveLinks();
    $('#register').addClass('active');
    $('#notice, #registratoinerrors').addClass('hidden');
	render('/signup');
});


/* Signup */
$(document).on('click', '#register-submit', function(event) {
	event.preventDefault();
	$.post('/signup', $('#register-form').serialize(), function(data) {
		if (data['status'] == true) {
			$('#content').empty();
			$('#notice').removeClass('hidden');
			$('#notice').html(data['notice']);
			setTimeout(function() {
			    window.location.replace('/home/main');
			}, 500);
		} else {
			$('#registration-errors').removeClass('hidden');
			$('#registration-errors').html(data['errors']);
		}
		window.scrollTo(0, 0);
	});
});

/* Logout */
$(document).on('click', '#logout', function(event) {
	event.preventDefault();
	$.get('/logout', function(data) {
		$('#content').empty();
		$('#notice').removeClass('hidden');
		$('#notice').html(data['notice']);
		setTimeout(function() {
		    window.location.replace('/home/main');
		}, 500);
	});
});

/* Users list */
$(document).on('click', '#manage-users', function(event) {
	event.preventDefault();
	$.get('/user', function(data) {
		clearActiveLinks();
		$('#manage-users').addClass('active');
		renderUsers();
	});
});

/* Click on pagination link */
$(document).on('click', '.pagination a', function(event) {
    event.preventDefault();
    if ($(this).attr('href') != '#') {
        $("html, body").animate({ scrollTop: 0 }, "fast");
        curPage = $(this).attr('href');
        renderUsers(curPage);
    }
});

/* Create new user */
$(document).on('click', '#create-user', function(event) {
	event.preventDefault();
	$.post('/user', $('#create-user-form').serialize(), function(data) {
		if (data['status'] == true) {
			$('#errors').addClass('hidden');
			$('#success').removeClass('hidden');
			notice = data['message'];
			$('#success').html(notice);
			$('#create-new-user').modal('hide');
		} else {
			$('#success').addClass('hidden');
			$('#errors').removeClass('hidden');
			$('#errors').html(data['errors']);
			$('#errors').addClass('top-buffer');
			$('html,body').animate({scrollTop: $('#create-new-user').offset().top});
		}
	});
});

/* Reload users after closing modal */
$(document).on('hidden.bs.modal', '#create-new-user', function(e) {
	renderUsers();
});


/* Delete battery */
$(document).on('click', '.glyphicon-remove', function(event) {
	var thiz = $(this);
	var id = thiz.next('input:hidden').val();

	$.ajax({
		url: '/user/' + id,
		type: 'DELETE'
	})
	.done(function(data) {
		if (data['status']) {
			notice = null;
			var executed = false;
			thiz.closest('tr')
				.find('td')
				.wrapInner('<div style="display: block;" />')
				.parent()
				.find('td > div')
				.slideUp(200)
				.delay(200, function() {
					if (!executed) {
						thiz.closest('td').remove();
						if ($('.table > tbody > tr').length > 1) {
							renderUsers(curPage);
						} else {
							var page = getURLParameter(curPage, 'page');
							if (page !== '1') {
								prevPage = previousPageURL(curPage, 'page');
								renderUsers(prevPage);
								curPage = prevPage;
							} else {
								renderUsers();
							}
						}
						executed = true;
					}
				});
		} else {
			$('#success').removeClass('hidden');
			$('#success').html(data['message']);
		}
	});
});