$(document).ready(function () {
	$('form').submit(function (event) {
		event.preventDefault();

		let form = $(this);

		$.ajax({
			url:   form.attr('action'),
			type:   form.attr('method'),
			data: form.serialize(),
			success: function (result) {
				document.write(result);
				console.log('success');
				if(result.indexOf(' #') !== -1) {
					let petition_number = result.split(' #')[1].split(' ')[0];
					setTimeout(function () {
						window.location = "index.php#petition-" + petition_number;
					}, 2500);
				}
			}
		}).fail(function() {
			console.log('fail');
		});

	});
});