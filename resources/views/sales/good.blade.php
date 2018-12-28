<tr id="{{ $model->barcode }}">
	<input type="hidden" id="barcode" name="barcode[]" value="{{ $model->barcode }}" form="main-form">
	<input type="hidden" id="price" name="price[]" value="{{ $model->price }}" form="main-form">
	<input type="hidden" id="qty" name="qty[]" value="{{ $qty }}" form="main-form">
	<input type="hidden" class="subtotal" name="subtotal[]" value="{{ $model->price * $qty }}" form="main-form">
	<td>
		{{ $model->barcode. ' - ' .$model->name}}
	</td>
	<td class="text-right">
		Rp {{ number_format($model->price) }}
	</td>
	<td class="text-right">
		<span id="qty">{{ $qty }}</span>
	</td>
	<td class="text-right">
		Rp&nbsp<span id="subtotal">{{ number_format($model->price * $qty) }}</span>
	</td>
</tr>