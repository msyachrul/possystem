@extends('templates.app')

@push('title','Laporan Transaksi')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Laporan Transaksi</h1>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-transaction" class="table table-stripped">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th>No Transaksi</th>
							<th>Total HPP</th>
							<th>Total Penjualan</th>
							<th>Profit</th>
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
	<script type="text/javascript">
		$('#table-transaction').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax : "{{ route('report.transaction.api') }}",
			columns: [
				{data: 'DT_RowIndex', orderable: false, searchable: false},
				{data: 'number', name: 'number'},
				{data: 'cost_total', name: 'cost_total'},
				{data: 'price_total', name: 'price_total'},
				{data: 'profit_total', name: 'profit_total'},
			],
			columnDefs: [
				{targets: [2, 3, 4], className: 'text-right'}
			],
			order: [[1, 'asc']],
		});
	</script>
@endpush