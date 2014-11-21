/* "Working" functions or those with bussiness logic */

function render(url) {
	$.get(url, function(data) {
		$('#content').html(data['view']);
	});
}

/* --------------------------------------------------------------------------------------------------------------------/*

/* "Assign to view" or "respond to click" functions */

/* Clear active links */
function clearActiveLinks() {
	$('#home, #manage-batteries, #login, #signup').removeClass('active');
}

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