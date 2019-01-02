@extends('templates.app')

@push('title','Dashboard')

@section('content')
	<div class="row">
		<div class="col-lg">
			<a href="{{ route('buy.index') }}">
				<div class="card text-primary">
					<div class="card-body">
						<h6 class="card-title"><i class="fa fa-cart-plus"></i> Pembelian {{ date('F Y') }}</h6>
						<h4 class="card-text">Rp {{ number_format($model['buy']) }}</h4>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg">
			<a href="{{ route('sale.index') }}">
				<div class="card text-success">
					<div class="card-body">
						<h6 class="card-title"><i class="fa fa-shopping-cart"></i> Penjualan {{ date('F Y') }}</h6>
						<h4 class="card-text">Rp {{ number_format($model['sale']) }}</h4>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg">
			<a href="{{ route('good.index') }}">
				<div class="card">
					<div class="card-body">
						<h6 class="card-title"><i class="fa fa-shopping-bag"></i> Total Stock</h6>
						<h4 class="card-text">{{ number_format($model['stock']) }} pcs</h4>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg">
			<a href="{{ route('transaction.index') }}">
				<div class="card text-danger">
					<div class="card-body">
						<h6 class="card-title"><i class="fa fa-suitcase"></i> Keuntungan {{ date('F Y') }}</h6>
						<h4 class="card-text">Rp {{ number_format($model['profit']) }}</h4>
					</div>
				</div>
			</a>
		</div>
	</div>
@endsection