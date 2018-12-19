@extends('templates.app')

@push('title','Kategori Barang')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Master Kategori Barang</h1>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-good-category" class="table table-stripped" width="100%">
					<thead>
						<th width="1%">#</th>
						<th>Nama</th>
						<th class="text-center" width="5%"><button class="btn btn-primary btn-sm modal-show" data-href="{{ route('good_category.create') }}" data-title="Tambah Master Kategori"><i class="fa fa-plus"></i></button></th>
					</thead>
				</table>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script>
		$('#table-good-category').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('good_category.api') }}",
			columns: [
				{data: "DT_RowIndex", name: 'id'},
				{data: 'name', name: 'name'},
				{data: 'action', name: 'action'},
			],
			columnDefs: [
				{targets: 2, orderable: false},
			],
		});
	</script>
@endpush