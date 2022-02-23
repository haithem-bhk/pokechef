@extends('admin.master')
@section('title')
Employees
@endsection
@section('content')
@include('admin.navbar')
@include('admin.sidebar')
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="row">
				<div class="col-12 col-sm-6 col-lg-6">
					<div class="card">
						<div class="card-header">
							<h4>Employee 1</h4>
							<div class="card-header-action">
								<a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i
									class="fas fa-minus"></i></a>
							</div>
							</div>
							<div class="collapse show" id="mycard-collapse">
								<div class="card-body">
									You can show or hide this card.
								</div>
								<div class="card-footer">
									Card Footer
								</div>
							</div>
						</div>	
					</div>	
			</div>
			<div class="row">
				<div class="col-12 col-sm-6 col-lg-6">
					<div class="card">
						<div class="card-header">
							<h4>Employee 2</h4>
							<div class="card-header-action">
								<a data-collapse="#ycard-collapse" class="btn btn-icon btn-info" href="#"><i
									class="fas fa-minus"></i></a>
								</div>
							</div>
							<div class="collapse show" id="ycard-collapse">
								<div class="card-body">
									You can show or hide this card.
								</div>
								<div class="card-footer">
									Card Footer
								</div>
							</div>
						</div>	
					</div>	
			</div>
			</div>
		</section>
	</div>
	@endsection