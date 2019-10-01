@extends('layouts.admin')
@section('content')
<div class="card">
	<div class="card-header"><b>Data Statistik</b></div>

	<div class="card-body">
		<div class="row" >
		<div class="col-lg-3 col-6">
			<div class="small-box bg-danger">
				<div class="inner">
					<h3>200</h3>
					<p>Data Buku</p>
				</div>
				<div class="icon">
					<i class="fas fa-book"></i>
				</div>
				<a href="{{route('admin.buku.index')}}" class="small-box-footer">More Info
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-info">
				<div class="inner">
					<h3>200</h3>
					<p>Data Pengunjung</p>
				</div>
				<div class="icon">
					<i class="fas fa-users"></i>
				</div>
				<a href="#" class="small-box-footer">More Info
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-success">
				<div class="inner">
					<h3>200</h3>
					<p>Data Anggota</p>
				</div>
				<div class="icon">
					<i class="fas fa-user"></i>
				</div>
				<a href="#" class="small-box-footer">More Info
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		</div>
	</div>

	<div class="card-header"><b>Statistik Kategori Buku</b></div>

	<div class="card-body">
		<div class="row" >
		<div class="col-lg-3 col-6">
			<div class="small-box bg-info">
				<div class="inner">
					<h3>200</h3>
					<p>Sastra</p>
				</div>
				<div class="icon">
					<i class="fas fa-book"></i>
				</div>
				<a href="{{route('admin.buku.index')}}" class="small-box-footer">More Info
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-success">
				<div class="inner">
					<h3>200</h3>
					<p>Bahasa</p>
				</div>
				<div class="icon">
					<i class="fas fa-book-open"></i>
				</div>
				<a href="#" class="small-box-footer">More Info
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-warning">
				<div class="inner">
					<h3>200</h3>
					<p>Filsafat</p>
				</div>
				<div class="icon">
					<i class="fas fa-book"></i>
				</div>
				<a href="#" class="small-box-footer">More Info
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<div class="small-box bg-danger">
				<div class="inner">
					<h3>200</h3>
					<p>Agama</p>
				</div>
				<div class="icon">
					<i class="fas fa-book-open"></i>
				</div>
				<a href="#" class="small-box-footer">More Info
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
@parent
@endsection