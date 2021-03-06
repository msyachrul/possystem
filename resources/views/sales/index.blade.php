@extends('templates.app')

@push('title','Penjualan')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Penjualan</h1>
		</div>
		<div class="card-body">
			<form id="sale" action="{{ route('sale.store') }}" method="post">
				@csrf
			</form>
			<form id="cart" action="{{ route('sale.add') }}" method="get">
				<div class="form-row">
					<div class="form-group col-8 col-lg-9">
						<label for="good">Barang</label>
						<select name="good" class="form-control form-control-sm" id="good" required></select>
					</div>
					
					<div class="form-group col-4 col-lg-1">
						<label for="qty">Qty</label>
						<input type="number" name="qty" class="form-control form-control-sm" min="0" placeholder="Qty" required>
					</div>
					<div class="form-group col-12 col-lg-2">
						<label>&nbsp</label>
						<button type="submit" class="btn btn-sm btn-outline-primary btn-block"><i class="fa fa-plus"></i> Tambah Barang</button>
					</div>
				</div>
			</form>
			<br>
			<div class="table-responsive">
				<table id="table-item" class="table table-striped">
					<thead>
						<tr class="table-active">
							<th>Barang</th>
							<th width="110px" class="text-center">Harga</th>
							<th width="70px" class="text-center">Qty</th>
							<th width="150px" class="text-center">Sub Total</th>
							<th width="100px" class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody></tbody>
					<tfoot>
						<tr class="table-active">
							<th colspan="2" class="text-right">Total</th>
							<th class="text-right"><span class="totalqty"></span></th>
							<th class="text-right">Rp <span class="total"></span></th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
			<br>
			<button type="submit" class="btn btn-primary btn-block" form="sale"><i class="fa fa-save"></i> Simpan Penjualan</button>
		</div>
	</div>
@endsection

@push('scripts')
	<script type="text/javascript">
		function clearSummary() {
			let cart = $('#table-item tbody tr');
			let totalQty = 0;
			let total = 0;
			$.each(cart, function () {
				totalQty += Number($(this).find('input.qty').val());
				total += Number($(this).find('input.subtotal').val());
			});
			$('#table-item tfoot .totalqty').text(totalQty);
			$('#table-item tfoot .total').text(numberWithCommas(total));
		}

		function removeItem(barcode, name) {
			swal({
				'type': 'question',
				'title': 'Apakah anda yakin untuk hapus ' + barcode + ' - ' + name + ' ?',
				'text': 'Mohon periksa terlebih dahulu!',
				'showCancelButton': true,
				'confirmButtonText': 'Ya, saya yakin!',
				'confirmButtonColor': '#3085d6',
				'cancelButtonText': 'Kembali',
				'cancelButtonColor': '#d33',
			}).then((result) => {
				if(result.value) {
					$('#table-item tbody tr#' + barcode).remove();
					clearSummary();
				}
			});
		}

		$('form#cart').submit(function (event) {
			event.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				data: $(this).serialize(),
				dataType: 'html',
				success: function (response) {
					let	barcode = $(response).attr('id'),
						row = $('#' + barcode);
					if (row.length == 0) {
						$('#table-item tbody').append(response);
					}
					else {
						let newQty = Number(row.find('input.qty').val()) + Number($(response).find('input.qty').val()),
							newTotal = Number(row.find('input.price').val()) * newQty;
						row.find('input.qty').val(newQty);
						row.find('input.subtotal').val(newTotal);
						row.find('span.qty').text(newQty);
						row.find('span.subtotal').text(numberWithCommas(newTotal));
					}
					clearSummary();
				},
			});
			$('select#good').empty();
			$('form#cart').trigger('reset');
		});

		$('form#sale').submit(function (event) {
			event.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				method: $(this).attr('method'),
				data: $(this).serialize(),
				success: function (response) {
					swal({
						type: response.type,
						title: response.title,
						text: response.text,
					});
					if (response.type == 'success') {
						$('select#vendor').empty();
						$('select#good').empty();
						$('form#cart').trigger('reset');
						$('#table-item tbody tr').remove();
						$('#table-item tfoot .totalqty').empty();
						$('#table-item tfoot .total').empty();
					}
				},
			});
		});

		$(document).ready(function () {
			$('select#good').select2({
				ajax: {
					url: "{{ route('sale.api.good') }}",
					dataType: 'json',
					data: function (params) {
						return {
							search: params.term,
							page: params.page || 1,
						};
					},
					processResults: function (data) {
						data.page = data.page || 1;
						return {
							results: data.items.map(function (item) {
								return {
									id: item.barcode,
									text: item.barcode + ' - ' + item.name,
									cost: item.cost,
								};
							}),
							pagination: {
								more: data.pagination,
							},
						};
					},
				},
				placeholder: 'Pilih Barang',
				multiple: false,
			});
		});
	</script>
@endpush