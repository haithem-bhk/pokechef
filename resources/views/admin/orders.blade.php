@extends('admin.master')
@section('title')
Food Orders
@endsection
@section('content')
@include('admin.navbar')
@include('admin.sidebar')
<div class="main-content">
        <section class="section">
          <div class="section-body" x-data="getOrders()">
           
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Orders</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" >
                        <thead>
                          <tr>
                            {{-- <th class="text-center pt-3">
                              <div class="custom-checkbox custom-checkbox-table custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                  class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                              </div>
                            </th> --}}
                            <th>#</th>
                            <th colspan="4">Order</th>
                            <th>Total</th>
                            <th>Pick up Time</th>
                            <th>Status</th>
                            <th>Complete</th>
                            <th>Incomplete</th>

                          </tr>
                          <tr>
                            <td></td>
                            <td>Name</td>
                            <td>Ingredients (Bowl Composé)</td>
                            <td>Supplements (Bowl Composé)</td>
                            <td>Quantity</td>

                          </tr>
                        </thead>
                        <tbody>

                          <template x-for="(item,index) in orders">
                          <tr>
                            {{-- <td class="text-center pt-2">
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                  id="checkbox-1">
                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                              </div>
                            </td> --}}
                            <td x-text="item.id">
                              
                            </td>
                            <td>
                              <template x-for="(itm,idx) in JSON.parse(item.cart_content)">
                                <div x-text="itm.name"> </div>
                              </template>
                            </td>
                            <td>
                              <template x-for="(itm,idx) in JSON.parse(item.cart_content)">
                                <template x-if="itm.options.type === 'compose'">
                                  <div>
                                    <div x-text="itm.options.ingredient.base"></div>
                                    <div x-text="itm.options.ingredient.topping"></div>
                                    <div x-text="itm.options.ingredient.proteine"></div>
                                    <div x-text="itm.options.ingredient.garniture"></div>
                                    <div x-text="itm.options.ingredient.sauce"></div>
                                  </div>
                                </template>
                              </template>
                            </td>
                            <td>
                              <template x-for="(itm,idx) in JSON.parse(item.cart_content)">
                                <template x-if="itm.options.type === 'compose'">
                                  <template x-for = "(supp,key) in itm.options.supplement">
                                    <div x-text="supp"></div>
                                  </template>
                                  {{-- <div>
                                    <div x-text="itm.options.supplement.base"></div>
                                    <div x-text="itm.options.supplement.topping"></div>
                                    <div x-text="itm.options.supplement.proteine"></div>
                                    <div x-text="itm.options.supplement.garniture"></div>
                                    <div x-text="itm.options.supplement.sauce"></div>
                                  </div> --}}
                                </template>
                              </template>
                            </td>
                            <td>
                              <template x-for="(itm,idx) in JSON.parse(item.cart_content)">
                                <div x-text="itm.qty"> </div>
                              </template>
                            </td>
                            <td x-text="item.total">
                              
                            </td>
                            <td x-text="item.pickup_time">
                              
                            </td>
                            <td>
                              <div class="badge badge-warning badge-shadow" x-text="item.status"></div>
                            </td>
                            <td><a href="#" @click="updateOrder(item.id,'complete')" class="btn btn-primary">Complete</a></td>
                            <td><a href="#" @click="updateOrder(item.id,'incomplete')" class="btn btn-danger">Incomplete</a></td>
                          </tr>
                          </template>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </section>
        
      </div>
@endsection






{{-- 
<template x-for="(itm,idx) in JSON.parse(item.cart_content)">
                            
                              <div style="display: flex;  justify-content: left; text-align: left;">
                                <span style="color:#e7b00c;">Name :</span> 
                                <span style="padding-left: 3px;padding-right: 3px; " x-text="itm.name"></span>
                                 -
                                 <span style="color:#e7b00c;">Quantity:</span>
                               <span style="padding-left: 3px;padding-right: 3px; " x-text="itm.qty"></span>
                            </div>
                            </template> --}}