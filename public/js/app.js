function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

$('body').on('click', '.modal-show', function () {
	let me = $(this),
		url = me.data('href'),
		title = me.data('title');

	$('.modal-title').text(title);
	$('.modal .btn-save').removeClass('d-none').text(me.hasClass('edit') ? 'Perbaharui' : 'Simpan');

	if (me.hasClass('show')) {
		$('.modal .btn-save').addClass('d-none');
	}

	$.ajax({
		url: url,
		dataType: 'html',
		success: function (response) {
			$('.modal-body').html(response);
		}
	});

	$('.modal').modal('show');
});

$('.modal .btn-save').click(function (event) {
	event.preventDefault();

	let form = $('#main-form'),
		url = form.attr('action'),
		method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT',
		title = $('input[name=_method]').val() == undefined ? 'menambahkan' : 'memperbaharui',
		table = $('table').attr('id'),
		data = form.serialize();

	form.find('.is-invalid').removeClass('is-invalid');
	form.find('.invalid-feedback').remove();

	$.ajax({
		url: url,
		method: method,
		data: data,
		success: function (response) {
			$('.modal').modal('hide');
			$('#' + table).DataTable().ajax.reload();
			swal({
				'type': 'success',
				'title': 'Sukses!',
				'text': 'Berhasil ' + title + ' data!',
			});
		},
		error: function (xhr) {
			let res = xhr.responseJSON;

			if($.isEmptyObject(res.errors) == false) {
				$.each(res.errors, function (key, value) {
					$('#' + key).addClass('is-invalid').after('<div class="invalid-feedback">' + value + '</div>')
				});
			}
			else {
				swal({
					'type': 'error',
					'title': 'Error!',
					'text': res.message,
				});
				$('.modal').modal('hide');
			}
		},
	});
});

$('body').on('click', '.btn-destroy', function(event) {
	let me = $(this),
		url = me.data('href'),
		title = me.data('title');
		csrf_token = $('meta[name="csrf-token"]').attr('content'),
		table = $('table').attr('id');

	swal({
		'type': 'question',
		'title': 'Apakah anda yakin untuk hapus ' + title + ' ?',
		'text': 'Mohon periksa terlebih dahulu!',
		'showCancelButton': true,
		'confirmButtonText': 'Ya, saya yakin!',
		'confirmButtonColor': '#3085d6',
		'cancelButtonText': 'Kembali',
		'cancelButtonColor': '#d33',
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: url,
				type: 'POST',
				data: {
					'_method': 'DELETE',
					'_token': csrf_token,
				},
				success: function (response) {
					$('#' + table).DataTable().ajax.reload();
					swal({
						'type': 'success',
						'title': 'Sukses!',
						'text': 'Data ' + title + ' berhasil dihapus!',
					})
				},
				error: function (xhr) {
					swal({
						'type': 'error',
						'title': 'Oops...',
						'text': 'Proses gagal dijalankan!',
					});
				},
			});
		}
	});
});