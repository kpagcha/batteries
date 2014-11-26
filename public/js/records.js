/* "Working" functions or those with bussiness logic */

function renderRecords(url) {
	if (url === undefined || url === null) url = '/record';
	$.get(url, function(data) {
		$('.tab-pane').removeClass('active');
		$('#main-tabs li').removeClass('active');
		$('#history-tab').addClass('active');
		$('#history').addClass('active');
		$('#history').html(data['view']);
	});
}

var curPage = null;
$(document).on('click', '#history-links a', function (event) {
    event.preventDefault();
    if ($(this).attr('href') != '#') {
        curPage = $(this).attr('href');
        renderRecords(curPage);
    }
});

/* History tab */
$(document).on('click', '#history-tab a', function(event) {
	event.preventDefault();
	renderRecords();
});