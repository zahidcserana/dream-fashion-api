<?php

use App\Model\SubSubCategory;
use App\Model\SubCategory;

?>

@extends('layouts.master')
@section('include_js')
    @parent
    <script>
    </script>
@endsection
@section('content')
    <!-- BEGIN: Subheader -->
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    Product's Sub Sub Category
                                </h3>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                @endif
                <!--begin::Form-->
                    <form class="m-form" name="color-form" method="POST" action="{{route('sub-sub-category')}}">
                        {{ csrf_field() }}
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <input type="hidden" name="id" value="{{$sub_sub_category->id or ''}}">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-1 col-form-label">
                                        Category:
                                    </label>
                                    <div class="col-lg-2">
                                        <select class="form-control m-input m-input--air"
                                                id="category_id" name="category_id"
                                                onchange="getSubCategory(this.value)">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $row)
                                                <option {{empty($sub_sub_category->category_id)==true?"":$sub_sub_category->category_id==$row->id?'selected':""}} value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-1 col-form-label" id="sub_cat_lebel"
                                            {!!$sub_sub_category_id==0?'style="display: none;"':''!!}
                                            >
                                        Sub Category:
                                    </label>
                                    <div class="col-lg-2" id="sub_cat_list" {!!$sub_sub_category_id==0?'style="display: none;"':''!!}>
                                        <select class="form-control m-input m-input--air"
                                                id="sub_category_id" name="sub_category_id">
                                            @foreach($sub_categories as $row)
                                                <option {{empty($sub_sub_category->sub_category_id)==true?"":$sub_sub_category->sub_category_id==$row->id?'selected':""}} value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-1 col-form-label">
                                        Name:
                                    </label>
                                    <div class="col-lg-2">
                                        <input type="text" name="name" class="form-control m-input"
                                               value="{{$sub_sub_category->name or ''}}"
                                               placeholder="Enter size name">
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="submit" class="btn btn-success">
                                            Submit
                                        </button>
                                    </div>
                                    <div class="col-lg-1">
                                        <a href="{{route('sub-sub-category')}}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div style="float: left" class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Sub Sub Category List
                                </h3>
                            </div>
                            <div style="float: right;padding-top: 1%;">
                                <a class="btn btn-primary" href="{{route('add-product')}}">Add New Product</a>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Section-->
                        <div class="m-section">
                            <div class="m-section__content">
                                <table class="table m-table m-table--head-bg-success">
                                    <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Category
                                        </th>
                                        <th>
                                            Sub Category
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Created
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sub_sub_categories as $row)
                                        <tr>
                                            <th scope="row">
                                                {{$row->id}}
                                            </th>
                                            <td>
                                                {{\App\Model\SubSubCategory::find($row->id)->category->name}}
                                            </td>
                                            <td>
                                                {{\App\Model\SubSubCategory::find($row->id)->subCategory->name}}
                                            </td>
                                            <td>
                                                {{$row->name}}
                                            </td>
                                            <td>
                                                {{$row->status==1?'Active':'Inactive'}}
                                            </td>
                                            <td>
                                                {{$row->created_at}}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-brand dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="true">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                         style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item"
                                                           href="{{url('/sub-sub-category',$row->id)}}">Edit</a>
                                                        <a class="dropdown-item"
                                                           href="{{url('/sub-sub-category-delete',$row->id)}}">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>

@endsection