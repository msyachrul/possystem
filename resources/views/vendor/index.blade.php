@extends('templates.app')

@push('title','Vendor')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Data Vendor</h1>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-vendor" class="table table-stripped" width="100%">
					<thead>
						<th width="1%">#</th>
						<th>Nama</th>
						<th>Penanggung Jawab</th>
						<th>Alamat</th>
						<th>Status</th>
						<th class="text-center" width="5%"><button class="btn btn-primary btn-sm modal-show" data-href="{{ route('vendor.create') }}" data-title="Tambah Data Vendor"><i class="fa fa-plus"></i></button></th>
					</thead>
				</table>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script>
		$('#table-vendor').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('vendor.api') }}",
			columns: [
				{data: "DT_RowIndex", name: 'id'},
				{data: 'name', name: 'name'},
				{data: 'owner', name: 'owner'},
				{data: 'address', name: 'address'},
				{data: 'status', name: 'status'},
				{data: 'action', name: 'action'},
			],
			columnDefs: [
				{targets: 5, orderable: false},
			],
		});
	</script>
@endpush