/* "Working" functions or those with bussiness logic */

function renderHomePage(url) {
	if (url === undefined || url === null) url = '/home/main';
	url = url.replace('?page', '/home/main?page');
	$.get(url, function(data) {
		$('#content').html(data['view']);
	});
}

/* Initialize Bootstrap tooltip opt-in */ 
$(function () {
  $('[data-toggle="tooltip"]').tooltip({
  	delay: { show: 700, hide: 100 }
  });
});

var curPage = null;
$(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    if ($(this).attr('href') != '#') {
        $("html, body").animate({ scrollTop: 0 }, "fast");
        curPage = $(this).attr('href');
        renderHomePage(curPage);
    }
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