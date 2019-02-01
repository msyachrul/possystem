<table class="table table-stripped">
	<tr>
		<td width="15%">Barcode</td>
		<td width="1%">:</td>
		<td>{{ $model->barcode }}</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td>{{ $model->name }}</td>
	</tr>
	<tr>
		<td>Kategori</td>
		<td>:</td>
		<td>{{ $model->goodCategory->name }}</td>
	</tr>
	<tr>
		<td>Qty</td>
		<td>:</td>
		<td>{{ $model->qty }}</td>
	</tr>
	<tr>
		<td>HPP</td>
		<td>:</td>
		<td>Rp {{ number_format($model->cost) }}</td>
	</tr>
	<tr>
		<td>Harga Jual</td>
		<td>:</td>
		<td>Rp {{ number_format($model->price) }}</td>
	</tr>
</table>