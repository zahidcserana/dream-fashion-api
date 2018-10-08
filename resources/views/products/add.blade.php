@extends('layouts.master')
@section('include_js')
    @parent
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/cropper/cropper.min.js') }}"></script>
    <script src="{{ asset('assets/cropper/cropper.css') }}"></script>
    <style>
        img {
            max-width: 100%;
        }
    </style>
    <script>
        $(document).ready(function(){
            var cropper;
            var div2Width;
            var imageWidth;
            $("#change_picture").click(function()
            {
                $( "#imageFile" ).click();
            });
            $("#picture_change").click(function()
            {
                $( "#imageFile" ).click();
            });
            $( "#imageFile" ).change(function()
            {
                console.log('cropper created');
                var _URL = window.URL || window.webkitURL;
                img = new Image();
                img.onerror = function() { alert('Please chose an image file!'); };
                img.onload = function () {
                    var imageWidth = this.width;
                    $('#base_image').attr('src',this.src); // for no apply cropper
                    $("#save").show();
                };
                img.src = _URL.createObjectURL(this.files[0]);
            });

            $( "#save" ).click(function()
            {
                $(".progress").show();
                var product_id = $("#product_id").val();
                var img = document.getElementById('imageFile');
                var CSRF_TOKEN = "{{ csrf_token() }}";
                var data = new FormData();
                data.append('file', img.files[0]);
                data.append('product_id', product_id);
                data.append('_token', CSRF_TOKEN);
                var Url = "{{route('product_image')}}";

                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress',function(ev){
                    var progress = parseInt(ev.loaded / ev.total * 100);
                    $('#progressBar').css('width', progress + '%');
                    $('#progressBar').html(progress + '%');
                }, false);
                xhr.onreadystatechange = function(ev)
                {
                    console.log(xhr.readyState);
                    if(xhr.readyState == 4){
                        if(xhr.status = '200')
                        {
                            $("#imageCropped").hide();
                            $(".progress").hide();
                            $("#save").hide();
                            $('#progressBar').css('width','0' + '%');
                            $('#progressBar').html('0' + '%');
                            location.reload();
                        }

                    }
                };
                xhr.open('POST', Url , true);
                xhr.send(data);
                return false;
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(document.body).delegate('#sub_category_id', 'change', function () {
                var id = $(this).val();
                $.ajax({
                    url: '/get-sub-sub-cat-by-sub-cat',
                    type: 'GET',
                    data: {sub_category: id},
                    success: function (response) {
                        //alert(response);
                        //var parsed = $.parseJSON(response);
                        $("#sub_sub_cat_lebel").show();
                        $("#sub_sub_cat_list").show();
                        $("#sub_sub_cat_list").html(response);
                    }
                });
            });
            $(document.body).delegate('.make-feature', 'click', function () {
                var imgButton = event.target.id.split("-");
                var image_id = imgButton[0];
                var product_id = imgButton[1];
                $.ajax({
                    url: '/image-feature',
                    type: 'GET',
                    data: {product_id: product_id, image_id: image_id },
                    success: function (response) {
                        console.log('Successfully updated.')
                    }
                });
            });
        });
    </script>
@endsection
<?php if (!empty($product)) { ?>
@section('side_bar')
    @include('products.side_bar')
@endsection
<?php } ?>
@section('content')
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Product Details
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{route('products')}}" class="m-nav__link">
											<span class="m-nav__link-text">
												Products
											</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{'add-product'}}" class="m-nav__link">
											<span class="m-nav__link-text">
												New
											</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
                     data-dropdown-toggle="hover" aria-expanded="true">
                    <a href="#"
                       class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                        <i class="la la-plus m--hide"></i>
                        <i class="la la-ellipsis-h"></i>
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav">
                                        <li class="m-nav__section m-nav__section--first m--hide">
															<span class="m-nav__section-text">
																Quick Actions
															</span>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                <span class="m-nav__link-text">
																	Activity
																</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                <span class="m-nav__link-text">
																	Messages
																</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                <span class="m-nav__link-text">
																	FAQ
																</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                <span class="m-nav__link-text">
																	Support
																</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                        <li class="m-nav__item">
                                            <a href="#"
                                               class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                Submit
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                    Product's basic
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="m-form" name="product-form" method="POST" action="{{route('add-product')}}">
                        {{ csrf_field() }}
                        <div class="m-portlet__body">
                            <input type="hidden" name="id" id="product_id" value="{{$product->id or ''}}">
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Name:
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control m-input" name="name"
                                               placeholder="Enter product name" value="{{$product->name or ''}}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Brand:
                                    </label>
                                    <div class="col-lg-8">
                                        <select class="form-control m-input m-input--air"
                                                id="brand_id" name="brand_id">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $row)
                                                <option {{empty($product->brand_id)==true?"":$product->brand_id==$row->id?'selected':""}} value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Description:
                                    </label>
                                    <div class="col-lg-8">
                                        <textarea name="description" class="form-control md-input"
                                                  data-provide="markdown" rows="10" style="resize: none;"
                                                  aria-describedby="markdown-error" aria-invalid="false">
                                            {{$product->description or ''}}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group m-form__group row">
                                            <label class="col-lg-4 col-form-label">
                                                Color:
                                            </label>
                                            <div class="col-lg-6">
                                                <?php
                                                $colorArr = empty($product->color) == true ? null : json_decode($product->color);
                                                ?>
                                                <select multiple="" class="form-control m-input m-input--air"
                                                        id="color" name="color[]">
                                                    @foreach($colors as $row)
                                                        <option {{empty($product->color)==true?null:(in_array($row->id, $colorArr)==true?'selected':"")}} value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group m-form__group row">
                                            <label class="col-lg-2 col-form-label">
                                                Size:
                                            </label>
                                            <div class="col-lg-6">
                                                <?php
                                                $sizeArr = empty($product->size) == true ? null : json_decode($product->size);
                                                ?>
                                                <select multiple="" class="form-control m-input m-input--air"
                                                        id="size" name="size[]">
                                                    @foreach($sizes as $row)
                                                        <option {{empty($product->size)==true?null:(in_array($row->id, $sizeArr)==true?'selected':"")}} value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                <option {{empty($product->category_id)==true?"":$product->category_id==$row->id?'selected':""}} value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-1 col-form-label" id="sub_cat_lebel"
                                            {!!$product==null?'style="display: none;"':''!!}
                                    >
                                        Sub Category:
                                    </label>
                                    <div class="col-lg-2"
                                         id="sub_cat_list" {!!$product==null?'style="display: none;"':''!!}>
                                        <select class="form-control m-input m-input--air"
                                                id="sub_category_id" name="sub_category_id">
                                            <option value="">Select One</option>
                                            @foreach($sub_categories as $row)
                                                <option {{empty($product->sub_category_id)==true?"":$product->sub_category_id==$row->id?'selected':""}} value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-1 col-form-label" id="sub_sub_cat_lebel"
                                            {!!$product==null?'style="display: none;"':''!!}
                                    >
                                        Sub Sub Category:
                                    </label>
                                    <div class="col-lg-2"
                                         id="sub_sub_cat_list" {!!$product==null?'style="display: none;"':''!!}>
                                        <select class="form-control m-input m-input--air"
                                                id="sub_sub_category_id" name="sub_sub_category_id">
                                            <option value="">Select One</option>
                                            @foreach($sub_sub_categories as $row)
                                                <option {{empty($product->sub_sub_category_id)==true?"":$product->sub_sub_category_id==$row->id?'selected':""}} value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-success">
                                            Submit
                                        </button>
                                        <a class="btn btn-secondary" href="{{route('products')}}">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>

@endsection