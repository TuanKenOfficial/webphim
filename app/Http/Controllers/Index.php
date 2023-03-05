<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\quocgia;
use App\Models\phim;
use App\Models\tapphim;
use App\Models\theloai;
use App\Models\danhmuc;
use App\Models\phim_theloai;
use App\Models\tap;
use App\Models\danhgia;
use DB;
class Index extends Controller
{
    public function tim_kiem(Request $request){

        $data = $request->all();
        if($data['search'] != null){
            $search = $data['search'];
            $category = danhmuc::all();
            $country = quocgia::all();
            $genre = theloai::all();
            //$cate_slug = danhmuc::where('slug', $slug)->first();
            $movie = phim::where('title','LIKE','%'.$search.'%')->orwhere('name_eng','LIKE','%'.$search.'%')->paginate(20);
            $movie_trailer = phim::where('resolution', '4')->orderBy('id', 'desc')->withcount('rating')->take(5)->get();
            $year_movie =phim::orderby('year','desc')->distinct('year')->pluck('year');
            

        return view('pages.search.search' , compact('category', 'country','search', 'genre','movie', 'movie_trailer','year_movie') );
        }else{
            return redirect()->to('/');
        }


        
    }
        
    public function index(){
        $category = danhmuc::all();
        $country = quocgia::all();
        $genre = theloai::all();
        $year_movie =phim::orderby('year','desc')->distinct('year')->pluck('year');

        $category_home = danhmuc::with(['movie' => function($tap){ $tap->withcount('episode');}])->orderby('id', 'desc')->get();
        $movie_hot = phim::where('phimhot', '1')->withcount('episode')->orderBy('id', 'desc')->take(10)->get();
        $movie_trailer = phim::where('resolution', '4')->orderBy('id', 'desc')->take(5)->withcount('rating')->get();
       // dd($movie_trailer);
        return view('pages.home', compact('category', 'country', 'genre','category_home', 'movie_hot', 'movie_trailer','year_movie'));
    }
    
