@extends('layout')
@section('content')

<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <div class="yoast_breadcrumb hidden-xs"><span><span><a href="danhmuc.php"></a> <span><a
                                        href="{{route('danhmuc',$movie->category->slug)}}">{{$movie->category->title}}</a>
                                    » <span class="breadcrumb_last"
                                        aria-current="page">{{$movie->title}}</span></span></span></span></div>
                </div>
            </div>
        </div>
        <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
            <div class="ajax"></div>
        </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        <section id="content" class="test">
            <div class="clearfix wrap-content">

                <div class="halim-movie-wrapper">
                    <div class="title-block">
                        <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                            <div class="halim-pulse-ring"></div>
                        </div>
                        <div class="title-wrapper" style="font-weight: bold;">
                            Bookmark
                        </div>
                    </div>
                    <div class="movie_info col-xs-12">
                        <div class="movie-poster col-md-3">
                            <img class="movie-thumb" src="{{asset('uploads/movie/'.$movie->img)}}"
                                alt="{{$movie->title}}">

                            @if($movie->resolution != 4 && isset($episode_first->episode))

                            <div class="bwa-content">
                                <div class="loader"></div>

                                <a href="{{route('xemphim',['slug' => $movie->slug, 'tap' => $episode_first->episode])}}"
                                    class="bwac-btn">
                                    <i class="fa fa-play"></i>
                                </a>
                            </div>
                            <!-- <a href="{{route('xemphim',['slug' => $movie->slug, 'tap' => $episode_first->episode])}}"
                                class="btn btn-primary watch-trailer" style="display: block;">Xem
                                Phim</a> -->
                            <a href="{{route('xemphim',['slug' => $movie->slug, 'tap' => $episode_first->episode])}}"
                                class="btn btn-primary" style="display: block;">Xem Phim

                            </a>

                            @elseif($movie->trailer != null)
                            <a href="#watch_trailer" class="btn btn-primary watch-trailer" style="display: block;">Xem
                                Trailer</a>

                            @endif

                        </div>
                        <div class="film-poster col-md-9">
                            <h1 class="movie-title title-1"
                                style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">
                                {{$movie->title}}</h1>
                            <h2 class="movie-title title-2" style="font-size: 12px;">{{$movie->name_eng}}</h2>
                            <ul class="list-info-group">
                                <li class="list-info-group-item"><span>Trạng Thái</span> :
                                    @if($movie->resolution == 0)
                                    <span class="episode">HD</span>
                                    @elseif($movie->resolution == 1)
                                    <span class="episode">SD</span>

                                    @elseif($movie->resolution == 2)
                                    <span class="episode">HDCam</span>

                                    @elseif($movie->resolution == 3)
                                    <span class="episode">FullHD</span>
                                    @elseif($movie->resolution == 4)
                                    <span class="episode">Trailer</span>
                                    @endif
                                    <span class="episode">
                                        @if($movie->cc == 0)
                                        Thuyết Minh
                                        @elseif($movie->cc == 1)
                                        VietSub
                                        @endif
                                    </span>

                                </li>

                                </li>
                                @if($movie->session != 0)
                                <li class="list-info-group-item"><span>Session</span> : {{$movie->session}}</li>

                                @endif
                                <li class="list-info-group-item"><span>Thời lượng</span> : {{$movie->time}}</li>
                                @if($movie->thuocphim == 0)
                                <li class="list-info-group-item"><span>Tập</span> : {{$episode_list}} / {{$movie->tap}}
                                </li>
                                @endif
                                <li class="list-info-group-item"><span>Thể loại</span> :
                                    @foreach ($list_movie_genre as $key => $list_movie_genre)
                                    <a href="{{route('theloai', $list_movie_genre->slug)}}"
                                        rel="category tag">{{$list_movie_genre->title}}</a>
                                    @endforeach
                                </li>
                                <li class="list-info-group-item"><span>Quốc gia</span> : <a
                                        href="{{route('quocgia', $movie->country->slug)}}"
                                        rel="tag">{{$movie->country->title}}</a>
                                </li>
                                <li class="list-info-group-item"><span>Danh mục</span> : <a
                                        href="{{route('danhmuc', $movie->category->slug)}}"
                                        rel="tag">{{$movie->category->title}}</a>
                                </li>
                                @if($movie->thuocphim == 0)
                                <li class="list-info-group-item"><span>Phim mới cập nhập</span> :
                                    @foreach($episode as $key => $epi)
                                    <a href="{{route('xemphim', ['slug' => $epi->movie->slug,'tap' => $epi->episode ])}}"
                                        rel="tag">Tập
                                        {{$epi->episode}}</a>
                                    @endforeach
                                </li>
                                @endif
                                <!-- <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director"
                                        rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland"
                                        title="Cate Shortland">Cate Shortland</a></li>
                                <li class="list-info-group-item last-item"
                                    style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;">
                                    <span>Diễn viên</span> : <a href="" rel="nofollow" title="C.C. Smiff">C.C.
                                        Smiff</a>
                                </li> -->
                                <li class="list-info-group-item"><span>Đánh giá: {{$rating}} sao / {{$count_total}}
                                        lượt</span>

                                </li>
                                <ul class="list-inline" style="float: left;" title="Average Rating">

                                    <?php for($count=1; $count<=5; $count++){
                                        if($count<=$rating){
                                            $color='color:#ffcc00;' ; }
                                        else { 
                                            $color='color:#ccc;';
                                        }
                                    ?>

                                    <li title="star_rating" id="{{$movie->id}}-{{$count}}" data-index="{{$count}}"
                                        data-movie_id="{{$movie->id}}" data-rating="{{$rating}}" class="rating" style="cursor:pointer; {{$color}} 
                                        font-size:30px;">&#9733;</li>
                                    <?php }?>

                                </ul>


                            </ul>
                            <div class="movie-trailer hidden"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div id="halim_trailer"></div>
                <div class="clearfix"></div>
                <div class="section-bar clearfix">
                    <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                </div>
                <div class="entry-content htmlwrap clearfix">
                    <div class="video-item halim-entry-box">
                        <article id="post-38424" class="item-content">
                            Phim <a href="">{{$movie->title}}</a>
                            <p>{{$movie->des}}</p>

                        </article>
                    </div>
                </div>
                <!-- Tags phim -->
                <div class="section-bar clearfix">
                    <h2 class="section-title"><span style="color:#ffed4d">Tags phim</span></h2>
                </div>
                <div class="entry-content htmlwrap clearfix">
                    <div class="video-item halim-entry-box">
                        <article id="post-38424" class="item-content">
                            @if ($movie->tag)
                            @php
                            $tag = array();
                            $tag = explode(',' , $movie->tag);
                            //print_r($tag);
                            @endphp
                            @foreach ($tag as $key => $value)
                            <a href="{{url('/tag/'.$value)}}">{{$value}}</a>,
                            @endforeach
                            @else
                            {{$movie->title}}
                            @endif
                        </article>
                    </div>
                </div>
                <!-- Trailer phim -->
                @if($movie->trailer != null)
                <div class="section-bar clearfix">
                    <h2 class="section-title"><span style="color:#ffed4d">Trailer phim</span></h2>
                </div>
                <div class="entry-content htmlwrap clearfix">
                    <div class="video-item halim-entry-box">
                        <article id="watch_trailer" class="item-content">
                            <iframe width="100%" height="350" src="https://www.youtube.com/embed/{{$movie->trailer}}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </article>
                    </div>
                </div>
                @endif

                <div class="section-bar clearfix">
                    <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                </div>

                <style>
                .fb-background-color {
                    background: white !important;
                }
                </style>
                <div class="fb-background-color">
                    <div class="fb-comments" data-href="http://127.0.0.1:8000/chi-tiet/{{$movie->slug}}"
                        data-width="100%" data-numposts="5"></div>
                </div>

            </div>
        </section>
        <section class="related-movies">
            <div id="halim_related_movies-2xx" class="wrap-slider">
                <div class="section-bar clearfix">
                    <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                </div>
                <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                    @foreach($related as $key => $movie_hot)
                    <article class="thumb grid-item post-38498">
                        <div class="halim-item">
                            <a class="halim-thumb" href="{{route('chitiet', $movie_hot->slug)}}"
                                title="Đại Thánh Vô Song">
                                <figure><img class="lazy img-responsive"
                                        src="{{asset('uploads/movie/'.$movie_hot->img)}}" alt="Đại Thánh Vô Song"
                                        title="Đại Thánh Vô Song"></figure>
                                @if($movie_hot->resolution == 0)
                                <span class="status">HD</span>
                                @elseif($movie_hot->resolution == 1)
                                <span class="status">SD</span>

                                @elseif($movie_hot->resolution == 2)
                                <span class="status">HDCam</span>

                                @elseif($movie_hot->resolution == 3)
                                <span class="status">FullHD</span>

                                @endif
                                <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                    @if($movie_hot->cc == 0)
                                    Thuyết Minh
                                    @elseif($movie_hot->cc == 1)
                                    VietSub
                                    @endif
                                </span>
                                <div class="icon_overlay"></div>
                                <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                        <p class="entry-title">{{$movie_hot->title}}</p>
                                        <p class="original_title">{{$movie_hot->name_eng}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </article>
                    @endforeach





                </div>
                <script>
                jQuery(document).ready(function($) {
                    var owl = $('#halim_related_movies-2');
                    owl.owlCarousel({
                        loop: true,
                        margin: 4,
                        autoplay: true,
                        autoplayTimeout: 4000,
                        autoplayHoverPause: true,
                        nav: true,
                        navText: ['<i class="hl-down-open rotate-left"></i>',
                            '<i class="hl-down-open rotate-right"></i>'
                        ],
                        responsiveClass: true,
                        responsive: {
                            0: {
                                items: 2
                            },
                            480: {
                                items: 3
                            },
                            600: {
                                items: 4
                            },
                            1000: {
                                items: 4
                            }
                        }
                    })
                });
                </script>
                <!-- danh gia -->
                <script type="text/javascript">
                function remove_background(movie_id) {
                    for (var count = 1; count <= 5; count++) {
                        $('#' + movie_id + '-' + count).css('color', '#ccc');
                    }
                }

                //hover chuột đánh giá sao
                $(document).on('mouseenter', '.rating', function() {
                    var index = $(this).data("index");
                    var movie_id = $(this).data('movie_id');
                    // alert(index);
                    // alert(movie_id);
                    remove_background(movie_id);
                    for (var count = 1; count <= index; count++) {
                        $('#' + movie_id + '-' + count).css('color', '#ffcc00');
                    }
                });
                //nhả chuột ko đánh giá
                $(document).on('mouseleave', '.rating', function() {
                    var index = $(this).data("index");
                    var movie_id = $(this).data('movie_id');
                    var rating = $(this).data("rating");
                    remove_background(movie_id);
                    //alert(rating);
                    for (var count = 1; count <= rating; count++) {
                        $('#' + movie_id + '-' + count).css('color', '#ffcc00');
                    }
                });

                //click đánh giá sao
                $(document).on('click', '.rating', function() {

                    var index = $(this).data("index");
                    var movie_id = $(this).data('movie_id');

                    $.ajax({
                        url: "{{route('add-rating')}}",
                        method: "POST",
                        data: {
                            index: index,
                            movie_id: movie_id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data == 'done') {

                                alert("Bạn đã đánh giá " + index + " trên 5");
                                location.reload();

                            } else if (data == 'exist') {
                                alert("Bạn đã đánh giá phim này rồi,cảm ơn bạn nhé");
                            } else {
                                alert("Lỗi đánh giá");
                            }

                        }
                    });



                });
                </script>
            </div>
        </section>
    </main>
    @include('pages.include.sidebar')
</div>

@endsection