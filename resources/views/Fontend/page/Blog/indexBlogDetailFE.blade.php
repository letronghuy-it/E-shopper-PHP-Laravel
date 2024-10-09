@extends('Fontend.share.masterFE')
@section('content')
    @include('Fontend.share.menuleft')
    <div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Latest From our Blog</h2>
            <div class="single-blog-post">
                <h3>{{ $blog->title }}</h3>
                <div class="post-meta">
                    <ul>
                        <li><i class="fa fa-user"></i> Mac Doe</li>
                        <li><i class="fa fa-clock-o"></i> {{ $blog->created_at->format('H:i:s') }}</li>
                        <li><i class="fa fa-calendar"></i>{{ $blog->created_at->format('d/m/Y') }}</li>
                    </ul>
                    <!-- <span>
                                                                                                                                    <i class="fa fa-star"></i>
                                                                                                                                    <i class="fa fa-star"></i>
                                                                                                                                    <i class="fa fa-star"></i>
                                                                                                                                    <i class="fa fa-star"></i>
                                                                                                                                    <i class="fa fa-star-half-o"></i>
                                                                                                                                </span> -->
                </div>
                <a href="">
                    <img src="{{ asset('upload/blog/image/' . $blog->image) }}" alt="">
                </a>
                <p>{{ $blog->description }}</p>
                <div class="pager-area">
                    <ul class="pager pull-right">
                        @if ($prev)
                            <li><a href="{{ route('blog.show', $prev->id) }}">Prev</a></li>
                        @endif
                        @if ($next)
                            <li><a href="{{ route('blog.show', $next->id) }}">Next</a></li>
                        @endif
                    </ul>
                </div>

            </div>
        </div><!--/blog-post-area-->

        <div class="rating-area">
            <ul class="ratings">
                <li class="rate-this">Rate this item:</li>
                <div class="rate">
                    <div class="vote">
                        <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                        <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                        <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                        <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                        <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                        <span class="rate-np"></span>
                    </div>
                </div>
            </ul>
            <ul class="tag">
                <li>TAG:</li>
                <li><a class="color" href="">Pink <span>/</span></a></li>
                <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                <li><a class="color" href="">Girls</a></li>
            </ul>
        </div><!--/rating-area-->

        <div class="socials-share">
            <a href=""><img src="images/blog/socials.png" alt=""></a>
        </div><!--/socials-share-->

        <!-- <div class="media commnets">
                                      <a class="pull-left" href="#">
                                          <img class="media-object" src="images/blog/man-one.jpg" alt="">
                                     </a>
                                     <div class="media-body">
                                         <h4 class="media-heading">Annie Davis</h4>
                                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                      <div class="blog-socials">
                                                                                                                <ul>
                                                  <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                                     <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                                  <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                                                   <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                               </ul>
                                             <a class="btn btn-primary" href="">Other Posts</a>
                                           </div>
                                      </div>
                                  </div> --><!--Comments-->
        <div class="response-area">
            <h2>3 RESPONSES</h2>
            <ul class="media-list">
                @foreach ($comments as $key => $comment)
                    @if ($comment['level'] == 0)
                        <li class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" width="100px" height="100px"
                                    src="{{ asset('/upload/user/avatar/' . $comment['avatar']) }}" alt="">
                            </a>
                            <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>{{ $comment['name'] }}</li>
                                    <li><i
                                            class="fa fa-clock-o"></i>{{ \Carbon\Carbon::parse($comment['created_at'])->format('H:i:s') }}
                                    </li>
                                    <li><i class="fa fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($comment['created_at'])->format('d/m/Y') }}</li>
                                </ul>
                                <p>{{ $comment['comment'] }}</p>
                                <a class="btn btn-primary replay" data-id="{{ $comment['id'] }}"><i
                                        class="fa fa-reply"></i>Replay</a>
                            </div>
                        </li>
                    @endif
                    @foreach ($comments as $key => $replay)
                        @if ($replay['level'] == $comment['id'])
                            <li class="media second-media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="{{ asset('upload/user/avatar/' . $replay['avatar']) }}"
                                        alt="">
                                </a>
                                <div class="media-body">
                                    <ul class="sinlge-post-meta">
                                        <li><i class="fa fa-user"></i>{{ $replay['name'] }}</li>
                                        <li><i class="fa fa-clock-o"></i>
                                            {{ \Carbon\Carbon::parse($replay['created_at'])->format('H:i:s') }}</li>
                                        <li><i
                                                class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($replay['created_at'])->format('d/m/Y') }}
                                        </li>
                                    </ul>
                                    <p>{{ $replay['comment'] }}</p>
                                    <a class="btn btn-primary replay" data-id="{{ $replay['id'] }}"><i
                                            class="fa fa-reply"></i>Replay</a>
                                </div>
                            </li>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div><!--/Response-area-->
        <div class="replay-box">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Leave a replay</h2>
                    <div class="text-area">
                        <div class="blank-arrow">
                            <label>Your Name</label>
                        </div>
                        <span>*</span>
                        <textarea name="message" rows="11"></textarea>
                        <a class="btn btn-primary" id="comment">post comment</a>
                    </div>
                </div>
            </div>
        </div><!--/Repaly Box-->
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            GetRating();
            // Cập nhật lại số sao
            function updateStars(averageRate) {
                var fullStars = Math.round(averageRate);
                var hasHalfStar = averageRate % 1 !== 0;

                $('.rate-np').text(averageRate.toFixed(1));
                $('.ratings_stars').removeClass('ratings_over').removeClass('ratings_half');

                for (var i = 1; i <= fullStars; i++) {
                    $('.star_' + i).addClass('ratings_over');
                }

                if (hasHalfStar) {
                    $('.star_' + (fullStars + 1)).addClass('ratings_half');
                }
            }

            function GetRating() {
                // Load Số Đánh giá ban đầu
                var id_blog = "{{ $blog->id }}";
                $.ajax({
                    type: 'GET',
                    url: '{{ url(route('get.rate.blog', $blog->id)) }}',
                    data: {

                        id_blog: id_blog
                    },
                    success: function(data) {
                        updateStars(data.averageRate);
                    }
                });
            }
            // Hover cho ngôi sao
            $('.ratings_stars').hover(
                function() {
                    $(this).prevAll().addBack().addClass('ratings_hover');
                },
                function() {
                    $(this).prevAll().addBack().removeClass('ratings_hover');
                }
            );
            // Click đánh giá sao
            $('.ratings_stars').click(function(e) {
                e.preventDefault();
                var checkLogin = "{{ Auth::Check() }}";
                if (checkLogin) {
                    var rate = $(this).find("input").val();
                    var id_blog = "{{ $blog->id }}";

                    if ($(this).hasClass('ratings_over')) {
                        $('.ratings_stars').removeClass('ratings_over');
                        $(this).prevAll().addBack().addClass('ratings_over');
                    } else {
                        $(this).prevAll().addBack().addClass('ratings_over');
                    }

                    $.ajax({
                        type: 'POST',
                        url: '{{ url(route('rate.blog')) }}',
                        data: {
                            rate: rate,
                            id_blog: id_blog
                        },
                        success: function(data) {
                            updateStars(data.averageRate);
                            console.log('Click : ' + data.averageRate);
                        }
                    });
                } else {
                    alert("Vui lòng đăng nhập để đánh giá.");
                }
            });
            var CommentID = 0;
            $('#comment').click(function(e) {
                e.preventDefault();
                var checkLogin = "{{ Auth::Check() }}";
                if (checkLogin) {
                    var id_blog = "{{ $blog->id }}";
                    var comment = $("textarea").val();
                    var id_comment = CommentID;
                    $.ajax({
                        type: 'POST',
                        url: '{{ url(route('Comment.blog')) }}',
                        data: {
                            comment: comment,
                            id_blog: id_blog,
                            id_comment: id_comment
                        },
                        success: function(res) {
                            console.log(res);
                            var comment = $("textarea").val('');
                            CommentID = null;
                            if (res.data.level == '0') {
                                var html = '';
                                html += '<li class="media">' +
                                    '<a class="pull-left" href="#">' +
                                    '<img class="media-object" width="100px" height="100px" src=" /upload/user/avatar/ ' +
                                    res.data.avatar + '" alt="">' +
                                    '</a>' +
                                    '<div class="media-body">' +
                                    '<ul class="sinlge-post-meta">' +
                                    '<li><i class="fa fa-user"></i>' + res.data.name + '</li>' +
                                    '<li><i class="fa fa-clock-o"></i>' + new Date()
                                    .toLocaleTimeString() + '</li>' +
                                    '<li><i class="fa fa-calendar"></i>' + new Date()
                                    .toLocaleDateString() + '</li>' +
                                    '</ul>' +
                                    '<p>' + res.data.comment + '</p>' +
                                    '<a class="btn btn-primary replay" ><i class="fa fa-reply"></i>Replay</a>' +
                                    '</div>' +
                                    '</li>';
                                $('.media-list').append(html);
                            } else {
                                var Replay = '';
                                Replay += '<li class="media second-media">' +
                                    '<a class="pull-left" href="#">' +
                                    '<img class="media-object" width="100px" height="100px" src=" /upload/user/avatar/ ' +
                                    res.data.avatar + '" alt="">' +
                                    '</a>' +
                                    '<div class="media-body">' +
                                    '<ul class="sinlge-post-meta">' +
                                    '<li><i class="fa fa-user"></i>' + res.data.name + '</li>' +
                                    '<li><i class="fa fa-clock-o"></i>' + new Date()
                                    .toLocaleTimeString() + '</li>' +
                                    '<li><i class="fa fa-calendar"></i>' + new Date()
                                    .toLocaleDateString() + '</li>' +
                                    '</ul>' +
                                    '<p>' + res.data.comment + '</p>' +
                                    '<a class="btn btn-primary replay" ><i class="fa fa-reply"></i>Replay</a>' +
                                    '</div>' +
                                    '</li>';
                                $('.media-list').append(Replay);
                            }

                        }
                    });
                } else {
                    alert("Vui lòng đăng nhập để Comment.");
                }

            })

            $('.replay').click(function(e) {
                var checkLogin = "{{ Auth::Check() }}";
                var id_comment = $(this).data('id');
                if (checkLogin) {
                    CommentID = id_comment;
                    console.log(CommentID);
                } else {
                    alert('Yêu Cầu Login Mới được Bình Luận');
                }
            });
        });
    </script>
@endsection
