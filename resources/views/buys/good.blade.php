<tr id="{{ $model->barcode }}">
	<input type="hidden" class="barcode" name="barcode[]" value="{{ $model->barcode }}" form="main-form">
	<input type="hidden" class="cost" name="cost[]" value="{{ $cost }}" form="main-form">
	<input type="hidden" class="qty" name="qty[]" value="{{ $qty }}" form="main-form">
	<input type="hidden" class="subtotal" name="subtotal[]" value="{{ $cost * $qty }}" form="main-form">
	<td>
		{{ $model->barcode. ' - ' .$model->name}}
	</td>
	<td class="text-right">
		Rp&nbsp<span class="cost">{{ number_format($cost) }}</span>
	</td>
	<td class="text-right">
		<span class="qty">{{ $qty }}</span>
	</td>
	<td class="text-right">
		Rp&nbsp<span class="subtotal">{{ number_format($cost * $qty) }}</span>
	</td>
</tr>