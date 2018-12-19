{!! Form::model($model, [
	'route' => $model->exists ? ['vendor.update', $model->id] : 'vendor.store',
	'method' => $model->exists ? 'PUT' : 'POST',
]) !!}

	<div class="form-group">
		<label class="control-label">Nama</label>
		{!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama vendor', 'autocomplete' => 'off']) !!}
	</div>
	<div class="form-group">
		<label class="control-label">Alamat</label>
		{!! Form::textArea('address', null, ['rows' => 5, 'class' => 'form-control', 'id' => 'address', 'style' => 'resize:none', 'placeholder' => 'Website, alamat, email, atau link marketplace', 'autocomplete' => 'off']) !!}
	</div>
	<div class="form-group">
		<label class="control-label">No Telepon</label>
		{!! Form::text('phone_number', null, ['class' => 'form-control', 'id' => 'phone_number', 'placeholder' => 'No telepon yang bisa dihubungi', 'autocomplete' => 'off']) !!}
	</div>

{!! Form::close() !!}