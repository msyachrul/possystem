<form id="main-form" action="{{ route('buy.store') }}" method="POST">
	@csrf
</form>
<form id="buy-search" action="{{ route('buy.getVendorGoods') }}" method="POST">
	<div class="form-group">
		<label class="control-label">Vendor</label>
		<select id="vendor-selector" name="vendor" class="form-control">
			<option>-- Pilih Vendor --</option>
			@foreach ($vendors as $vendor)
			<option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
			@endforeach
		</select>
	</div>
</form>
<form id="sub-buy-search" action="{{ route('buy.cart') }}" method="POST" class="d-none">
	@csrf
	<div class="form-row">
		<div class="form-group col-sm-5">
			<label class="control-label">Barang</label>
			<select id="good-selector" name="barcode" class="form-control" href="{{ route('buy.getGood') }}">
				<option>-- Pilih Barang --</option>
			</select>
		</div>
		<div class="form-group col-sm-4">
			<label class="control-label">Harga</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="number" name="cost" class="form-control" placeholder="Harga" min="0">
			</div>
		</div>
		<div class="form-group col-sm-2">
			<label class="control-label">Qty</label>
			<input type="number" name="qty" class="form-control" placeholder="Qty" min="0">
		</div>
		<div class="form-group col-sm-1">
			<label class="control-label">&nbsp</label>
			<button type="submit" class="btn btn-primary form-control"><i class="fa fa-plus"></i></button>
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
				<th class="text-right">Harga</th>
				<th width="5%" class="text-right">Qty</th>
				<th class="text-right">Total</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>