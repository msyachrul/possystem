<table class="table table-stripped">
	<thead>
		<tr>
			<th width="1%">#</th>
			<th>Barang</th>
			<th class="text-right">Harga</th>
			<th width="5%" class="text-right">Qty</th>
			<th class="text-right">Total</th>
		</tr>
	</thead>
	<tbody>
		@php $no=1 @endphp
		@foreach ($buyDetails as $detail)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $detail->good_barcode. ' - ' .$detail->good->name }}</td>
				<td class="text-right">Rp {{ number_format($detail->cost) }}</td>
				<td class="text-right">{{ $detail->qty }}</td>
				<td class="text-right">Rp {{ number_format($detail->cost * $detail->qty) }}</td>
			</tr>
		@endforeach
	</tbody>
</table>