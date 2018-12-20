<div class="btn-group">
	@if (isset($url_show))
		<button class="btn btn-outline-primary btn-sm modal-show show" data-href="{{ $url_show }}" data-title="{{ $model }}"><i class="fa fa-eye"></i></button>
	@endif
	@if (isset($url_edit))
	&nbsp
	<button class="btn btn-outline-success btn-sm modal-show edit" data-href="{{ $url_edit }}" data-title="Edit {{ $model }}"><i class="fa fa-edit"></i></button>
	@endif
	@if (isset($url_destroy))
	&nbsp
	<button class="btn btn-outline-danger btn-sm btn-destroy" data-href="{{ $url_destroy }}" data-title="{{ $model }}"><i class="fa fa-trash"></i></button>
	@endif
</div>