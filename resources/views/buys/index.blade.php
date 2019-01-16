@extends('templates.app')

@push('title','Daftar Pembelian')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Daftar Pembelian</h1>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-buy" class="table table-stripped">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th>No Berkas</th>
							<th width="15%">Total</th>
							<th width="5%"><button class="btn btn-primary btn-sm modal-show" data-href="{{ route('buy.create') }}" data-title="Tambah Pembelian"><i class="fa fa-plus"></i></button></th>
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
		$('#table-buy').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('buy.api') }}",
			columns: [
				{data: 'DT_RowIndex', name: "id"},
				{data: 'number', name: "number"},
				{data: 'total', name: "total"},
				{data: 'action', name: "action"},
			],
			columnDefs: [
				{targets: 3, orderable: false},
			],
		});

		$('body').on('change', '#vendor-selector', function (event) {
			let form = $('#buy-search'),
				url = form.attr('action'),
				method = form.attr('method'),
				csrf_token = $('meta[name="csrf-token"]').attr('content'),
				select = $(this),
				vendorId = select.val();

			$.ajax({
				url: url,
				type: method,
				dataType: 'html',
				data: {
					'_token': csrf_token,
					'vendorId': vendorId,
				},
				success: function (response) {
					if (JSON.parse(response).length > 0) {
						select.attr('disabled','disabled');

						$.each(JSON.parse(response), function (key, value) {
							$('#good-selector').append('<option value="' + value.barcode + '">' + value.name + '</option>');
						});
						
						$('#sub-buy-search').removeClass('d-none');
					}
				}
			});
		});

		$('body').on('change', '#good-selector', function (event) {
			let form = $('#sub-buy-search'),
				me = $(this),
				url = me.attr('href'),
				csrf_token = $('meta[name="csrf-token"]').attr('content'),
				barcode = me.val();
			
			$.ajax({
				url: url,
				type: 'POST',
				data: {
					'_token': csrf_token,
					'barcode': barcode,
				},
				success: function (response) {
					form.find('input[name=cost]').val(response.cost);
					form.find('input[name=qty]').focus();
				}
			});
		});

		$('body').on('submit', '#sub-buy-search', function (event) {
			event.preventDefault();

			let form = $(this),
				url = form.attr('action'),
				method = form.attr('method'),
				data = form.serialize();

			$.ajax({
				url: url,
				type: method,
				dataType: 'html',
				data: data,
				success: function (response) {
					let res = $(response),
						barcodeRow = res.attr('id'),
						row = $('#' + barcodeRow),
						resCost = Number(res.find('input.cost').val()),
						resQty = Number(res.find('input.qty').val()),
						resSubTotal = Number(res.find('input.subtotal').val());

					if (row.length == 0) {
							$('#table-good tbody').append(response);
						}
					else {
						let qty = Number(row.find('input.qty').val());
							newQty = qty + resQty;
							subTotal = resCost * newQty;

						row.find('input.cost').val(resCost);
						row.find('span.cost').text(numberWithCommas(resCost));
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
					form.trigger('reset');
				},
			});
		});
	</script>
@endpush