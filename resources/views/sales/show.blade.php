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
		@foreach ($saleDetails as $detail)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $detail->good_barcode. ' - ' .$detail->good->name }}</td>
				<td class="text-right">Rp {{ number_format($detail->price) }}</td>
				<td class="text-right">{{ $detail->qty }}</td>
				<td class="text-right">Rp {{ number_format($detail->price * $detail->qty) }}</td>
			</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<th colspan="2">Total</th>
			<th class="text-right">Rp {{ number_format(array_sum(array_column($saleDetails->toArray(), 'price'))) }}</th>
			<th class="text-right">{{ number_format(array_sum(array_column($saleDetails->toArray(), 'qty'))) }}</th>
			<th class="text-right">Rp {{ number_format($saleDetails->first()->sale->total) }}</th>
		</tr>
	</tfoot>
</table>