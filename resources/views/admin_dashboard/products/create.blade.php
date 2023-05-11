@extends('layouts.admin.app')

@section('title', 'Create Product')

@section('content')
<x-breadcrumbs :breadcrumbs="['product List'=>route('admin.product.index'), 'Add New Product']" />

<div class="card">
    <div class="card-header border-bottom">
        <h4 class="mb-0">Add New Product</h4>
        <a href="{{route('admin.product.index')}}" class="btn btn-sm btn-gradient-primary">Back</a>
    </div>
    <div class="card-body mt-2">
        <form id="addproduct" action="{{route('admin.product.store')}}" method="post">
            @csrf
            <!-- Category -->
            <div class="mb-1">
                <label for="category" class="form-label fw-bold">{{__('Category')}}</label>
                <span class="text-danger"> *</span>
                <select name="category" id="category" class="form-control select2" data-msg="{{ __('Please select category') }}">
                    <option value="" selected disabled>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{ucwords($category->name)}}</option>
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
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="{{__('Name')}}" data-msg="{{ __('Please enter name') }}">
                @error('name')
                    <div class="text-danger small">{{$message}}</div>
                @enderror
            </div>
            <!-- Image -->
            <div class="mb-1">
                <label for="image" class="form-label fw-bold">{{__('Image')}}</label>
                <span class="text-danger"> *</span>
                <input type="file" name="image" class="form-control" id="image">
                @error('image')
                    <div class="text-danger small">{{$message}}</div>
                @enderror
            </div>
            <!-- Mrp -->
            <div class="mb-1">
                <label for="mrp" class="form-label fw-bold">{{__('Market Price')}}</label>
                <span class="text-danger"> *</span>
                <input type="number" name="mrp" value="{{old('mrp')}}" class="form-control" id="name" placeholder="{{__('Market Price')}}" data-msg="{{ __('Please enter market price') }}">
                @error('mrp')
                    <div class="text-danger small">{{$message}}</div>
                @enderror
            </div>
            <!-- Price -->
            <div class="mb-1">
                <label for="price" class="form-label fw-bold">{{__('Price')}}</label>
                <span class="text-danger"> *</span>
                <input type="number" name="price" value="{{old('price')}}" class="form-control" id="name" placeholder="{{__('Price')}}" data-msg="{{ __('Please enter price') }}">
                @error('price')
                    <div class="text-danger small">{{$message}}</div>
                @enderror
            </div>
            <!-- Description -->
            <div class="mb-1">
                <label for="description" class="form-label fw-bold">{{__('Description')}}</label>
                <textarea name="description" id="description" rows="5" class="form-control" placeholder="{{__('Description')}}" data-msg="{{ __('Please enter description') }}">{{old('description')}}</textarea>
                @error('description')
                    <div class="text-danger small">{{$message}}</div>
                @enderror
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-gradient-primary" form="addproduct">Submit</button>
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
        var form = $('#addproduct');
    
        // jQuery Validation for all forms
        // --------------------------------------------------------------------
        if (form.length) {
            form.each(function () {
                var $this = $(this);
    
                $this.validate({
                    rules: {
                        category: {
                            required: true
                        },
                        name: {
                            required: true
                        },
                        mrp: {
                            required: true
                        },
                        price: {
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