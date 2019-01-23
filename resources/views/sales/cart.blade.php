<tr id="{{ $item->barcode }}">
	<input type="hidden" class="barcode" name="barcode[]" value="{{ $item->barcode }}" form="sale">
	<input type="hidden" class="price" name="price[]" value="{{ $item->price }}" form="sale">
	<input type="hidden" class="qty" name="qty[]" value="{{ $qty }}" form="sale">
	<input type="hidden" class="subtotal" name="subtotal[]" value="{{ $item->price * $qty }}" form="sale">
	<td>
		{{ $item->barcode. ' - ' .$item->name}}
	</td>
	<td class="text-right">
		Rp&nbsp<span class="price">{{ number_format($item->price) }}</span>
	</td>
	<td class="text-right">
		<span class="qty">{{ $qty }}</span>
	</td>
	<td class="text-right">
		Rp&nbsp<span class="subtotal">{{ number_format($item->price * $qty) }}</span>
	</td>
	<td><button type="button" class="btn btn-sm btn-outline-danger" onclick="removeItem('{{ $item->barcode }}', '{{ $item->name }}')"><i class="fa fa-trash"></i> Hapus</button></td>
</tr>