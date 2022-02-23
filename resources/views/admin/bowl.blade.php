@extends('admin.master')
@section('title')
Bowl Composé
@endsection
@section('content')
@include('admin.navbar')
@include('admin.sidebar')
<style type="text/css">
  .row{
    flex-wrap: inherit !important;
  }
</style>
<div class="main-content" >
  <section class="section">
    <div class="section-body">
      <div class="row" x-data="handler()">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">

            <div class="card-header">
              <h4>Bases </h4>
              <div class="col-sm-6 col-md-4">
                <a href="javascript:void(0);"  @click="addNewField(base_field)" class="add_button_alpine" title="Add field"><i class="material-icons">add_circle_outline</i></a>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                
                  
                  <template x-for="(item,index) in base_field">

                    <div class="form-group  row align-items-center mb-4">

                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ingredient</label>
                      <div class="col-sm-6 col-md-4">
                        <input type="text" x-model="item.name" class="form-control" name="ingredients[]">
                      </div>
                      <label>€</label>
                      <div class="col-sm-4 col-md-2">
                        <input type="text" x-model="item.price" class="form-control" name="ingredients[]">
                      </div>
                      
                      
                      
                      
                      
                      <div class="col-sm-6 col-md-4"><a @click="removeField(index,base_field,'base')" href="javascript:void(0);" class="remove_button_alpine"><i class="material-icons">remove_circle_outline</i></a>
                      </div> 
                      
                    </div>

                  </template>

                 
              </div>

            </div>
            <div class="card-footer text-right">
              <button class="btn btn-primary mr-1" @click="addCompose(base_field,'base')">Submit</button>
              
            </div>
            
          </div>

          <div class="card">

            <div class="card-header">
              <h4>Garnitures</h4>
              <div class="col-sm-6 col-md-4">
                <a href="javascript:void(0);" @click="addNewField(garnitures_field)" class="add_button_alpine" title="Add field"><i class="material-icons">add_circle_outline</i></a>
              </div> 
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="field_wrapper">
                  
                  <template x-for="(item,index) in garnitures_field">

                    <div class="form-group  row align-items-center mb-4">

                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ingredient</label>
                      <div class="col-sm-6 col-md-4">
                        <input type="text" x-model="item.name" class="form-control" name="ingredients[]">
                      </div>
                      <label>€</label>
                      <div class="col-sm-4 col-md-2">
                        <input type="text" x-model="item.price" class="form-control" name="ingredients[]">
                      </div>
                      
                      
                      <div class="col-sm-6 col-md-4"><a @click="removeField(index,garnitures_field,'garnitures')" href="javascript:void(0);" class="remove_button_alpine"><i class="material-icons">remove_circle_outline</i></a>
                      </div> 
                      
                    </div>

                  </template>

                </div> 
              </div>

            </div>
            <div class="card-footer text-right">
              <button class="btn btn-primary mr-1" @click="addCompose(garnitures_field,'garnitures')">Submit</button>
              
            </div>
            
          </div>

          <div class="card">

            <div class="card-header">
              <h4>Proteines</h4>
              <div class="col-sm-6 col-md-4">
                <a href="javascript:void(0);" @click="addNewField(proteine_field)" class="add_button_alpine" title="Add field"><i class="material-icons">add_circle_outline</i></a>
              </div> 
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="field_wrapper">
                  
                  <template x-for="(item,index) in proteine_field">

                    <div class="form-group  row align-items-center mb-4">

                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ingredient</label>
                      <div class="col-sm-6 col-md-4">
                        <input type="text" x-model="item.name" class="form-control" name="ingredients[]">
                      </div>
                      <label>€</label>
                      <div class="col-sm-4 col-md-2">
                        <input type="text" x-model="item.price" class="form-control" name="ingredients[]">
                      </div>
                      
                      
                      
                      
                      <div class="col-sm-6 col-md-4"><a @click="removeField(index,proteine_field,'proteines')" href="javascript:void(0);" class="remove_button_alpine"><i class="material-icons">remove_circle_outline</i></a>
                      </div> 
                      
                    </div>

                  </template>

                </div> 
              </div>

            </div>
            <div class="card-footer text-right">
              <button class="btn btn-primary mr-1" @click="addCompose(proteine_field,'proteines')">Submit</button>
              
            </div>
            
          </div>

          
        </div>
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">

            <div class="card-header">
              <h4>Toppings</h4>
              <div class="col-sm-6 col-md-4">
                <a href="javascript:void(0);" @click="addNewField(topping_field)" class="add_button_alpine" title="Add field"><i class="material-icons">add_circle_outline</i></a>
              </div> 
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="field_wrapper">
                  
                  <template x-for="(item,index) in topping_field">

                    <div class="form-group  row align-items-center mb-4">

                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ingredient</label>
                      <div class="col-sm-6 col-md-4">
                        <input type="text" x-model="item.name" class="form-control" name="ingredients[]">
                      </div>
                      <label>€</label>
                      <div class="col-sm-4 col-md-2">
                        <input type="text" x-model="item.price" class="form-control" name="ingredients[]">
                      </div>
                      
                      
                      
                      
                      <div class="col-sm-6 col-md-4"><a @click="removeField(index,topping_field,'toppings')" href="javascript:void(0);" class="remove_button_alpine"><i class="material-icons">remove_circle_outline</i></a>
                      </div> 
                      
                    </div>

                  </template>

                </div> 
              </div>

            </div>
            <div class="card-footer text-right">
              <button class="btn btn-primary mr-1" @click="addCompose(topping_field,'toppings')">Submit</button>
              
            </div>
            
          </div>

          <div class="card">

            <div class="card-header">
              <h4>Sauce</h4>
              <div class="col-sm-6 col-md-4">
                <a href="javascript:void(0);" @click="addNewField(sauce_field)" class="add_button_alpine" title="Add field"><i class="material-icons">add_circle_outline</i></a>
              </div> 
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="field_wrapper">
                  
                  <template x-for="(item,index) in sauce_field">

                    <div class="form-group  row align-items-center mb-4">

                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ingredient</label>
                      <div class="col-sm-6 col-md-4">
                        <input type="text" x-model="item.name" class="form-control" name="ingredients[]">
                      </div>
                      <label>€</label>
                      <div class="col-sm-4 col-md-2">
                        <input type="text" x-model="item.price" class="form-control" name="ingredients[]">
                      </div>
                      
                      
                      
                      
                      <div class="col-sm-6 col-md-4"><a @click="removeField(index,sauce_field,'sauce')" href="javascript:void(0);" class="remove_button_alpine"><i class="material-icons">remove_circle_outline</i></a>
                      </div> 
                      
                    </div>

                  </template>

                </div> 
              </div>

            </div>
            <div class="card-footer text-right">
              <button class="btn btn-primary mr-1" @click="addCompose(sauce_field,'sauce')">Submit</button>
              
            </div>
            
          </div>
        </div>

      </div>
    </div>
  </section>

</div>

@endsection

