{!! Form::model($model, [
	'route' => $model->exists ? ['vendor.update', $model->id] : 'vendor.store',
	'method' => $model->exists ? 'PUT' : 'POST',
]) !!}

	<div class="form-group">
		<label class="control-label">Nama</label>
		{!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama vendor']) !!}
	</div>
	<div class="form-group">
		<label class="control-label">No Identitas</label>
		{!! Form::text('id_card_number', null, ['class' => 'form-control', 'id' => 'id_card_number', 'placeholder' => 'No identitas (KTP/SIM/Lainnya)']) !!}
	</div>
	<div class="form-group">
		<label class="control-label">Penanggung Jawab</label>
		{!! Form::text('owner', null, ['class' => 'form-control', 'id' => 'owner', 'placeholder' => 'Nama penanggung jawab']) !!}
	</div>
	<div class="form-group">
		<label class="control-label">Alamat</label>
		{!! Form::textArea('address', null, ['rows' => 5, 'class' => 'form-control', 'id' => 'address', 'style' => 'resize:none', 'placeholder' => 'Alamat lengkap pada kartu indentitas']) !!}
	</div>
	<div class="form-group">
		<label class="control-label">No Telepon</label>
		{!! Form::text('phone_number', null, ['class' => 'form-control', 'id' => 'phone_number', 'placeholder' => 'No telepon yang bisa dihubungi']) !!}
	</div>
	<div class="form-group">
		<label class="control-label">Status</label>
		{!! Form::select('status', ['1' => 'Aktif', '0' => 'Tidak Aktif' ], null, ['class' => 'form-control', 'id' => 'status']) !!}
	</div>

{!! Form::close() !!}