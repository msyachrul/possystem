{!! Form::model($model, [
	'route' => $model->exists ? ['good_category.update', $model->id] : 'good_category.store',
	'method' => $model->exists ? 'PUT' : 'POST',
]) !!}

	<div class="form-group">
		<label class="control-label">Nama</label>
		{!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama kategori']) !!}
	</div>	

{!! Form::close() !!}