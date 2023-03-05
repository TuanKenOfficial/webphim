<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim sắp chiếu</span>

            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">

                    @foreach($movie_trailer as $key => $movie_trailer)
                    <?php
                    $sum = 0;
                    foreach($movie_trailer->rating as $r){
                        $sum += $r->rating;
                    }
                   if($movie_trailer->rating_count == 0){
                    $rating = 0;
                   }else{
                    $rating = $sum/$movie_trailer->rating_count;
                   }
                    
                    ?>

                    <div class="item post-37176">
                        <a href="{{route('chitiet', $movie_trailer->slug)}}" title="{{$movie_trailer->title}}">
                            <div class="item-link">
                                <img src="{{asset('uploads/movie/'.$movie_trailer->img)}}" class="lazy post-thumb"
                                    alt="{{$movie_trailer->title}}" title="{{$movie_trailer->title}}" />
                                <span class="is_trailer">Trailer</span>
                            </div>
                            <p class="title">{{$movie_trailer->title}}</p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">@if($movie_trailer->view_count == null)
                            0 @else {{$movie_trailer->view_count}} @endif lượt xem</div>
                        <div class="viewsCount" style="color: #9d9d9d;">
                            @for($count=1; $count<=5; $count++) <?php
                            if($count<=$rating){
                                            $color='color:#ffcc00;' ; }
                                        else { 
                                            $color='color:#ccc;';
                                        }
                              ?> <span style="cursor:pointer; {{$color}} ">&#9733;</span>
                                @endfor
                        </div>

                    </div>
                    @endforeach

                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>



<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Top Views</span>


            </div>
        </div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link filter-sidebar" id="pills-home-tab" data-toggle="pill" href="#ngay" role="tab"
                    aria-controls="pills-home" aria-selected="true">Ngày</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-sidebar" id="pills-profile-tab" data-toggle="pill" href="#tuan" role="tab"
                    aria-controls="pills-profile" aria-selected="false">Tuần</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-sidebar" id="pills-contact-tab" data-toggle="pill" href="#thang" role="tab"
                    aria-controls="pills-contact" aria-selected="false">Tháng</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">


            <div id="halim-ajax-popular-post-default" class="popular-post">
                <span id="show_data_default"></span>
            </div>


            <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="pills-home-tab">

                <div id="halim-ajax-popular-post" class="popular-post">
                    <span id="show_data"></span>
                </div>

            </div>
            <!-- <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="pills-profile-tab">
                <section class="tab-content">
                    <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                        <div class="halim-ajax-popular-post-loading hidden"></div>
                        <div id="halim-ajax-popular-post" class="popular-post">
                            <span id="show1"></span>
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="thang" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                    <div class="halim-ajax-popular-post-loading hidden"></div>
                    <div id="halim-ajax-popular-post" class="popular-post">
                        <span id="show2"></span>
                    </div>
                </div>
                </section>
            </div> -->
        </div>

        <!-- <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                    <div class="item post-37176">
                        <a href="" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
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
                    <div class="item post-37176">
                        <a href="" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
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
        </section> -->
        <div class="clearfix"></div>
    </div>
</aside>