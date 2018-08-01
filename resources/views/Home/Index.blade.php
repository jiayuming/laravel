<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $Setting->title }}首页</title>
    <link rel="stylesheet" href="{{ URL::asset('public/Home/Default/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/Home/Default/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/Home/Default/vendors/owl-carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/Home/Default/vendors/magnific-popup/magnific-popup.css') }}">

    <link href="{{ URL::asset('public/Home/Default/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/Home/Default/css/theme/green.css') }}" rel="stylesheet">

    <!--==========[if lt IE 9]>
    <script src="{{ URL::asset('public/Home/Default/js/html5shiv.min.js') }}"></script>
    <script src="{{ URL::asset('public/Home/Default/js/respond.min.js') }}"></script>
    <![endif]==========-->
</head>
<body class="home">

<header class="row transparent black header1" data-spy="affix" data-offset-top="0" id="header">
    <div class="container">
        <div class="row top-header">
            <div class="col-sm-4 search-form-col">
                <form action="#" method="get" class="search-form">
                    <div class="input-group">
                        <span class="input-group-addon"><img src="{{ URL::asset('public/Home/Default/images/search-icon-white.png') }}" alt=""></span>
                        <input type="search" class="form-control" placeholder="搜索">
                    </div>
                </form>
            </div>
            <div class="col-sm-4 logo-col text-center">
                <a href="index.html"><img src="{{ URL::asset('public/Home/Default/images/logo-white-green.png') }}" width="36" alt="logo"></a>
            </div>
            <div class="col-sm-4 menu-trigger-col">
                <button class="menu-trigger pull-right">
                    <img src="{{ URL::asset('public/Home/Default/images/menu-align-white.png') }}" alt="" class="icon-burger">
                    <img src="{{ URL::asset('public/Home/Default/images/menu-close-white.png') }}" alt="" class="icon-cross">
                </button>
            </div>
        </div>
    </div>
    <div class="row menu-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 menu-col">
                    <div class="row">
                        {!! getMenus() !!}
                    </div>
                </div>
                <div class="col-sm-4 subscribe-col">
                    <h5 class="widget-title">subscribe to our newsletter.</h5>
                    <form action="#" method="post" class="form-inline subscribe-form">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><span>send</span></button>
                    </form>
                    <ul class="nav social-nav dark">
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="row featured-post-carousel">
    <div class="item post">
        <img src="{{ URL::asset('public/Home/Default/images/featured-posts/1.jpg' )}}" alt="" class="img-responsive main-bg">
        <div class="post-content">
            <div class="container">
                <h5 class="post-meta"><i>in</i> <a href="#">Author Profile</a> | <a href="#">feb 17, 2016</a></h5>
                <h2 class="post-title"><a href="single.html">Nature, in the broadest sense, is the natural, physical, or material world or universe.</a></h2>
                <a href="single.html" class="btn btn-primary"><span>read more</span></a>
            </div>
        </div>
    </div>
    <div class="item post">
        <img src="{{ URL::asset('public/Home/Default/images/featured-posts/1-1.jpg' )}}" alt="" class="img-responsive main-bg">
        <div class="post-content">
            <div class="container">
                <h5 class="post-meta"><i>in</i> <a href="#">Author Profile</a> | <a href="#">feb 17, 2016</a></h5>
                <h2 class="post-title"><a href="single.html">Nature, in the broadest sense, is the natural, physical, or material world or universe.</a></h2>
                <a href="single.html" class="btn btn-primary"><span>read more</span></a>
            </div>
        </div>
    </div>
    <div class="item post">
        <img src="{{ URL::asset('public/Home/Default/images/featured-posts/1-2.jpg' )}}" alt="" class="img-responsive main-bg">
        <div class="post-content">
            <div class="container">
                <h5 class="post-meta"><i>in</i> <a href="#">Author Profile</a> | <a href="#">feb 17, 2016</a></h5>
                <h2 class="post-title"><a href="single.html">Nature, in the broadest sense, is the natural, physical, or material world or universe.</a></h2>
                <a href="single.html" class="btn btn-primary"><span>read more</span></a>
            </div>
        </div>
    </div>
</section>

