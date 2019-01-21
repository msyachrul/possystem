@extends('templates.app')

@push('title','Pembelian')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Pembelian</h1>
		</div>
		<div class="card-body">
			<form id="buy" action="{{ route('buy.store') }}" method="post">
				<div class="form-group">
					<label for="vendor">Vendor</label>
					<select name="vendor" class="form-control form-control-sm" id="vendor" required></select>
				</div>
				<div class="form-row">
					<div class="col-12 col-lg-6">
						<label for="good">Barang</label>
						<select name="good" class="form-control form-control-sm" id="good" required></select>
					</div>
					<div class="col-8 col-lg-3">
						<label for="cost">Harga Beli</label>
						<input type="number" name="cost" class="form-control form-control-sm" min="0" placeholder="Harga Beli" required>
					</div>
					<div class="col-4 col-lg-1">
						<label for="qty">Qty</label>
						<input type="number" name="qty" class="form-control form-control-sm" min="0" placeholder="Qty" required>
					</div>
					<div class="col-12 col-lg-2">
						<label>&nbsp</label>
						<button type="submi" class="btn btn-sm btn-primary btn-block">Tambah Barang</button>
					</div>
				</div>
			</form>
			<br>
			<div class="table-responsive">
				<table id="table-item" class="table table-stripped">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th>Barang</th>
							<th width="250px">Harga Beli</th>
							<th width="100px">Qty</th>
							<th width="300px">Subtotal</th>
							<th width="1%"></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script type="text/javascript">
		$(document).ready(function () {
			$('select#vendor').select2({
				ajax: {
					url: "{{ route('buy.api.vendor') }}",
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
									id: item.id,
									text: item.id + ' - ' + item.name,
								};
							}),
							pagination: {
								more: data.pagination,
							}
						}
					},
				},
				placeholder: 'Pilih Vendor',
				multiple: false,
			});

			$('select#good').select2({
				ajax: {
					url: "{{ route('buy.api.good') }}",
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
							}
						}
					},
				},
				placeholder: 'Pilih Barang',
				multiple: false,
			}).on('select2:select', function (event) {
				$('input[name=cost]').val(event.params.data.cost).focus();
			});

			$('form#buy').submit(function (event) {
				event.preventDefault();
			});
		});
	</script>
@endpush