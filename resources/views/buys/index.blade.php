@extends('templates.app')

@push('title','Pembelian')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Pembelian</h1>
		</div>
		<div class="card-body">
			<form id="buy" action="{{ route('buy.create') }}" method="GET">
				<div class="form-group">
					<input type="search" id="barcode" name="barcode" class="form-control" placeholder="Masukan barcode atau nama barang" autocomplete="off" autofocus>
				</div>
			</form>
			<hr>
			<div class="row">
				<div class="col-sm text-right">
					<h3 class="h3">Qty : <span id="total-qty" total-qty="">-</span></h3>
				</div>
				<div class="col-sm text-right">
					<h3 class="h3">Total : Rp <span id="total" total="">-</span></h3>
				</div>
				<div class="col-sm text-right">
					<button type="button" class="btn btn-outline-primary btn-buy" data-href="{{ route('buy.store') }}">Simpan Transaksi</button>
				</div>
			</div>
			<hr>
			<div class="table-responsive">
				<table id="table-buy" class="table table-bordered">
					<thead>
						<tr>
							<th width="15%">Barcode</th>
							<th>Nama Barang</th>
							<th width="10%">Harga</th>
							<th width="10%">Qty</th>
							<th width="15%">Total</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection