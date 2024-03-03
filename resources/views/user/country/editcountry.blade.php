@extends('ADMIN.share.master')
@section('content')
    <div class="row">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    Update Country
                </div>
                <form action="/admin/country/update" method="post">
                    @csrf
                    <div class="card-body">
                        <label for="label" class="mb-2"><b>Title</b></label>
                        <input value="{{$country->id}}" name="id" type="hidden" class="form-control mt-2" id="exampleInputEmail1"
                        placeholder="Nhập Mã ">
                        <div class="mb-1">
                            <input type="text" name='title' value="{{ $country->title }}"
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
