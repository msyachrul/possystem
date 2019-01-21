@extends('templates.app')

@push('title','Pembelian')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Pembelian</h1>
		</div>
		<div class="card-body">
			<form>
				<div class="form-group">
					<label for="vendor">Vendor</label>
					<select class="form-control" id="vendor"></select>
				</div>
				<div class="form-row">
					<div class="col-sm-12 col-lg-6">
						<label for="item">Barang</label>
						<select class="form-control" id="item"></select>
					</div>
					<div class="col-sm-8 col-lg-3">
						<label for="cost">Harga Beli</label>
						<input type="number" name="cost" class="form-control" min="0">
					</div>
					<div class="col-sm-4 col-lg-1">
						<label for="qty">Qty</label>
						<input type="number" name="qty" class="form-control" min="0">
					</div>
					<div class="col-sm-12 col-lg-2">
						<label>&nbsp</label>
						<button type="button" class="btn btn-primary btn-block">Tambah Barang</button>
					</div>
				</div>
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
			</form>
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
					data: function (param) {
						return {
							search: param.term,
							page: param.page || 1,
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
				placeholder: 'Nama Vendor',
				multiple: false,
			});
		});
	</script>
@endpush