@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Quản lý thể loại</div>



                @if(!isset($movie))
                {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data', 'style'=>'margin-bottom:30px;',
                'route' => 'movie.store']) !!}
                @else
                {!! Form::open(['method' => 'PUT','style'=>'margin-bottom:30px;','enctype' => 'multipart/form-data',
                'route' =>
                ['movie.update',$movie->id], ]) !!}
                @endif
                <div class="form-group">
                    {!! Form::label('title', 'Tiêu đề', []) !!}
                    {!! Form::text('title', isset($movie) ? $movie->title : '', ['class' => 'form-control',
                    'placeholder' => 'Nhâp tên','id'=> 'slug', 'onkeyup'=> 'ChangeToSlug()']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('slug', 'slug', []) !!}
                    {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class' => 'form-control', 'id'=>
                    'convert_slug']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name_eng', 'Tên tiếng anh', []) !!}
                    {!! Form::textarea('name_eng', isset($movie) ? $movie->name_eng : '', ['class' => 'form-control',
                    'placeholder' => 'Tên tiếng anh']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('des', 'Mô tả', []) !!}
                    {!! Form::textarea('des', isset($movie) ? $movie->des : '', ['class' => 'form-control ',
                    'placeholder' => 'Mô tả']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('trailer', 'Trailer', []) !!}
                    {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class' => 'form-control',
                    'placeholder' => 'Trailer']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('tags', 'Tags', []) !!}
                    {!! Form::textarea('tag', isset($movie) ? $movie->tag : '', ['class' => 'form-control',
                    'placeholder' => 'Mô tả']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Thời gian', 'Thời gian', []) !!}
                    {!! Form::text('time', isset($movie)?$movie->time : '', ['class' => 'form-control']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('thuộc phim', 'Thuộc phim', []) !!}
                    {!! Form::select('thuocphim',['0'=> 'Phim bộ', '1'=> 'Phim lẻ'], isset($movie)?$movie->thuocphim:
                    '', ['class' => 'form-control thuocphim']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('tap', 'Số Tập', []) !!}
                    {!! Form::text('tap', isset($movie)?$movie->tap : '', ['class' => 'form-control', 'id' => 'sotap'])
                    !!}

                </div>
                <div class="form-group">
                    {!! Form::label('staus', 'Trạng Thái', []) !!}
                    {!! Form::select('status',['1'=> 'Hiện thị', '0'=> 'Không hiện thị'], isset($movie) ? $movie->status
                    : '', ['class' => 'form-control']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('Định dạng', 'Định dạng', []) !!}
                    {!! Form::select('resolution',['1'=> 'SD', '0'=> 'HD', '2' => 'HDCam',
                    '3'=>'FullHD','4'=>'Trailer'], isset($movie)
                    ?
                    $movie->resolution
                    : '', ['class' => 'form-control']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('Phụ đề', 'Phụ đề', []) !!}
                    {!! Form::select('cc',['1'=> 'VietSub', '0'=> 'Thuyết Minh'], isset($movie)?$movie->cc
                    : '', ['class' => 'form-control']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label('country', ' Quốc gia', []) !!}
                    {!! Form::select('country', $country, isset($movie) ? $movie->country_id
                    : '', ['class' => 'form-control']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('category', 'Danh mục', []) !!}
                    {!! Form::select('category',$category, isset($movie) ? $movie->category_id
                    : '', ['class' => 'form-control']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('genre', 'Thể loại', []) !!}<br>
                    <!-- {!! Form::select('genre',$genre, isset($movie) ? $movie->genre_id
                    : '', ['class' => 'form-control']) !!} -->


                    @foreach($list_genre as $key => $list_genre)
                    @if(isset($movie))
                    {!! Form::checkbox('genre[]',$list_genre->id,isset($list_movie_genre) &&
                    $list_movie_genre->contains($list_genre->id) ? true : false )!!}
                    @else
                    {!! Form::checkbox('genre[]',$list_genre->id,'')!!}
                    @endif
                    {!! Form::label('genre',$list_genre->title)!!}
                    @endforeach
                </div>
                <div class="form-group">
                    {!! Form::label('Hot', 'Phim hot', []) !!}
                    {!! Form::select('phimhot',['1'=> 'Hiện thị', '0'=> 'Không hiện thị'], isset($movie) ?
                    $movie->phimhot: '', ['class' => 'form-control']) !!}

                </div>
                <div class="form-group">
                    @if (!isset($movie))
                    {!! Form::label('img', 'Hình ảnh', []) !!}
                    {!! Form::file('img', ['class' => 'form-control-file']) !!}
                    @else
                    {!! Form::label('img', 'Hình ảnh', []) !!}
                    {!! Form::file('img', ['class' => 'form-control-file']) !!}
                    <img style="height: 150px; width: 150px;" src="{{asset('uploads/movie/'.$movie->img)}}">
                    @endif
                </div>
                @if(!isset($movie))
                {!! Form::submit('Thêm', ['class' => 'btn btn-success',]) !!}
                @else
                {!! Form::submit('Cập nhập', ['class' => 'btn btn-success',]) !!}
                @endif
                {!! Form::close() !!}



                <table class="table" id="tablephim">
                    <thead>
                        <tr>

                            <th scope="col">STT</th>
                            <th scope="col">Tiêu đề</th>
                            <!-- <th scope="col">Tên tiếng anh</th> -->
                            <!-- <th scope="col">Mô tả</th> -->

                            <!-- <th scope="col">Thời gian</th> -->
                            <th scope="col">Session</th>
                            <th scope="col">View</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Phim hot</th>
                            <th scope="col">Số tập</th>

                            <th scope="col">Định dạng</th>
                            <th scope="col">Phụ đề</th>
                            <th scope="col">Năm phim</th>
                            <!-- <th scope="col">Quốc gia</th>
                            <th scope="col">Danh mục</th> -->
                            <th scope="col">Thể loại</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Hành động</th>


                        </tr>
                    </thead>

                    <tbody>

                        @foreach($list as $key => $cate)
                        <tr>

                            <td>{{$key}}</td>
                            <td>{{$cate->title}}</td>
                            <!--  <td>{{$cate->name_eng}}</td> -->
                            <!-- <td>{{$cate->time}}</td> -->
                            <td>
                                {!! Form::selectRange('session',0,20, isset($cate) ? $cate->session
                                : '',['class' => 'select-session', 'id'=>$cate->id])
                                !!}
                            </td>
                            <td>

                                {!! Form::select('view',['0'=> 'Ngày','1'=> 'Tuần', '2'=>'Tháng'],
                                isset($cate) ? $cate->view: '', ['class' => 'select-view', 'id'=>$cate->id]) !!}
                            </td>
                            <!-- <td>{{$cate->des}}</td> -->

                            @if($cate->status == 1)
                            <td>Hiện thị</td>
                            @else
                            <td>Không hiện thị</td>
                            @endif
                            @if($cate->phimhot == 1)
                            <td>Hiện thị</td>
                            @else
                            <td>Không hiện thị</td>
                            @endif

                            <td>{{$cate->episode_count}}/{{$cate->tap}}</td>

                            @if($cate->resolution == 1)
                            <td>SD</td>
                            @elseif($cate->resolution == 0)
                            <td>HD</td>
                            @elseif($cate->resolution == 2)
                            <td>HDCam</td>
                            @elseif($cate->resolution == 3)
                            <td>FullHD</td>
                            @elseif($cate->resolution == 4)
                            <td>Trailer</td>
                            @endif

                            @if($cate->cc == 1)
                            <td>VietSub</td>
                            @elseif($cate->cc == 0)
                            <td>Thuyết minh</td>
                            @endif


                            <td>
                                {!! Form::selectYear('year',2000,2022,isset($cate) ? $cate->year
                                : '',['class' => 'select-year', 'id'=>$cate->id])
                                !!}
                            </td>
                            <!-- <td>{{$cate->country->title}}</td>
                            <td>{{$cate->category->title}}</td> -->

                            <td>
                                @foreach ($cate->movie_genre as $genre)

                                <span class="badge badge-primary" style="color: #0d6efd">{{$genre->title}}</span>
                                @endforeach
                            </td>

                            <td><img style="height: 50px; width: 50px;" src="{{asset('uploads/movie/'.$cate->img)}}">
                            </td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route' =>
                                ['movie.destroy',$cate->id],'onsubmit'=>'return confirm("Xóa hay không")']) !!}
                                <div class="btn-group pull-right">
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                </div>
                                {!! Form::close() !!}
                                <a href="{{route('movie.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>



</div>
@endsection