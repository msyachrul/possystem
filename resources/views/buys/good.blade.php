<tr id="{{ $model->barcode }}" data-barcode="{{ $model->barcode }}" data-cost="{{ $model->cost }}" data-qty="{{ $qty }}" data-subtotal="{{ $model->cost * $qty }}">
	<td>{{ $model->barcode }}</td>
	<td>{{ $model->name }}</td>
	<td>Rp {{ number_format($model->cost) }}</td>
	<td id="{{$model->barcode}}qty">{{ $qty }}</td>
	<td id="{{$model->barcode}}subtotal">Rp {{ number_format($model->cost * $qty) }}</td>
</tr>