@extends('ADMIN.share.master')
@section('content')
    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <b>Update Blog</b>
                </div>
                <form  method="post" enctype="multipart/form-data" action="{{ route('update-blog') }}">
                    @csrf
                    <div class="card-body">
                        <input class="form-control form-control-line" name="id" hidden value="{{$blog->id}}">
                        <div class="form-group">
                            <label class="col-md-12"><b>Title</b></label>
                            <div class="col-md-12 mb-2">
                                <input type="text" name='title' placeholder="Title"
                                    class="form-control form-control-line" value="{{$blog->title}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"><b>Image</b></label>
                            <div class="col-md-12 mb-2">
                                <input type="file" name='image' class="form-control form-control-line" >
                                <img src="{{asset('upload/blog/image/'.$blog->image)}}" class="img-fluid" width="100px" height="100px"  alt="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"><b>Description</b></label>
                            <div class="col-md-12 mb-2">
                                <textarea placeholder="Description" class="form-control" value="{{$blog->description}}" name="description" id="demo"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"><b>Content</b></label>
                            <div class="col-md-12 mb-2">
                                <textarea placeholder="Content" class="form-control" name="content"  value="{{$blog->content}}"  id="demo"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer " style="float: right">
                        <button class="btn btn-success" type="submit"> Update Blog</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
