@extends('admin.master')
@section('title')
Settings
@endsection
@section('content')
@include('admin.navbar')
@include('admin.sidebar')
<div class="main-content">
	<section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Settigns</h4>
                  </div>
                  <form method="post" action="{{ route('editSettings') }}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Video Link</label>
                      <div class="col-sm-12 col-md-7">
                        <input name="video" type="text" value="{{$video}}" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Prix Bowl Composé</label>
                      <div class="col-sm-12 col-md-7">
                        <input name="price" type="text" value="{{$price}}" class="form-control">
                      </div>
                    </div>
                    
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button class="btn btn-primary" type="submit">Update Settings</button>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
</div>
@endsection