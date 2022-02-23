@extends('admin.master')
@section('title')
Posts List
@endsection
@section('content')
@include('admin.navbar')
@include('admin.sidebar')
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>All Posts</h4>
            </div>
            <div class="card-body">
              <div class="float-left">
                <select class="form-control selectric">
                  <option>Action For Selected</option>
                  <option>Move to Draft</option>
                  <option>Move to Pending</option>
                  <option>Delete Permanently</option>
                </select>
              </div>
              <div class="float-right">
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="clearfix mb-3"></div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <tr>
                    <th class="pt-2">
                      <div class="custom-checkbox custom-checkbox-table custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                        class="custom-control-input" id="checkbox-all">
                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                      </div>
                    </th>

                    <th>Title</th>
                    <th>Ingredients</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Visibility</th>
                    <th>Created At</th>

                  </tr>
                  <tr>
                    @foreach($plates as $plate)
                    <td>
                      <div class="custom-checkbox custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                        id="checkbox-2">
                        <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                      </div>
                    </td>

                    <td>{{$plate->name}}
                      <div class="table-links">
                        <a href="#">View</a>
                        <div class="bullet"></div>
                        <a href="{{ route('editPost',['id'=>$plate->id]) }}">Edit</a>
                        <div class="bullet"></div>
                        @if($plate->visible)
                        <a href="#" id="{{$plate->id}}" class="hide text-warning">Hide</a>
                        @else
                        <a href="#" id="{{$plate->id}}"  class="show text-primary" style="color: #6777ef !important">Show</a>
                        @endif
                        <div class="bullet"></div>
                        <a href="#" id="{{$plate->id}}" class="trash text-danger">Trash</a>
                      </div>
                    </td>
                    <td>
                      @foreach(explode('/', $plate->ingredients) as $ingredient)
                      {{$ingredient}} @if(!$loop->last) - @endif 
                      @endforeach
                    </td>
                    <td><img class="avatar" src="{{route('plateImage', ['imageName' => $plate->image_path ])}}" id="img">

                    </td>
                    <td>€{{$plate->price}}</td>
                    <td>
                      @if($plate->visible)
                      <div class="badge badge-primary">Published</div>

                      @else
                      <div class="badge badge-warning">Hidden</div>
                      @endif
                    </td>
                    <td>{{$plate->created_at->format('Y-m-d')}}</td>

                  </tr>
                  @endforeach

                </table>
              </div>
              <div class="float-right">
                <nav>
                  <ul class="pagination">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item active">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
        {{-- <div class="settingSidebar">
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
        </div> --}}
      </div>

      @endsection
      @section('script')
      <script type="text/javascript">

        $(".hide").click(function(){
          id = this.id;
          console.log(id);
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
           type:'PUT',
           
           url:"{{route('hidePlate')}}",
           data:{
            id:id
            
          },   
        });
          location.reload();
        });
        $(".show").click(function(){
          id = this.id;
          console.log(id);
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
           type:'PUT',
           
           url:"{{route('showPlate')}}",
           data:{
            id:id
            
          },   
        });
          location.reload();
        });

        $(".trash").click(function(){
          id = this.id;
          console.log(id);
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
           type:'DELETE',
           
           url:"{{route('trashPlate')}}",
           data:{
            id:id
            
          },   
        });
         
        });

      </script>
      @endsection