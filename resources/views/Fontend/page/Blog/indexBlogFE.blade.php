@extends('Fontend.share.masterFE')
@section('content')
    @include('Fontend.share.menuleft')
    <div class="col-sm-9 padding-right">
        <div class="blog-post-area">
            <h2 class="title text-center">Latest From our Blog</h2>
            @foreach ($blog as $key => $value)
                <div class="single-blog-post">
                    <h3>{{$value->title}}</h3>
                    <div class="post-meta">
                        <ul>
                            <li><i class="fa fa-user"></i> Mac Doe</li>
                            <li><i class="fa fa-clock-o"></i> {{($value->created_at)->format('H:i:s') }}</li>
                            <li><i class="fa fa-calendar"></i>{{($value->created_at)->format('d/m/Y') }}</li>
                        </ul>
                        <span>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </span>
                    </div>
                    <a href="">
                        <img src="{{asset('upload/blog/image/'.$value->image)}}" alt="">
                    </a>
                    <p>{{$value->description}}</p>
                    <a class="btn btn-primary" href="/shop/blog/blog-detail/{{$value->id}}">Read More</a>
                </div>
            @endforeach


            <div class="pagination-area">
                <ul class="pagination">
                    <li>{{ $blog->links('pagination::bootstrap-4') }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