    public function quocgia($slug){
        $year_movie =phim::orderby('year','desc')->distinct('year')->pluck('year');

        $category = danhmuc::all();
        $country = quocgia::all();
        $genre = theloai::all();
        $country_slug = quocgia::where('slug', $slug)->first();
        $movie = phim::where('country_id', $country_slug->id)->withcount('episode')->paginate(20);
        $movie_trailer = phim::where('resolution', '4')->orderBy('id', 'desc')->withcount('rating')->take(5)->get();


        return view('pages.quocgia', compact('category', 'country', 'genre', 'country_slug','movie', 'movie_trailer','year_movie'));
    }
    public function theloai($slug){
        $year_movie =phim::orderby('year','desc')->distinct('year')->pluck('year');

        $category = danhmuc::all();
        $country = quocgia::all();
        $genre = theloai::all();
        $genre_slug = theloai::where('slug', $slug)->first();
        $movie_trailer = phim::where('resolution', '4')->orderBy('id', 'desc')->withcount('rating')->take(5)->get();
        $movie_genre = phim_theloai::where('genre_id', $genre_slug->id)->get();
        $list_genre = [];
        foreach ($movie_genre as $key => $list) {
            $list_genre[] =$list->movie_id;
            
        }
        //dd($list_genre);
         $movie = phim::whereIn('id', $list_genre)->withcount('episode')->paginate(20);


         return view('pages.theloai' , compact('category', 'country', 'genre', 'genre_slug','movie', 'movie_trailer' ,'year_movie') );
    }
    public function danhmuc($slug){
        $year_movie =phim::orderby('year','desc')->distinct('year')->pluck('year');
        $category = danhmuc::all();
        $country = quocgia::all();
        $genre = theloai::all();
        $cate_slug = danhmuc::where('slug', $slug)->first();
        $movie = phim::where('category_id', $cate_slug->id)->withcount('episode')->paginate(20);
        $movie_trailer = phim::where('resolution', '4')->orderBy('id', 'desc')->withcount('rating')->take(5)->get();
        $related = phim::with('category', 'country', 'genre')->orderby(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();

        return view('pages.danhmuc' , compact('category', 'country', 'genre', 'cate_slug','movie', 'movie_trailer','related' ,'year_movie') );
    }
    public function nam($year){
        $category = danhmuc::all();
        $country = quocgia::all();
        $genre = theloai::all();
        $year = $year;
        $year_movie =phim::orderby('year','desc')->distinct('year')->pluck('year');
        $movie = phim::where('year', $year)->withcount('episode')->paginate(20);
        $movie_trailer = phim::where('resolution', '4')->orderBy('id', 'desc')->withcount('rating')->take(5)->get();

        return view('pages.nam' , compact('category', 'country', 'genre', 'year','movie', 'movie_trailer' ,'year_movie') );
    }
    public function tag($value){
        $year_movie =phim::orderby('year','desc')->distinct('year')->pluck('year');

        $category = danhmuc::all();
        $country = quocgia::all();
        $genre = theloai::all();
        $tag = $value;
        $movie = phim::where('tag','LIKE','%'.$tag.'%')->withcount('episode')->paginate(20);
        $movie_trailer = phim::where('resolution', '4')->orderBy('id', 'desc')->withcount('rating')->take(5)->get();

        return view('pages.tag' , compact('category', 'country', 'genre', 'tag','movie', 'movie_trailer' ,'year_movie') );
    }
    public function xemphim($slug){
        $year_movie =phim::orderby('year','desc')->distinct('year')->pluck('year');

        $category = danhmuc::all();
        $country = quocgia::all();
        $genre = theloai::all();
        if(isset($_GET['tap'])){
            $tap = $_GET['tap'];
        }else{
            $tap = 1;
        }
        $tapphim = substr($tap, 0,9);
//  dd($tapphim);
        $movie_trailer = phim::where('resolution', '4')->orderBy('id', 'desc')->withcount('rating')->take(5)->get();
        $movie_episode = phim::with('category', 'country', 'genre', 'episode')->where('slug', $slug)->first();

        $episode = tap::where('movie_id', $movie_episode->id)->where('episode',$tapphim)->first();
        $epi = tap::where('movie_id', $movie_episode->id)->orderby('episode','asc')->get();

        $related = phim::with('category', 'country', 'genre')->orderby(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        //dd($episode);
        //dd($movie_episode);
       // return response()->json($movie_episode);
        return view('pages.xemphim',compact('year_movie','category', 'country', 'genre', 'movie_trailer' , 'movie_episode','episode','tapphim','related','epi'));
    }
    public function tap(){
        
        return view('pages.tap');
    }
    public function chitiet($slug){
        $year_movie =phim::orderby('year','desc')->distinct('year')->pluck('year');

        $category = danhmuc::all();
        $country = quocgia::all();
        $genre = theloai::all();
        $movie = phim::with('category', 'country', 'genre')->where('slug', $slug)->first();
        
        $related = phim::with('category', 'country', 'genre')->orderby(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        $movie_trailer = phim::where('resolution', '4')->withcount('rating')->orderBy('id', 'desc')->take(5)->get();

        $episode = tap::with('movie')->where('movie_id',$movie->id)->orderby('episode','desc')->take(3)->get();
        $episode_first = tap::with('movie')->where('movie_id',$movie->id)->orderby('episode','asc')->first();
        

        $episode_list = $episode->count();
        //dd($episode_list);
        
        $movie_genre = phim::find($movie->id);

        $list_movie_genre = $movie_genre->movie_genre;
        //dd($episode);
        $rating = danhgia::where('movie_id', $movie->id)->avg('rating');
        $rating = Round($rating);
        $count_total = danhgia::where('movie_id', $movie->id)->count();
        //echo $rating;
        $view_count = $movie->view_count + 1;
        $movie = phim::find($movie->id);
        $movie->view_count = $view_count;
        $movie->save();
        return view('pages.chitiet' , compact('count_total','year_movie','episode_list','episode_first','category','country', 'genre','movie','related', 'movie_trailer','list_movie_genre','episode','rating'));
    }
    public function filter_sidebar(Request $request){
        $data =  $request->all();
        $filter_sidebar = phim::where('view', $data['value'])->withcount('rating')->orderby('create_at', 'desc')->take(10)->get();
        $output = '';
        foreach ($filter_sidebar as $key => $value) {
            //danhgia
            $sum = 0;
            foreach($value->rating as $r){
                $sum += $r->rating;
            }
           if($value->rating_count == 0){
            $rating = 0;
           }else{
            $rating = $sum/$value->rating_count;
           }


            //chatluong
            if ($value->resolution = 0) {
                    $text = 'HD';
            }elseif($value->resolution = 1) {
                $text = 'SD';
            }elseif($value->resolution = 2) {
                $text = 'HDCam';
            }elseif($value->resolution == 3){
                $text = 'FullHD';
            }else{
                $text = 'Trailer';
            }
            if($value->view_count == null){
                $value->view_count = 0;
            }

            $output .='<section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
            <div class="halim-ajax-popular-post-loading hidden"></div>
            <div id="halim-ajax-popular-post" class="popular-post">

             <div class="item post-37176">
            <a href="'.route('chitiet', $value->slug).'" title="'.$value->title.'">
                <div class="item-link">
                    <img src="'.url('uploads/movie/'.$value->img) .'"
                        class="lazy post-thumb" alt="'.$value->title.'"
                        title="'.$value->title.'" />
                    <span class="is_trailer">'.$text.'</span>
                </div>
                <p class="title">'.$value->title.'</p>
            </a>
            <div class="viewsCount" style="color: #9d9d9d;">'.$value->view_count.' lượt xem</div>
            <div class="viewsCount" style="color: #9d9d9d;">
            ';
for($count=1; $count<=5; $count++){
    if($count<=$rating){
        $color='color:#ffcc00;' ; }
    else { 
        $color='color:#ccc;';
    }
            $output .='<span style="cursor:pointer; '.$color.' 
            ">&#9733;</span>';
}
            $output .='</div>
                    </div>
                </div>
                </div>
                </div>
                </section>
                ';

    
        }
        echo $output;
        //return view('pages.include.sidebar', compact('filter_sidebar'));
    }
    public function filter_sidebar_default(Request $request){
        $data =  $request->all();
        $filter_sidebar = phim::where('view', 0)->withcount('rating')->orderby('create_at', 'desc')->take(10)->get();
        $output = '';
        foreach ($filter_sidebar as $key => $value) {
            //danhgia
            $sum = 0;
            foreach($value->rating as $r){
                $sum += $r->rating;
            }
           if($value->rating_count == 0){
            $rating = 0;
           }else{
            $rating = $sum/$value->rating_count;
           }


            //chatluong
            if ($value->resolution == 0) {
                    $text = 'HD';
            }elseif($value->resolution == 1) {
                $text = 'SD';
            }elseif($value->resolution == 2) {
                $text = 'HDCam';
            }elseif($value->resolution == 3){
                $text = 'FullHD';
            }else{
                $text = 'Trailer';
            }

            if($value->view_count == null){
                $value->view_count = 0;
            }

            $output .='<section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
            <div class="halim-ajax-popular-post-loading hidden"></div>
            <div id="halim-ajax-popular-post" class="popular-post">

            <div class="item post-37176">
            <a href="'.route('chitiet', $value->slug).'" title="'.$value->title.'">
                <div class="item-link">
                    <img src="'.url('uploads/movie/'.$value->img) .'"
                        class="lazy post-thumb" alt="'.$value->title.'"
                        title="'.$value->title.'" />
                    <span class="is_trailer">'.$text.'</span>
                </div>
                <p class="title">'.$value->title.'</p>
            </a>
            <div class="viewsCount" style="color: #9d9d9d;">'.$value->view_count.' lượt xem</div>

            <div class="viewsCount" style="color: #9d9d9d;">';
            for($count=1; $count<=5; $count++){
                if($count<=$rating){
                    $color='color:#ffcc00;' ; }
                else { 
                    $color='color:#ccc;';
                }
                        $output .='<span style="cursor:pointer; '.$color.' 
                        ">&#9733;</span>';
            }

            $output .='        
            </div>
        </div>
    </div>
    </div>
    </div>
    </section>
    ';

    
        }
        echo $output;
        //return view('pages.include.sidebar', compact('filter_sidebar'));
    }

    public function select_movie(){
       $id = $_GET['id'];
       $movie = phim::find($id);
       
       $tap = tap::where('movie_id', $movie->id)->orderby('episode','desc')->first();
       $output = '<option>Chọn tập phim</option>';

       if(isset($tap)){
        $a = $tap->episode;
        $i = $a + 1;
       }else{
        $i = 1 ;
       }
        if($movie->thuocphim == 0 ){
       for($i; $i <= $movie->tap;$i++){
            
            $output .= '<option value="'.$i.'">'.$i.'</option>';
       }
    }elseif($movie->thuocphim == 1 && isset($tap)){
        $output   = '<option>Da them</option>';
    }else{
        $output .= '<option value="1">1</option>';
    }
       echo $output;
    }

    // filter phim

    public function filter(){
        if( $_GET['quocgia'] != 'empty' && $_GET['danhmuc'] != 'empty' && $_GET['theloai'] != 'empty'){
            $filter = phim::withcount('episode')->orwhere("country_id" , $_GET['quocgia'])->orWhere("genre_id" , $_GET['theloai'])
            ->orWhere("category_id" , $_GET['danhmuc'])->paginate(20);
        }else{
            return redirect()->back();
         }


        $category = danhmuc::all();
        $country = quocgia::all();
        $genre = theloai::all();
        $movie_trailer = phim::where('resolution', '4')->withcount('rating')->orderBy('id', 'desc')->take(5)->get();

        $year_movie =phim::orderby('year','desc')->distinct('year')->pluck('year');
        return view('pages.filter' , compact('year_movie','category','filter', 'country', 'genre', 'movie_trailer') );
         
        
    }

    // danh gia
    public function add_rating(Request $request){
        $data = $request->all();
        $ip_address = $request->ip();
        $rating_count = danhgia::where('movie_id', $data['movie_id'])->where('ip_address',$ip_address)->count();
        if($rating_count > 0 ){
            echo 'exist';
        }else{
            $rating = new danhgia;
            $rating->movie_id = $data['movie_id'];
            $rating->rating = $data['index'];
            $rating->ip_address = $ip_address;
            $rating->save();
            echo 'done';

        }
    }
}