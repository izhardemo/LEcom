@extends('layouts.admin.app')

@section('title', 'View Product')

@section('content')
<x-breadcrumbs :breadcrumbs="['Product List'=>route('admin.product.index'), 'View Product']" />

<div class="card">
    <div class="card-header border-bottom">
        <h4 class="mb-0">View Product</h4>
        <a href="{{route('admin.product.index')}}" class="btn btn-sm btn-gradient-primary">Back</a>
    </div>
    <div class="card-body mt-2">
        <!-- Category -->
        <div class="mb-1">
            <label for="category" class="form-label fw-bold">{{__('Category')}}</label>
            <input type="text" name="category" value="{{old('category', ucwords($product->category->name))}}" class="form-control" id="name" placeholder="{{__('Name')}}" disabled>
        </div>
        <!-- Name -->
        <div class="mb-1">
            <label for="name" class="form-label fw-bold">{{__('Name')}}</label>
            <input type="text" name="name" value="{{old('name', ucwords($product->name))}}" class="form-control" id="name" placeholder="{{__('Name')}}" disabled>
        </div>
        <!-- Image -->
        <div class="mb-1">
            <label for="image" class="form-label fw-bold">{{__('Image')}}</label>
            @if($product->image)
                <img src="{{asset('storage/'. $product->image)}}" alt="{{asset('storage/'.$product->image)}}" class="img-thumbnail mt-1" style="height: 120px; width:120px;">
            @endif
        </div>
        <!-- Mrp -->
        <div class="mb-1">
            <label for="mrp" class="form-label fw-bold">{{__('Market Price')}}</label>
            <input type="number" name="mrp" value="{{old('mrp', $product->mrp)}}" class="form-control" id="name" placeholder="{{__('Market Price')}}" disabled>
        </div>
        <!-- Price -->
        <div class="mb-1">
            <label for="price" class="form-label fw-bold">{{__('Price')}}</label>
            <input type="number" name="price" value="{{old('price', $product->price)}}" class="form-control" id="name" placeholder="{{__('Price')}}" disabled>
        </div>
        <!-- Description -->
        <div class="mb-1">
            <label for="description" class="form-label fw-bold">{{__('Description')}}</label>
            <textarea name="description" id="description" rows="5" class="form-control" placeholder="{{__('Description')}}" disabled>{{old('description', $product->description)}}</textarea>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('app-assets/js/scripts/forms/form-select2.min.js')}}"></script>
@endpush

@push('js')
<script>
    $(document).ready(function(){

        // variables
        var form = $('#updateproduct');
    
        // jQuery Validation for all forms
        // --------------------------------------------------------------------
        if (form.length) {
            form.each(function () {
                var $this = $(this);
    
                $this.validate({
                    rules: {
                        name: {
                            required: true
                        },
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            });
        }
    });
</script>
@endpush