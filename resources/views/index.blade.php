@extends('templates.app')

@push('title','Dashboard')

@section('content')
	<div class="row">
		<div class="col-lg-3 col-6 mb-3">
			<a href="{{ route('report.stock') }}">
				<div class="card">
					<div class="card-body">
						<h6 class="card-title"><i class="fa fa-shopping-bag"></i> Total Persediaan</h6>
						<h4 class="card-text">{{ number_format($model['stock']) }} pcs</h4>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-3 col-6 mb-3">
			<a href="{{ route('report.buy') }}">
				<div class="card text-primary">
					<div class="card-body">
						<h6 class="card-title"><i class="fa fa-cart-plus"></i> Pembelian</h6>
						<h4 class="card-text">Rp {{ number_format($model['buy']) }}</h4>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-3 col-6 mb-3">
			<a href="{{ route('report.sale') }}">
				<div class="card text-success">
					<div class="card-body">
						<h6 class="card-title"><i class="fa fa-shopping-cart"></i> Penjualan</h6>
						<h4 class="card-text">Rp {{ number_format($model['sale']) }}</h4>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-3 col-6 mb-3">
			<a href="{{ route('report.transaction') }}">
				<div class="card text-danger">
					<div class="card-body">
						<h6 class="card-title"><i class="fa fa-suitcase"></i> Keuntungan</h6>
						<h4 class="card-text">Rp {{ number_format($model['profit']) }}</h4>
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 mb-3">
			<div class="card">
				<div class="card-body">
					{!! $chartBuy->container() !!}
				</div>
			</div>
		</div>
		<div class="col-lg-12 mb-3">
			<div class="card">
				<div class="card-body">
					{!! $chartSale->container() !!}
				</div>
			</div>
		</div>
		<div class="col-lg-12 mb-3">
			<div class="card">
				<div class="card-body">
					{!! $chartProfit->container() !!}
				</div>
			</div>
		</div>
		<div class="col-lg-6 mb-3">
			<div class="card">
				<div class="card-body">
					{!! $chartSaleGood->container() !!}
				</div>
			</div>
		</div>
		<div class="col-lg-6 mb-3">
			<div class="card">
				<div class="card-body">
					{!! $chartProfitGood->container() !!}
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	{!! $chartBuy->script() !!}
	{!! $chartSale->script() !!}
	{!! $chartProfit->script() !!}
	{!! $chartSaleGood->script() !!}
	{!! $chartProfitGood->script() !!}
@endpush