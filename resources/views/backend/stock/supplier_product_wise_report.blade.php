@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Supplier and Product Wise Report</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">


                        <div class="row">
                            <div class="col-md-12 text-center">
                                <strong> Supplier Wise Report</strong>
                                <input type="radio" name="supplier_product_wise" value="supplier_wise"
                                    class="search_value">&nbsp;&nbsp;

                                <strong> Product Wise Report</strong>
                                <input type="radio" name="supplier_product_wise" value="product_wise"
                                    class="search_value">
                            </div>

                        </div> <!--  //end row -->


                        <div class="show_supplier" style="display:none;">
                            <form method="GET" action="{{ route('supplier.wise.pdf') }}" target="_blank" id="myForm">
                                <div class="row">
                                    <div class="col-sm-8 form-group">
                                        <label>Supplier Name</label>
                                        <select name="supplier_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option value="">-------</option>
                                            @foreach($suppliers as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4" style="padding-top:28px;">
                                        <button type="submit" class="btn btn-primary">Search </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="show_product" style="display:none;">
                            <form method="GET" action="{{ route('product.wise.pdf') }}" target="_blank" id="myForm">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="md-3">
                                            <label for="example-text-input" class="col-form-label">Category Name</label>
                                            <select id="category_id" name="category_id" class="form-select select2"
                                                aria-label="Default select example">
                                                <option selected="">-------</option>
                                                @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="md-3">
                                            <label for="example-text-input" class="col-form-label">Product Name</label>
                                            <select id="product_id" name="product_id" class="form-select select2"
                                                aria-label="Default select example">
                                                <option selected="">-------</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4" style="padding-top:28px;">
                                        <button type="submit" class="btn btn-primary">Search </button>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>
@section('stylejs')
<script type="text/javascript">
$(document).ready(function() {


    $(document).on('change', '.search_value', function() {
        var search_value = $(this).val();
        if (search_value == 'supplier_wise') {
            $('.show_supplier').show();
            $('.show_product').hide();
        } else {
            $('.show_supplier').hide();
            $('.show_product').show();
        }
    });

    $(document).on('change', '#category_id', function() {
        var category_id = $("#category_id").val();
        $.ajax({
            url: "{{ route('get-product') }}",
            type: "GET",
            data: {
                category_id: category_id
            },
            success: function(data) {
                var html = '<option value="">Select product </option>';
                $.each(data, function(key, v) {
                    html += '<option value=" ' + v.id + ' ">' + v.name + '</option>'
                });
                $('#product_id').html(html);


            }
        })
    });

    $('#myForm').validate({
        rules: {

            supplier_id: {
                required: true,
            },
        },
        messages: {

            supplier_id: {
                required: 'Please Select One Supplier',
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