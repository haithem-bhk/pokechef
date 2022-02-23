@extends('admin.master')
@section('title')
Edit Legume
@endsection
@section('content')
@include('admin.navbar')
@include('admin.sidebar')
<style type="text/css">
  .preview {
    background: #6777ef;
    /*border-radius: 55%; */
    color: #e3eaef; 
    display: inline-block; 
    font-size: 16px; 
    font-weight: 300; 
    margin: 0; 
    position: relative; 
    vertical-align: middle; 
    line-height: 1.28; 
    height: 100%;
    width: 100%;
  }
</style>
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit {{$legume->name}}</h4>
            </div>
            <form method="post" action="{{ route('editLegume',['id' => $legume->id]) }}" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                  <div class="col-sm-12 col-md-7">
                    <input name="name" type="text" value="{{$legume->name}}" class="form-control">
                  </div>
                </div>
                <div class="field_wrapper">

                  @foreach(explode('/',$legume->ingredients) as $ingredient)
                  <div class="row form-group align-items-center">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ingredient</label>
                    <div class="col-sm-6 col-md-2">
                      <input type="text" class="form-control" name="ingredients[]" value="{{$ingredient}}"/>
                      <a href="javascript:void(0);" class="remove_button">
                      </div>
                      @if($loop->first)
                      <div class="col-sm-6 col-md-2">
                          <a href="javascript:void(0);" class="add_button" title="Add field"><i class="material-icons">add_circle_outline</i></a>
                        </div>
                      @else
                      <div class="col-sm-6 col-md-2"><i class="material-icons">remove_circle_outline</i></a></div>
                      @endif
                    </div>
                  @endforeach
                </div>  
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                  <div class="col-sm-12 col-md-7">
                    <div id="image-preview" class="image-preview">
                      <img class="preview"   src="{{route('legumeImage', ['imageName' => $legume->image_path ])}}" id="img">
                      <label for="image-upload" id="image-label">Choose File</label>
                      <input type="file" name="image" id="image-upload" />
                    </div>
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                  <div class="col-sm-12 col-md-7">
                    <textarea name="description"  class="summernote-simple">{{$legume->description}}</textarea>
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                  <div class="col-sm-5 col-md-2">
                    <input type="text" name="price" class="form-control" value="{{$legume->price}}">
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Visible</label>
                  <div class="col-sm-12 col-md-7">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="visible" id="exampleRadios1" @if($legume->visible) checked @endif value="1">
                      <label class="form-check-label" for="exampleRadios1">
                        Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="visible" id="exampleRadios2" @if(!$legume->visible) checked @endif value="0">
                      <label class="form-check-label" for="exampleRadios2">
                        No
                      </label>
                    </div>
                  </div>

                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button class="btn btn-primary" type="submit">Edit Plate</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="settingSidebar">
    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
    </a>
    <div class="settingSidebar-body ps-container ps-theme-default">
      <div class=" fade show active">
        <div class="setting-panel-header">Setting Panel
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Select Layout</h6>
          <div class="selectgroup layout-color w-50">
            <label class="selectgroup-item">
              <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
              <span class="selectgroup-button">Light</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
              <span class="selectgroup-button">Dark</span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Sidebar Color</h6>
          <div class="selectgroup selectgroup-pills sidebar-color">
            <label class="selectgroup-item">
              <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
              <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
              data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
              <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
              data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Color Theme</h6>
          <div class="theme-setting-options">
            <ul class="choose-theme list-unstyled mb-0">
              <li title="white" class="active">
                <div class="white"></div>
              </li>
              <li title="cyan">
                <div class="cyan"></div>
              </li>
              <li title="black">
                <div class="black"></div>
              </li>
              <li title="purple">
                <div class="purple"></div>
              </li>
              <li title="orange">
                <div class="orange"></div>
              </li>
              <li title="green">
                <div class="green"></div>
              </li>
              <li title="red">
                <div class="red"></div>
              </li>
            </ul>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <div class="theme-setting-options">
            <label class="m-b-0">
              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
              id="mini_sidebar_setting">
              <span class="custom-switch-indicator"></span>
              <span class="control-label p-l-10">Mini Sidebar</span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <div class="theme-setting-options">
            <label class="m-b-0">
              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
              id="sticky_header_setting">
              <span class="custom-switch-indicator"></span>
              <span class="control-label p-l-10">Sticky Header</span>
            </label>
          </div>
        </div>
        <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
          <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
            <i class="fas fa-undo"></i> Restore Default
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

