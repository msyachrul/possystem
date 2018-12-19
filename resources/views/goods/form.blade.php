{!! Form::model($model, [
	'route' => $model->exists ? ['good.update', $model->id] : 'good.store',
	'method' => $model->exists ? 'PUT' : 'POST',
]) !!}

	<div class="form-group">
		<label class="control-label">Nama</label>
		{!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama barang', 'autocomplete' => 'off']) !!}
	</div>
	<div class="form-row">
		<div class="form-group col-sm">
			<label class="control-label">Kategori</label>
			{!! Form::select('good_category_id', $modelCategories, null, ['class' => 'form-control', 'id' => 'good_category_id', 'placeholder' => 'Pilih kategori', 'autocomplete' => 'off']) !!}
		</div>
		<div class="form-group col-sm">
			<label class="control-label">Vendor</label>
			{!! Form::select('vendor_id', $modelVendors, null, ['class' => 'form-control', 'id' => 'vendor_id', 'placeholder' => 'Pilih vendor', 'autocomplete' => 'off']) !!}
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-sm">
			<label class="control-label">HPP</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				{!! Form::number('cost_of_good', null, ['class' => 'form-control', 'id' => 'cost_of_good', 'placeholder' => 'Harga pokok penjualan', 'autocomplete' => 'off']) !!}
			</div>
		</div>
		<div class="form-group col-sm">
			<label class="control-label">Harga Jual</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				{!! Form::number('price', null, ['class' => 'form-control', 'id' => 'price', 'placeholder' => 'Harga jual', 'autocomplete' => 'off']) !!}
			</div>
		</div>
	</div>

{!! Form::close() !!}