<form id="main-form" action="{{ route('sale.store') }}" method="POST">
	@csrf
</form>
<form id="sale-search" action="{{ route('sale.getGood') }}" method="POST">
	<div class="form-group">
		<input type="search" id="search" name="search" class="form-control" placeholder="Masukan barcode atau nama barang" autocomplete="off" autofocus>
	</div>
</form>
<hr>
<div class="row">
	<div class="col-sm">
		<h3 class="h3">Qty : <span id="totalqty" totalqty="">-</span></h3>
	</div>
	<div class="col-sm">
		<h3 class="h3">Total : Rp <span id="total" total="">-</span></h3>
	</div>
</div>
<hr>
<div class="table-responsive">
	<table id="table-good" class="table table-stripped">
		<thead>
			<tr>				
				<th>Barang</th>
				<th class="text-right">Harga</th>
				<th width="5%" class="text-right">Qty</th>
				<th class="text-right">Total</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>