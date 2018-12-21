<tr id="{{ $model->barcode }}">
	<td>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text">{{ $model->name }}</span>
			</div>
			<input type="text" id="barcode" name="barcode[]" value="{{ $model->barcode }}" class="form-control" form="main-form" readonly>
		</div>
	</td>
	<td>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text">Rp</span>
			</div>
			<input type="number" id="cost" name="cost[]" value="{{ $model->cost }}" form="main-form" class="form-control text-right">
		</div>
	</td>
	<td>
		<div class="input-group">
			<input type="number" id="qty" name="qty[]" value="{{ $qty }}" form="main-form" class="form-control text-right"></td>
		</div>
	<td>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text">Rp</span>
			</div>
			<input type="number" id="subtotal" name="subtotal[]" value="{{ $model->cost * $qty }}" form="main-form" class="form-control text-right" readonly>
		</div>
	</td>
</tr>