<option>-- Pilih Barang --</option>
@foreach ($goods as $good)
	<option value="{{ $good->barcode }}">{{ $good->name }}</option>
@endforeach