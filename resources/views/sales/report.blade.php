@extends('templates.app')

@push('title','Laporan Penjualan')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Laporan Penjualan</h1>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-report" class="table table-stripped">
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
		$('#table-report').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('report.saleApi') }}",
			columns: [
				{data: 'DT_RowIndex', name: 'id'},
				{data: 'number', name: 'number'},
				{data: 'name', name: 'name'},
				{data: 'price', name: 'price'},
				{data: 'qty', name: 'qty'},
				{data: 'subtotal', name: 'subtotal'},
			],
		});
	</script>
@endpush