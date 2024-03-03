@extends('ADMIN.share.master')
@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                <b>ADD Brand</b>
                </div>
                <form action="/admin/brand/add-brand" method="post">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible"
                            style="position: fixed; bottom:0; right: 0; z-index: 9999;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="col-md-12 mb-2">
                            <input type="text" name='brand' placeholder="Brand"
                                class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-success" type="submit">Add Brand</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-8">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center align-middle">
                        <th class="text-center">ID</th>
                        <th class="text-center">Brand</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($brand))
                        @foreach ($brand as $key => $value)
                            <tr class="text-center align-middle">
                                <th class="text-center">{{ $key + 1 }}</th>
                                <th class="text-center">{{ $value->brand }}</th>
                                <th class="text-center text-nowrap">
                                    <a class="btn btn-primary"
                                        href="/admin/brand/edit-brand/{{ $value->id }}"><b>Edit</b></a>
                                    <a class="btn btn-danger"
                                        href="/admin/brand/delete-brand/{{ $value->id }}"><b>Remove</b></a>
                                </th>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
