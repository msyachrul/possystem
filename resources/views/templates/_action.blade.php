<div class="btn-group">
	<button class="btn btn-outline-primary btn-sm modal-show show" data-href="{{ $url_show }}" data-title="{{ $model->name }}"><i class="fa fa-eye"></i></button>
	&nbsp
	<button class="btn btn-outline-success btn-sm modal-show edit" data-href="{{ $url_edit }}" data-title="Edit {{ $model->name }}"><i class="fa fa-edit"></i></button>
	&nbsp
	<button class="btn btn-outline-danger btn-sm btn-destroy" data-href="{{ $url_destroy }}" data-title="{{ $model->name }}"><i class="fa fa-trash"></i></button>
</div>