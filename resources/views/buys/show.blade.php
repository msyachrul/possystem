<table class="table table-bordered">
	<thead>
		<tr>
			<th width="1%">#</th>
			<th>Barcode</th>
			<th>Harga</th>
			<th width="5%">Qty</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		@php $no=1 @endphp
		@foreach ($buyDetails as $detail)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $detail->good_barcode }}</td>
				<td>Rp {{ number_format($detail->cost) }}</td>
				<td>{{ $detail->qty }}</td>
				<td>Rp {{ number_format($detail->cost * $detail->qty) }}</td>
			</tr>
		@endforeach
	</tbody>
</table>