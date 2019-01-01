<table class="table table-stripped">
	<thead>
		<tr>
			<th width="1%">#</th>
			<th>Barang</th>
			<th width="5%" class="text-right">Qty</th>
			<th class="text-right">Sub HPP</th>
			<th class="text-right">Sub Total</th>
			<th class="text-right">Profit</th>
		</tr>
	</thead>
	<tbody>
		@php $no=1 @endphp
		@foreach ($transactionDetails as $detail)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $detail->barcode. ' - ' .$detail->good->name }}</td>
				<td class="text-right">{{ $detail->qty }}</td>
				<td class="text-right">Rp {{ number_format($detail->total_hpp) }}</td>
				<td class="text-right">Rp {{ number_format($detail->total_price) }}</td>
				<td class="text-right">Rp {{ number_format($detail->profit) }}</td>
			</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<th colspan="2">Total</th>
			<th class="text-right">{{ array_sum(array_column($transactionDetails->toArray(), 'qty')) }}</th>
			<th class="text-right">Rp {{ number_format(array_sum(array_column($transactionDetails->toArray(), 'total_hpp'))) }}</th>
			<th class="text-right">Rp {{ number_format(array_sum(array_column($transactionDetails->toArray(), 'total_price'))) }}</th>
			<th class="text-right">Rp {{ number_format(array_sum(array_column($transactionDetails->toArray(), 'profit'))) }}</th>
		</tr>
	</tfoot>
</table>