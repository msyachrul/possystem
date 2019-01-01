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
							<th>Qty</th>
							<th>Total HPP</th>
							<th>Total Harga Jual</th>
							<th>Profit</th>
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
	<script type="text/javascript">
		$('#table-transaction').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax : "{{ route('transaction.api') }}",
			columns: [
				{data: 'DT_RowIndex', name: 'number'},
				{data: 'number', name: 'number'},
				{data: 'qty', name: 'qty'},
				{data: 'total_hpp', name: 'total_hpp'},
				{data: 'total_price', name: 'total_price'},
				{data: 'profit', name: 'profit'},
				{data: 'action', name: 'action', orderable: false, searchable: false},
			],
			columnDefs: [
				{targets: [2, 3, 4, 5], className: 'text-right'},
			]
		});
	</script>
@endpush