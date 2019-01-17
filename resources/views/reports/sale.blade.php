@extends('templates.app')

@push('title','Laporan Penjualan')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Laporan Penjualan</h1>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-sale" class="table table-stripped">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th>No Berkas</th>
							<th>Barang</th>
							<th>Harga</th>
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
		$('#table-sale').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('report.sale.api') }}",
			columns: [
				{data: 'DT_RowIndex', name: 'id'},
				{data: 'number', name: 'number'},
				{data: 'name', name: 'name'},
				{data: 'price', name: 'price'},
				{data: 'qty', name: 'qty'},
				{data: 'subtotal', name: 'subtotal'},
			],
			columnDefs: [
				{targets: [3, 4, 5], className: 'text-right'},
			],
			order: [[1, 'asc']],
		});
	</script>
@endpush