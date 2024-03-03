<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | E-Shopper</title>
    @include('Fontend.share.css')
    <script src="/frontend/js/jquery.js"></script>


</head><!--/head-->

<body>
    @include('Fontend.share.header')
    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    @include('Fontend.share.footer')
    @include('Fontend.share.js')
    @yield('js')
</body>

</html>
