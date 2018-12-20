@extends('templates.app')

@push('title','Pembelian')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Pembelian</h1>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm text-right">
					<a href="{{ route('buy.create')}}" class="btn btn-primary">Tambah Pembelian</a>
				</div>
			</div>
			<hr>
			<div class="table-responsive">
				<table id="table-buy" class="table table-bordered">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th>No Berkas</th>
							<th width="15%">Total</th>
							<th width="5%"></th>
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
				{data: 'file_number', name: "file_number"},
				{data: 'total', name: "total"},
				{data: 'action', name: "action"},
			]
		});
	</script>
@endpush