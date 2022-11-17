@extends('layout')
@section('content')

<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <div class="yoast_breadcrumb hidden-xs"><span><span><a
                                    href="">{{$movie_episode->category->title}}</a> » <span><a
                                        href="danhmuc.php">{{$movie_episode->country->title}}</a> » <span
                                        class="breadcrumb_last"
                                        aria-current="page">{{$movie_episode->title}}</span></span></span></span></div>
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
                <style>
                .iframe_phim iframe {
                    width: 100%;
                    height: 500px;
                }
                </style>
                @if(isset($episode->link_phim))
                <div class="iframe_phim">
                    {!!$episode->link_phim!!}
                </div>
                @else
                <video width="100%" height="500px" controls>
                    <source src="{{asset('uploads/upload_eps/'.$episode->video)}}" type="video/mp4">
                </video>
                @endif
                <div class="button-watch">
                    <ul class="halim-social-plugin col-xs-4 hidden-xs">
                        <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small"
                            data-show-faces="true" data-share="true"></li>
                    </ul>
                    <ul class="col-xs-12 col-md-8">
                        <div id="autonext" class="btn-cs autonext">
                            <i class="icon-autonext-sm"></i>
                            <!-- <span><i class="hl-next"></i> Autonext: <span id="autonext-status">On</span></span> -->
                        </div>
                        <!-- <div id="explayer" class="hidden-xs"><i class="hl-resize-full"></i>
                            Expand
                        </div> -->
                        <div id="toggle-light"><i class="hl-adjust"></i>
                            Light Off
                        </div>
                        <!-- <div id="report" class="halim-switch"><i class="hl-attention"></i> Report</div> -->
                        <!-- <div class="luotxem"><i class="hl-eye"></i>
                            <span>1K</span> lượt xem
                        </div> -->
                        <div class="luotxem">
                            <a class="visible-xs-inline" data-toggle="collapse" href="#moretool" aria-expanded="false"
                                aria-controls="moretool"><i class="hl-forward"></i> Share</a>
                        </div>
                    </ul>
                </div>
                <div class="collapse" id="moretool">
                    <ul class="nav nav-pills x-nav-justified">
                        <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small"
                            data-show-faces="true" data-share="true"></li>
                        <div class="fb-save" data-uri="" data-size="small"></div>
                    </ul>
                </div>

                <div class="clearfix"></div>
                <div class="clearfix"></div>
                <div class="title-block">
                    <a href="javascript:;" data-toggle="tooltip" title="Add to bookmark">
                        <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="37976">
                            <div class="halim-pulse-ring"></div>
                        </div>
                    </a>
                    <div class="title-wrapper-xem full">
                        <h1 class="entry-title"><a href="" title="{{$movie_episode->title}}"
                                class="tl">{{$movie_episode->title}}@if($movie_episode->thuocphim == 0)
                                - {{$episode->episode}} @endif</a></h1>
                    </div>
                </div>
                <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                    <article id="post-37976" class="item-content post-37976"></article>
                </div>
                <div class="clearfix"></div>
                <div class="text-center">
                    <div id="halim-ajax-list-server"></div>
                </div>
                <div id="halim-list-server">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active server-1"><a href="" aria-controls="server-0" role="tab"
                                data-toggle="tab"><i class="hl-server"></i>
                                @if($movie_episode->cc == 1)
                                VietSub
                                @elseif($movie_episode->cc == 0)
                                Thuyết minh
                                @endif
                            </a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active server-1" id="server-0">
                            <div class="halim-server">
                                <ul class="halim-list-eps">
                                    @if($movie_episode->thuocphim == 0)
                                    @foreach($epi as $key => $episode)
                                    <a
                                        href="{{route('xemphim',['slug' => $movie_episode->slug, 'tap' => $episode->episode])}}">
                                        <li class="halim-episode"><span
                                                class="halim-btn halim-btn-2 {{$episode->episode == $tapphim ? 'active' : ''}} halim-info-1-2 box-shadow"
                                                data-post-id="37976" data-server="1" data-episode="2" data-position=""
                                                data-embed="0" data-title="" data-h1="">{{$episode->episode}}</span>
                                        </li>
                                    </a>
                                    @endforeach
                                    @endif
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="htmlwrap clearfix">
                    <div id="lightout"></div>
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
            </div>
        </section>
    </main>
    @include('pages.include.sidebar')
    <!-- <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
        <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
            <div class="section-bar clearfix">
                <div class="section-title">
                    <span>Top Views</span>
                    <ul class="halim-popular-tab" role="tablist">
                        <li role="presentation" class="active">
                            <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10"
                                data-type="today">Day</a>
                        </li>
                        <li role="presentation">
                            <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10"
                                data-type="week">Week</a>
                        </li>
                        <li role="presentation">
                            <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10"
                                data-type="month">Month</a>
                        </li>
                        <li role="presentation">
                            <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="all">All</a>
                        </li>
                    </ul>
                </div>
            </div>
            <section class="tab-content">
                <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                    <div class="halim-ajax-popular-post-loading hidden"></div>
                    <div id="halim-ajax-popular-post" class="popular-post">
                        <div class="item post-37176">
                            <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                                <div class="item-link">
                                    <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798"
                                        class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ"
                                        title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                                    <span class="is_trailer">Trailer</span>
                                </div>
                                <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div>


                    </div>
                </div>
            </section>
            <div class="clearfix"></div>
        </div>
    </aside> -->
</div>

@endsection