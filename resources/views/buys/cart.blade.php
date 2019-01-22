<tr id="{{ $item->barcode }}">
	<input type="hidden" class="barcode" name="barcode[]" value="{{ $item->barcode }}" form="buy">
	<input type="hidden" class="cost" name="cost[]" value="{{ $cost }}" form="buy">
	<input type="hidden" class="qty" name="qty[]" value="{{ $qty }}" form="buy">
	<input type="hidden" class="subtotal" name="subtotal[]" value="{{ $cost * $qty }}" form="buy">
	<td>
		{{ $item->barcode. ' - ' .$item->name}}
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
	<td><button type="button" class="btn btn-sm btn-outline-danger" onclick="removeItem('{{ $item->barcode }}', '{{ $item->name }}')"><i class="fa fa-trash"></i> Hapus</button></td>
</tr>