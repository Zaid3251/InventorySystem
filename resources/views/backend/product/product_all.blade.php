@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Product Data</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('product.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light"
                            style="float: right;">add product</a><br><br>
                        <h4 class="card-title">All Product</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Supplier Name</th>
                                    <th>Unit</th>
                                    <th>Category</th>
                                    <th>Action</th>

                                </tr>
                            </thead>


                            <tbody>
                                @foreach($products as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item['supplier']['name'] }}</td>
                                    <td>{{ $item['unit']['name'] }}</td>
                                    <td>{{ $item['category']['name'] }}</td>
                                    <td>
                                        <a href="{{ route('product.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data">
                                            <i class="ri-edit-2-line"></i>

                                        </a>
                                        <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger sm" id="delete" title="Delete">
                                            <i class="ri-delete-bin-6-fill"></i>
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->


@endsection