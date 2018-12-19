<tr data-barcode="{{ $model->barcode }}" data-qty="{{ $qty }}" data-subtotal="{{ $model->price * $qty }}">
	<td>{{ $model->barcode }}</td>
	<td>{{ $model->name }}</td>
	<td>Rp {{ number_format($model->price) }}</td>
	<td>{{ $qty }}</td>
	<td>Rp {{ number_format($model->price * $qty) }}</td>
</tr>