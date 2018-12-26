<form id="main-form" action="{{ route('buy.store') }}" method="POST">
	@csrf
</form>
<form id="buy-search" action="{{ route('buy.getGoods') }}" method="POST">
	<div class="form-group">
		<select id="vendor-selector" name="vendor" class="form-control">
			<option>-- Pilih Vendor --</option>
			@foreach ($vendors as $vendor)
			<option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
			@endforeach
		</select>
	</div>
</form>
<form id="sub-buy-search" class="d-none">
	<div class="form-row">
		<div class="form-group col-sm">
			<select id="good-selector" name="good" class="form-control" href="{{ route('buy.getGood') }}">
				<option>-- Pilih Barang --</option>
			</select>
		</div>
		<div class="form-group col-sm">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="number" name="cost" class="form-control text-right" placeholder="Harga">
			</div>
		</div>
		<div class="form-group col-sm-2">
			<input type="number" name="qty" class="form-control text-right" placeholder="Qty">
		</div>
		<div class="form-group col-sm-1">
			<button type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
		</div>
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
				<th width="25%" class="text-right">Harga</th>
				<th width="15%" class="text-right">Qty</th>
				<th width="25%" class="text-right">Total</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>