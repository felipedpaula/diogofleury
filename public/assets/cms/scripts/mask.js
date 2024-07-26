/**
 * Load all counters in screen
 */
function __loadCounters(){
	let count = $('.field-counter').length;

	for(let i = 0; i < count; i++){
		let $counter = $('.field-counter').eq(i);
		let $target = $counter.parent().parent().find("[name='" + $counter.attr('data-target') + "']");

		// Load initial values
		__updateCounter($target, $counter);

		// Put event listeners for target
		$target.on('keydown', function(){
			__updateCounter($target, $counter);
		});
		$target.on('change', function(){
			__updateCounter($target, $counter);
		});
	}
}

/**
 * Update counter
 */
function __updateCounter($target, $counter){
	let value = $target.val();
	let currentSize = value.length;
	$counter.html(currentSize);

	let max = parseInt($counter.attr('data-max'));
	if(currentSize > max){
		$counter.removeClass('badge-success').addClass('badge-danger');
	}else{
		$counter.removeClass('badge-danger').addClass('badge-success');
	}
}


$('.delete_button').on('click', function(){
    // Fill the action and pub name on modal
    $('#deleteModal').modal('show');
});
// On modal close
$('#deleteModal').on('hidden.bs.modal', function (e) {
    // Remove filled data
    $('#deleteModal form').attr('action', '');
    $('#deleteModal .modal-body span').html('');
});
