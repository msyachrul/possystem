<table class="table table-stripped">
	<tr>
		<td>Nama</td>
		<td width="1%">:</td>
		<td>{{ $model->name }}</td>
	</tr>
	<tr>
		<td>No Identitas</td>
		<td>:</td>
		<td>{{ $model->id_card_number }}</td>
	</tr>
	<tr>
		<td>Penanggung Jawab</td>
		<td>:</td>
		<td>{{ $model->owner }}</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td>{{ $model->address }}</td>
	</tr>
	<tr>
		<td>Telepon</td>
		<td>:</td>
		<td>{{ $model->phone_number }}</td>
	</tr>
	<tr>
		<td>Status</td>
		<td>:</td>
		<td>{{ $model->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
	</tr>
</table>