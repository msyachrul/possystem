@extends('templates.app')

@push('title','Pembelian')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Pembelian</h1>
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
				{data: 'file_number', name: "file_number"},
				{data: 'total', name: "total"},
				{data: 'action', name: "action"},
			]
		});
	</script>
@endpush