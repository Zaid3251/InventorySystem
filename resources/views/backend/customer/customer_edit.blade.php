@extends('admin.admin_master')
@section('admin')


<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Customer </h4><br><br>
                        <form id="myForm" method="post" action="{{ route('customer.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input name="id" type="hidden" value="{{ $customer->id }}" class="form-control">
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="form-group col-sm-10">
                                    <input name="name" value="{{ $customer->name }}" class="form-control" type="text">
                                </div>
                            </div>
                     
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Phone</label>
                                <div class="form-group col-sm-10">
                                    <input name="mobile_no" value="{{ $customer->mobile_no }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Emial</label>
                                <div class="form-group col-sm-10">
                                    <input name="email" value="{{ $customer->email }}" class="form-control" type="email">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                                <div class="form-group col-sm-10">
                                    <input name="address" value="{{ $customer->address }}" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Image</label>
                                <div class="form-group col-sm-10">
                                    <input name="customer_image" class="form-control cls_image" type="file"
                                        id="example-text-input">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg"src="{{ asset($customer->customer_image) }}"
                                        alt="Card image cap" id="showImage">
                                </div>
                            </div>

                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="update customer">
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
            mobile_no: {
                required: true,
            },
            customer_image: {
                required: true,
            },
            email: {
                required: true,
            },
            address: {
                required: true,
            },
        },
        messages: {
            name: {
                required: 'Please Enter Customer Name',
            },
            customer_image: {
                required: 'Please Enter Customer Image',
            },
            mobile_no: {
                required: 'Please Enter Mobile Number',
            },
            email: {
                required: 'Please Enter Email',
            },
            address: {
                required: 'Please Enter Address',
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
$(document).ready(function() {
    $(document).on('change', '.cls_image', function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });

});
</script>

@endsection

@endsection 