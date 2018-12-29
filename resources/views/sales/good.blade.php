<tr id="{{ $model->barcode }}">
	<input type="hidden" class="barcode" name="barcode[]" value="{{ $model->barcode }}" form="main-form">
	<input type="hidden" class="price" name="price[]" value="{{ $model->price }}" form="main-form">
	<input type="hidden" class="qty" name="qty[]" value="{{ $qty }}" form="main-form">
	<input type="hidden" class="subtotal" name="subtotal[]" value="{{ $model->price * $qty }}" form="main-form">
	<td>
		{{ $model->barcode. ' - ' .$model->name}}
	</td>
	<td class="text-right">
		Rp {{ number_format($model->price) }}
	</td>
	<td class="text-right">
		<span class="qty">{{ $qty }}</span>
	</td>
	<td class="text-right">
		Rp&nbsp<span class="subtotal">{{ number_format($model->price * $qty) }}</span>
	</td>
</tr>