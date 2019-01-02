@extends('templates.app')

@push('title','Barang')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Master Barang</h1>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-good" class="table table-stripped" width="100%">
					<thead>
						<th width="1%">#</th>
						<th>Barcode</th>
						<th>Nama</th>
						<th>Kategori</th>
						<th>Vendor</th>
						<th>Qty</th>
						<th>HPP</th>
						<th>Harga Jual</th>
						<th class="text-center" width="5%"><button class="btn btn-primary btn-sm modal-show" data-href="{{ route('good.create') }}" data-title="Tambah Master Barang"><i class="fa fa-plus"></i></button></th>
					</thead>
				</table>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script>
		$('#table-good').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('good.api') }}",
			columns: [
				{data: "DT_RowIndex", name: 'id'},
				{data: 'barcode', name: 'barcode'},
				{data: 'name', name: 'name'},
				{data: 'category', name: 'category'},
				{data: 'vendor', name: 'vendor'},
				{data: 'qty', name: 'qty'},
				{data: 'cost', name: 'cost'},
				{data: 'price', name: 'price'},
				{data: 'action', name: 'action'},
			],
			columnDefs: [
				{targets: [5, 6, 7], className: 'text-right'},
				{targets: 8, orderable: false},
			
			],
		});
	</script>
@endpush