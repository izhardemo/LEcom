@extends('layouts.admin.app')

@section('title', 'Product List')

@section('content')
<section class="app-user-list">
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="product-list-table table">
                <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- list and filter end -->
</section>
@endsection

@push('style-link')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')}}">
@endpush

@push('script')
<script src="{{asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/jszip.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')}}"></script>
@endpush

@push('js')
<script>
    var $url = "{{route('admin.product.index')}}";

    $(function () {
    ('use strict');
    
    var dtUserTable = $('.product-list-table');

        // Users List datatable
        if (dtUserTable.length) {
            dtUserTable.DataTable({
                processing: true,
                ajax: $url,
                // serverSide: true,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'All'],
                ],
                columns: [
                    { data: '' },
                    { data: 'category' },
                    { data: 'name' },
                    { data: 'price' },
                    { data: '' }
                ],
                columnDefs: [
                    {
                        // For Responsive
                        className: 'control',
                        orderable: false,
                        responsivePriority: 2,
                        targets: 0,
                        render: function (data, type, row, meta) {
                            return '';
                        }
                    },
                    {
                        targets: 1,
                        responsivePriority: 4,
                        render: function (data, type, row, meta) {
                            var $category = row['category'];
                            return $category;
                        }
                    },
                    {
                        targets: 2,
                        responsivePriority: 4,
                        render: function (data, type, row, meta) {
                            var $name = row['name'];
                            return $name;
                        }
                    },
                    {
                        targets: 3,
                        responsivePriority: 4,
                        render: function (data, type, row, meta) {
                            var $price = row['price'];
                            return $price;
                        }
                    },
                    {
                        // Actions
                        targets: -1,
                        title: 'Actions',
                        orderable: false,
                        render: function (data, type, row, meta) {
                            let $viewUrl = "{{route('admin.product.show',[':id'])}}";
                            $viewUrl = $viewUrl.replace(':id',row['id']);
                            let $editUrl = "{{route('admin.product.edit',[':id'])}}";
                            $editUrl = $editUrl.replace(':id',row['id']);
                            let $deleteUrl = "{{route('admin.product.destroy',[':id'])}}";
                            $deleteUrl = $deleteUrl.replace(':id',row['id']);
                            $csrfToken = "{{csrf_token()}}";
                            return (
                            "<a href="+$viewUrl+" class='btn btn-sm btn-icon'>" +
                            feather.icons['eye'].toSvg({ class: 'font-medium-2 text-body' }) +
                            "</i></a>" +
                            "<a href="+$editUrl+" class='btn btn-sm btn-icon'>" +
                            feather.icons['edit'].toSvg({ class: 'font-medium-2 text-body' }) +
                            "</i></a>" +
                            '<button onclick="deleteConfirm(event)" class="btn btn-sm btn-icon delete-record"><form action='+$deleteUrl+' method="post" class="d-none"><input type="hidden" name="_token" value='+$csrfToken+'><input type="hidden" name="_method" value="DELETE"></form>' +
                            feather.icons['trash'].toSvg({ class: 'font-medium-2 text-body' }) +
                            '</button>'
                            );
                        }
                    }
                ],
                dom:
                    "<'card card-datatable table-responsive pt-0'<'card-body'<'header border-bottom row pb-1 pb-lg-2'<'col-12 col-md-4 d-flex flex-column justify-content-center align-items-center align-items-md-start'<'heading'><'sub-heading'>><'col-12 col-md-8 d-flex justify-content-end align-items-start'B>><'row mb-1'<'col-12 col-sm-4 d-flex justify-content-center justify-content-sm-start'l><'col-12 col-sm-8 d-flex justify-content-center justify-content-sm-end'f>>t><'card-footer d-flex flex-column flex-sm-row justify-content-center justify-content-sm-between align-items-center py-0'ip>>",
                language: {
                    sLengthMenu: 'Show _MENU_',
                    search: 'Search',
                    searchPlaceholder: 'Search..'
                },
                // Buttons with Dropdown
                buttons: [
                    {
                        extend: 'collection',
                        className: 'btn btn-sm btn-gradient-secondary round dropdown-toggle me-2',
                        text: feather.icons['external-link'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
                        buttons: [
                            {
                                extend: 'print',
                                text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                                className: 'dropdown-item',
                                exportOptions: { columns: [1, 2, 3, 4, 5] }
                            },
                            {
                                extend: 'csv',
                                text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                                className: 'dropdown-item',
                                exportOptions: { columns: [1, 2, 3, 4, 5] }
                            },
                            {
                                extend: 'excel',
                                text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                                className: 'dropdown-item',
                                exportOptions: { columns: [1, 2, 3, 4, 5] }
                            },
                            {
                                extend: 'pdf',
                                text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                                className: 'dropdown-item',
                                exportOptions: { columns: [1, 2, 3, 4, 5] }
                            },
                            {
                                extend: 'copy',
                                text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                                className: 'dropdown-item',
                                exportOptions: { columns: [1, 2, 3, 4, 5] }
                            }
                        ],
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                            $(node).parent().removeClass('btn-group');
                            setTimeout(function () {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex mt-50');
                            }, 50);
                        }
                    },
                    {
                        text: 'Add New Product',
                        className: 'btn btn-sm btn-gradient-primary round',
                        action: function ( e, dt, button, config ) {
                            window.location = '{{route("admin.product.create")}}';
                        }
                    }
                ],
                language: {
                    paginate: {
                        previous: '&nbsp;',
                        next: '&nbsp;',
                        first: '&laquo;',
                        last: '&raquo;',
                    },
                },
            });
        }

        $(".heading").html('<h4 class="mb-2 mb-md-0 fw-bolder">Product List</h4>');
    });
</script>
@endpush