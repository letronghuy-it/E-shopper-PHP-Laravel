@extends('ADMIN.share.master')
@section('content')
    <div class="row">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    Update Brand
                </div>
                <form action="/admin/brand/update" method="post">
                    @csrf
                    <div class="card-body">
                        <label for="label" class="mb-2"><b>Brand</b></label>
                        <input value="{{$brand->id}}" name="id" type="hidden" class="form-control mt-2" id="exampleInputEmail1"
                        placeholder="Nhập Mã ">
                        <div class="mb-1">
                            <input type="text" name='brand' value="{{ $brand->brand }}"
                                class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
