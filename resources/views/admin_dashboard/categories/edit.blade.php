@extends('layouts.admin.app')

@section('title', 'Update Category')

@section('content')
<x-breadcrumbs :breadcrumbs="['Category List'=>route('admin.category.index'), 'Update Category']" />

<div class="card">
    <div class="card-header border-bottom">
        <h4 class="mb-0">Update Category</h4>
        <a href="{{route('admin.category.index')}}" class="btn btn-sm btn-gradient-primary">Back</a>
    </div>
    <div class="card-body mt-2">
        <form id="updateCategory" action="{{route('admin.category.update', $category->id)}}" method="post">
            @csrf @method('PUT')
            <!-- Name -->
            <div class="mb-1">
                <label for="name" class="form-label fw-bold">{{__('Name')}}</label>
                <span class="text-danger"> *</span>
                <input type="text" name="name" value="{{old('name', ucwords($category->name))}}" class="form-control" id="name" placeholder="{{__('Name')}}" data-msg="{{ __('Please enter name') }}">
                @error('name')
                    <div class="text-danger small">{{$message}}</div>
                @enderror
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-gradient-primary" form="updateCategory">Save</button>
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
        var form = $('#updateCategory');
    
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