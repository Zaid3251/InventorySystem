@extends('admin.admin_master')
@section('admin')


<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Product </h4><br><br>
                        <form id="myForm" method="post" action="{{ route('product.store') }}">
                            @csrf
                            <input name="id" type="hidden" value="{{ $product->id }}" class="form-control">
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="form-group col-sm-10">
                                    <input name="name" value="{{ $product->name }}" class="form-control" type="text">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Name</label>
                                <div class="form-group col-sm-10">
                                    <select name="supplier_id" class="form-select" aria-label="Default select example">
                                        <option selected="">-------</option>
                                        @foreach($suppliers as $supp)
                                        <option value="{{ $supp->id }}"  {{ $supp->id == $product->supplier_id ? 'selected' : '' }} >{{ $supp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Category Name</label>
                                <div class="form-group col-sm-10">
                                    <select name="category_id" class="form-select" aria-label="Default select example">
                                        <option selected="">-------</option>
                                        @foreach($categories as $categ)
                                        <option value="{{ $categ->id }}" {{ $categ->id == $product->category_id ? 'selected' : '' }}>{{ $categ->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Unit</label>
                                <div class="form-group col-sm-10">
                                    <select name="unit_id" class="form-select" aria-label="Default select example">
                                        <option selected="">-------</option>
                                        @foreach($units as $unit)
                                        <option value="{{ $unit->id }}"  {{ $unit->id == $product->unit_id ? 'selected' : '' }} >{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="add product">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>
@section('stylejs')
<script type="text/javascript">
$(document).ready(function() {
    $('#myForm').validate({
        rules: {
            name: {
                required: true,
            },
            supplier_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            unit_id: {
                required: true,
            },
        },
        messages: {
            name: {
                required: 'Please Enter Product Name',
            },
            supplier_id: {
                required: 'Please Select One Supplier',
            },
            category_id: {
                required: 'Please Select One Category',
            },
            unit_id: {
                required: 'Please Enter Unit',
            },
        },
        errorElement: 'span',
        errorPalcement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    })
})
</script>

@endsection

@endsection