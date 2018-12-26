function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

$('body').on('submit', 'form', function (event) {
	event.preventDefault();
})

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
			console.log(form.serialize());
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
			if($.isEmptyObject(res) == false) {
				$.each(res.errors, function (key, value) {
					$('#' + key).addClass('is-invalid').after('<div class="invalid-feedback">' + value + '</div>')
				});
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
		'title': 'Apakah anda yakin untuk hapus vendor ' + title + ' ?',
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
						'text': 'Data vendor berhasil dihapus!',
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

$('body').on('keypress', '#barcode', function (event) {
	let form = $('#search'),
		url = form.attr('action'),
		method = form.attr('method'),
		csrf_token = $('meta[name="csrf-token"]').attr('content');

	if (event.which == 13) {
		let barcode = $('#barcode').val(),
			totalQty = $('#totalqty').attr('totalqty'),
			total = $('#total').attr('total');
		$.ajax({
			url: url,
			type: method,
			dataType: 'html',
			data: {
				'_token': csrf_token,
				'barcode': barcode,
			},
			success: function (response) {
				let me = $(response);
				totalQty = Number(totalQty) + Number(me.find('#qty').val());
				total = Number(total) + Number(me.find('#subtotal').val());
				barcode = barcode.includes('*') ? barcode.split('*')[1] : barcode;

				$('#totalqty').attr('totalqty',totalQty).text(totalQty);
				$('#total').attr('total',total).text(total);

				if ($('#' + barcode).length == 0) {
					$('#table-good tbody').append(response);
				}
				else {
					bcode = $('#' + barcode),
					qty = Number(bcode.find('#qty').val());
					bcode.find('#qty').val(qty + Number(me.find('#qty').val()));
					bcode.find('#subtotal').val(Number(bcode.find('#price').val()) * Number(bcode.find('#qty').val()));

				}
			},
			error: function (xhr) {
				swal({
					'type': 'error',
					'title': 'Error!',
					'text': 'Barang tidak ditemukan!',
				});
			}
		});
		$('#barcode').val('');
	}
});