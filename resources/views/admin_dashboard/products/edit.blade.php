@extends('layouts.admin.app')

@section('title', 'Update Product')

@section('content')
<x-breadcrumbs :breadcrumbs="['Product List'=>route('admin.product.index'), 'Update Product']" />

<div class="card">
    <div class="card-header border-bottom">
        <h4 class="mb-0">Update Product</h4>
        <a href="{{route('admin.product.index')}}" class="btn btn-sm btn-gradient-primary">Back</a>
    </div>
    <div class="card-body mt-2">
        <form id="updateproduct" action="{{route('admin.product.update', $product->id)}}" method="post" enctype="multipart/form-data">
            @csrf @method('PUT')
            <!-- Category -->
            <div class="mb-1">
                <label for="category" class="form-label fw-bold">{{__('Category')}}</label>
                <span class="text-danger"> *</span>
                <select name="category" id="category" class="form-control select2" data-msg="{{ __('Please select category') }}">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{ucwords($category->name)}}</option>
                    @endforeach
                </select>
                @error('category')
                    <div class="text-danger small">{{$message}}</div>
                @enderror
            </div>
            <!-- Name -->
            <div class="mb-1">
                <label for="name" class="form-label fw-bold">{{__('Name')}}</label>
                <span class="text-danger"> *</span>
                <input type="text" name="name" value="{{old('name', ucwords($product->name))}}" class="form-control" id="name" placeholder="{{__('Name')}}" data-msg="{{ __('Please enter name') }}">
                @error('name')
                    <div class="text-danger small">{{$message}}</div>
                @enderror
            </div>
            <!-- Image -->
            <div class="mb-1">
                <label for="image" class="form-label fw-bold">{{__('Image')}}</label>
                <input type="file" name="image" class="form-control" id="image">
                @if($product->image)
                    <img src="{{asset('storage/'. $product->image)}}" alt="{{asset('storage/'.$product->image)}}" class="img-thumbnail mt-1" style="height: 120px; width:120px;">
                @endif
            </div>
            <!-- Mrp -->
            <div class="mb-1">
                <label for="mrp" class="form-label fw-bold">{{__('Market Price')}}</label>
                <span class="text-danger"> *</span>
                <input type="number" name="mrp" value="{{old('mrp', $product->mrp)}}" class="form-control" id="name" placeholder="{{__('Market Price')}}" data-msg="{{ __('Please enter market price') }}">
                @error('mrp')
                    <div class="text-danger small">{{$message}}</div>
                @enderror
            </div>
            <!-- Price -->
            <div class="mb-1">
                <label for="price" class="form-label fw-bold">{{__('Price')}}</label>
                <span class="text-danger"> *</span>
                <input type="number" name="price" value="{{old('price', $product->price)}}" class="form-control" id="name" placeholder="{{__('Price')}}" data-msg="{{ __('Please enter price') }}">
                @error('price')
                    <div class="text-danger small">{{$message}}</div>
                @enderror
            </div>
            <!-- Description -->
            <div class="mb-1">
                <label for="description" class="form-label fw-bold">{{__('Description')}}</label>
                <textarea name="description" id="description" rows="5" class="form-control" placeholder="{{__('Description')}}" data-msg="{{ __('Please enter description') }}">{{old('description', $product->description)}}</textarea>
                @error('description')
                    <div class="text-danger small">{{$message}}</div>
                @enderror
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-gradient-primary" form="updateproduct">Save</button>
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