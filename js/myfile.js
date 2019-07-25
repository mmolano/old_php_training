$(document).ready(function() {
	$('#table1').DataTable();
	$('#table2').DataTable();
	$('#table3').DataTable();

	$('.outfit a').click(function(event) {
		event.preventDefault();
		$('.outfit li').removeClass('active-album');
		$(this).parent().addClass('active-album');
	});

    $('#slide').slideDown('fast/400/fast', function() {
        
    });
});


