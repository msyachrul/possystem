@extends('templates.app')

@push('title','Laporan Persediaan')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Laporan Persediaan</h1>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-stock" class="table table-stripped">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th>Barang</th>
							<th>HPP</th>
							<th>Qty</th>
							<th>Sub Total</th>
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
		$('#table-stock').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('report.stock.api') }}",
			columns: [
				{data: 'DT_RowIndex', name: 'id'},				
				{data: 'name', name: 'name'},
				{data: 'cost', name: 'cost'},
				{data: 'qty', name: 'qty'},
				{data: 'subtotal', name: 'subtotal'},
			],
			columnDefs: [
				{targets: [2, 3, 4], className: 'text-right'},
			],
			order: [[1, 'asc']],
		});
	</script>
@endpush