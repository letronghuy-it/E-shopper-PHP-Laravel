@extends('ADMIN.share.master');
@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <b>Create Blog</b>
                </div>
                <form action="{{ route('add-blog') }}" method="post" enctype="multipart/form-data">
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
                        <div class="form-group">
                            <label class="col-md-12"><b>Title</b></label>
                            <div class="col-md-12 mb-2">
                                <input type="text" name='title' placeholder="Title"
                                    class="form-control form-control-line">
                            </div>
                            <p> @error('title')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </p>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"><b>Image</b></label>
                            <div class="col-md-12 mb-2">
                                <input type="file" name='image' class="form-control form-control-line">
                            </div>
                            <p> @error('image')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </p>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"><b>Description</b></label>
                            <div class="col-md-12 mb-2">
                                <textarea placeholder="Description" id="editor1" class="form-control" name="description" id="demo"></textarea>
                            </div>
                            <p> @error('description')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </p>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"><b>Content</b></label>
                            <div class="col-md-12 mb-2">
                                <textarea placeholder="Content" class="form-control" name="content" id="demo"></textarea>
                            </div>
                            <p> @error('content')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </p>
                        </div>

                    </div>
                    <div class="card-footer " style="float: right">
                        <button class="btn btn-success" type="submit"> Create Blog</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header"><b>List Blog</b></div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center align-middle">
                                <th class="text-center">#</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $key => $value)
                                <tr class="text-center align-middle">
                                    <td class="text-center">{{ $value->id }}</td>
                                    <td class="text-center">{{ $value->title }}</td>
                                    <td class="text-center"><img class="img-fluid" width="50px" height="50px"
                                            src="{{ asset('upload/blog/image/' . $value->image) }}"></td>
                                    <td class="text-center">{{ $value->description }}</td>
                                    <td class="text-center text-nowrap">
                                        <a class="btn btn-info" href="/admin/blog/edit-blog/{{ $value->id }}">Edit</a>
                                        <a class="btn btn-danger"
                                            href="/admin/blog/delete-blog/{{ $value->id }}">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer" style="float: right">
                {{ $blogs->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.log(error);
            });
    </script>
@endsection
