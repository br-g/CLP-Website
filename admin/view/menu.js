$( document ).ready(function() {

	// Save area
	$('#saveArea button').click(function() {
		$('#saveArea p').css('display', 'inline');
		setTimeout(function() {
		    $('#saveArea p').css('display', 'none');
		}, 3000);
	});

	// Top links
	for (var i = 0; i < 3; i++) {
		$.get('asset/toplink.html', function(data) {
		     $('#toplinks').append(data);
		});
	}

	// Miniatures
	for (var i = 0; i < 3; i++) {
		$.get('asset/miniature.html', function(data) {
		     $('#miniatures').append(data);
		});
	}

	// Sections
	$('#sections #addSection').click(function() {
		$.get('asset/section.html', function(data) {
		     $('#sections').append(data);
		});
	});

	// Actions
	$(document).on("click", ".content > .contentElem .actions .up",function() {
		if ($(this).parent().parent().prev().hasClass('contentElem'))
			$(this).parent().parent().swapWith( $(this).parent().parent().prev() );
	});
	$(document).on("click", ".content > .contentElem .down",function() {
		if ($(this).parent().parent().next().hasClass('contentElem'))
			$(this).parent().parent().swapWith( $(this).parent().parent().next() );
	});
	$(document).on("click", ".content > .contentElem .delete",function() {
		if (confirm("Supprimer cette section ?"))
			$(this).parent().parent().remove();
	});
	


});