<section class="row content-wrap">
    <div class="container">
        <div class="row" id="post-masonry">
            @foreach(getPages(1,10) as $list)
                <article class="col-sm-4 post post-masonry post-format-image">
                    <div class="post-wrapper row">
                        <div class="featured-content row">
                            <a href="single.html">
                                @if($list->uploadpic == NULL)
                                    <img src="{{ asset('public/images/default.jpg') }}" alt="" class="img-responsive">
                                @else
                                    <img src="{{ $list->uploadpic}}" alt="" class="img-responsive">
                                @endif
                            </a>
                        </div>
                        <div class="post-excerpt row">
                            <h5 class="post-meta">
                                <a href="#" class="date">{{ getPostTime($list->create_time) }}</a>
                                <span class="post-author"><i>by</i><a href="#">{{ $list->author }}</a></span>
                            </h5>
                            <h3 class="post-title"><a href="single.html">{{ $list->title }}</a></h3>
                            <p>{{ $list->describe }}</p>
                            <footer class="row">
                                <h5 class="taxonomy"><i class="fa fa-eye"></i> {{ $list->click_num }}</h5>
                            </footer>
                        </div>
                    </div>
                </article>
            @endforeach

            <!--Blog Post-->
            {{--<article class="col-sm-4 post post-masonry post-format-gallery">--}}
                {{--<div class="post-wrapper row">--}}
                    {{--<div class="featured-content row">--}}
                        {{--<div class="gallery-of-post">--}}
                            {{--<div class="item"><img src="images/posts/masonry/3.jpg" alt=""></div>--}}
                            {{--<div class="item"><img src="images/posts/masonry/3.jpg" alt=""></div>--}}
                            {{--<div class="item"><img src="images/posts/masonry/3.jpg" alt=""></div>--}}
                            {{--<div class="item"><img src="images/posts/masonry/3.jpg" alt=""></div>--}}
                            {{--<div class="item"><img src="images/posts/masonry/3.jpg" alt=""></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="post-excerpt row">--}}
                        {{--<h5 class="post-meta">--}}
                            {{--<a href="#" class="date">feb 17, 2016</a>--}}
                            {{--<span class="post-author"><i>by</i><a href="#">Mark Sanders</a></span>--}}
                        {{--</h5>--}}
                        {{--<h3 class="post-title"><a href="single.html">Nature, in the broadest sense, is the natural, physical, or material world or universe.</a></h3>--}}
                        {{--<p>In the broadest sense, is the natural, physical, or material world or universe...</p>--}}
                        {{--<footer class="row">--}}
                            {{--<h5 class="taxonomy"><i>in</i> <a href="#">image</a>, <a href="#">entertainment</a></h5>--}}
                            {{--<div class="response-count"><img src="images/comment-icon-gray.png" alt="">5</div>--}}
                        {{--</footer>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</article>--}}
            <!--Twitter Widget-->
            <aside class="col-sm-4 widget widget-twitter widget-with-posts post">
                <div class="widget-twitter-inner">
                    <h5 class="widget-meta"><i class="fa fa-twitter"></i>Twitter feed</h5>
                    <div class="row tweet-texts">
                        <p>Check out new post on my blog</p>
                    </div>
                    <div class="row timepast">1 day ago</div>
                </div>
            </aside>
            <!--Blog Post-->
            <article class="col-sm-4 post post-masonry post-format-quote">
                <div class="post-wrapper row">
                    <div class="post-excerpt row">
                        <h5 class="post-meta">
                            <a href="#" class="date">feb 17, 2016</a>
                            <span class="post-author"><i>by</i><a href="#">Mark Sanders</a></span>
                        </h5>
                        <h3 class="post-title">If everybody learns this simple art of loving his work, whatever it is, enjoying it without asking for any recognition, we would have more beautiful and celebrating world.</h3>
                        <h5 class="quote-maker"><a href="#">osho</a></h5>
                        <footer class="row">
                            <h5 class="taxonomy"><i>in</i> <a href="#">quote</a>, <a href="#">life</a></h5>
                            <div class="response-count"><img src="images/comment-icon-white.png" alt="">5</div>
                        </footer>
                    </div>
                </div>
            </article>
            <!--Twitter Widget-->
            <aside class="col-sm-4 widget widget-instagram widget-with-posts post">
                <div class="widget-instagram-inner">
                    <h5 class="widget-meta"><i class="fa fa-twitter"></i>instagram feed chivalricblog</h5>
                    <div id="instafeed"></div>
                </div>
            </aside>
        </div>
    </div>
</section>

<!--Footer-->
<footer class="row" id="footer">
    <div class="container">
        <div class="row top-footer">
            <div class="widget col-sm-3 widget-about">
                <div class="row m0"><a href="index.html"><img src="images/logo-black-green.png" alt=""></a></div>
            </div>
            <div class="widget col-sm-5 widget-menu">
                <div class="row">
                    <ul class="nav column-menu white-bg">
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="single.html">Blog Single 1</a></li>
                        <li><a href="single2.html">Blog Single 2</a></li>
                    </ul>
                    <ul class="nav column-menu white-bg">
                        <li><a href="single3.html">Blog Single 3</a></li>

                        <li><a href="contact.html">contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="widget col-sm-4 widget-subscribe">
                <h5 class="widget-title">subscribe to our newsletter.</h5>
                <form action="#" method="post" class="form-inline subscribe-form">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm"><span>send</span></button>
                </form>
            </div>
        </div>
        <h5 class="copyright">{!! $Setting->site_copyright !!}&nbsp;&nbsp;copyright：{{ $Setting->site_icp }}</h5>
    </div>
</footer>

<!--========== jQuery (necessary for Bootstrap's JavaScript plugins) ==========-->
<script src="{{ URL::asset('public/Home/Default/js/jquery-2.2.0.min.js') }}"></script>
<script src="{{ URL::asset('public/Home/Default/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('public/Home/Default/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ URL::asset('public/Home/Default/vendors/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ URL::asset('public/Home/Default/vendors/instafeed/instafeed.min.js') }}"></script>
<script src="{{ URL::asset('public/Home/Default/vendors/imagesLoaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('public/Home/Default/vendors/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('public/Home/Default/js/theme.js') }}"></script>
</body>
</html>
