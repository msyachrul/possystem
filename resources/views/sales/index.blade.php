@extends('templates.app')

@push('title','Penjualan')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Penjualan</h1>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-sale" class="table table-stripped">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th>No Berkas</th>
							<th width="150px">Total</th>
							<th width="5%"><button class="btn btn-primary btn-sm modal-show" data-href="{{ route('sale.create') }}" data-title="Tambah Penjualan"><i class="fa fa-plus"></i></button></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script>
		$('#table-sale').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('sale.api') }}",
			columns: [
				{data: 'DT_RowIndex', name: "id"},
				{data: 'number', name: "number"},
				{data: 'total', name: "total"},
				{data: 'action', name: "action"},
			],
			columnDefs: [
				{targets: 2, className: 'text-right'},
				{targets: 3, orderable: false},
				
			],
		});

		$('body').on('keypress', '#search', function (event) {
			let form = $('#sale-search'),
				url = form.attr('action'),
				method = form.attr('method'),
				csrf_token = $('meta[name="csrf-token"]').attr('content');

			if (event.which == 13) {
				let search = $(this).val();

				$.ajax({
					url: url,
					type: method,
					dataType: 'html',
					data: {
						'_token': csrf_token,
						'search': search,
					},
					success: function (response) {
						let res = $(response),
							barcodeRow = res.attr('id'),
							row = $('#' + barcodeRow),
							resPrice = Number(res.find('input.price').val()),
							resQty = Number(res.find('input.qty').val()),
							resSubTotal = Number(res.find('input.subtotal').val());

						if (row.length == 0) {
							$('#table-good tbody').append(response);
						}
						else {
							let qty = Number(row.find('input.qty').val());
								newQty = qty + resQty;
								subTotal = resPrice * newQty;

							row.find('input.qty').val(newQty);
							row.find('span.qty').text(newQty);
							row.find('input.subtotal').val(subTotal);
							row.find('span.subtotal').text(numberWithCommas(subTotal));
						}

						let cart = $('#table-good tbody tr');
						let totalQty = 0;
						let total = 0;

						$.each(cart, function () {
							totalQty += Number($(this).find('input.qty').val());
							total += Number($(this).find('input.subtotal').val());
						});

						$('#totalqty').text(numberWithCommas(totalQty));
						$('#total').text(numberWithCommas(total));
					},
					error: function (xhr) {
						swal({
							'type': 'error',
							'title': 'Error!',
							'text': 'Barang tidak ditemukan!',
						});
					}
				});
				$('#search').val('');
			}
		});
	</script>
@endpush