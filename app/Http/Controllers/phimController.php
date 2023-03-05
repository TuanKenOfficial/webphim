<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\phim;
use App\Models\quocgia;
use App\Models\theloai;
use App\Models\danhmuc;
use App\Models\phim_theloai;
use App\Models\tap;
use Carbon\Carbon;
use Storage;
use File;


class phimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_year(Request $request){
        $data =  $request->all();
        $movie = phim::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }
    public function update_view(Request $request){
        $data =  $request->all();
        $movie = phim::find($data['id_phim']);
        $movie->view = $data['view'];
        $movie->save();
    }
    public function update_session(Request $request){
        $data =  $request->all();
        $movie = phim::find($data['id_phim']);
        $movie->session = $data['session'];
        $movie->save();
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = danhmuc::pluck('title', 'id');
        $country = quocgia::pluck('title', 'id');
        $genre = theloai::pluck('title', 'id');
        $list_genre = theloai::all();
        $list = phim::with('country','genre', 'movie_genre', 'category')->withcount('episode')->orderBy('id', 'desc')->get();

        $path = public_path()."/json/";
        if(!is_dir($path)){
            mkdir($path, 0777, true);

        }
        File::put($path.'movie.json',json_encode($list)); 
        
        return view ('admincp.movie.form', compact( 'list_genre','list', 'category', 'genre', 'country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new phim();
        $movie->title = $data['title'];
        $movie->name_eng = $data['name_eng'];
        $movie->status = $data['status'];
        $movie->phimhot = $data['phimhot'];
        $movie->resolution = $data['resolution'];
        $movie->cc = $data['cc'];
        $movie->trailer = $data['trailer'];
        $movie->tap = $data['tap'];
        $movie->thuocphim = $data['thuocphim'];

        $movie->des = $data['des'];
        $movie->slug = $data['slug'];
        
        $movie->country_id = $data['country'];
        //$movie->genre_id = $data['genre'];
         foreach ($data['genre'] as $genre) {
             $movie->genre_id = $genre[0];

        }
        $movie->category_id = $data['category'];
        $movie->time = $data['time'];
        $movie->tag = $data['tag'];

        $movie->create_at = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->update_at = Carbon::now('Asia/Ho_Chi_Minh');

        $get_img = $request->file('img');
        
        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img ));
            $new_img = $name_img.rand(0,9999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('uploads/movie',$new_img);
           $movie->img = $new_img;    
        }
        $movie->save();
        //them nhiu phim
        $movie->movie_genre()->attach($data['genre']);
        // foreach ($data['genre'] as $genre) {
        //     $list = phim::orderBy('id','desc')->first();
        //     $movie_genre = new phim_theloai();
        //     $movie_genre->movie_id = $list->id;
        //     $movie_genre->genre_id = $genre;
        //     $movie_genre->save();
        // }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = danhmuc::pluck('title', 'id');
        $country = quocgia::pluck('title', 'id');
        $genre = theloai::pluck('title', 'id');
        $list_genre = theloai::all();

        $list = phim::with('country','genre', 'movie_genre','category')->orderBy('id', 'desc')->get();
        //$movie_genre = $list->movie_genre;
        
        $movie = phim::find($id);
        $list_movie_genre = $movie->movie_genre;

        return view ('admincp.movie.form', compact('list', 'category', 'genre', 'country', 'movie' , 'list_genre','list_movie_genre'));

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $movie = phim::find($id);
        $movie->title = $data['title'];
        $movie->name_eng = $data['name_eng'];

        $movie->status = $data['status'];
        $movie->phimhot = $data['phimhot'];
        $movie->resolution = $data['resolution'];
        $movie->cc = $data['cc'];
        $movie->trailer = $data['trailer'];
        $movie->tap = $data['tap'];
        $movie->thuocphim = $data['thuocphim'];

        $movie->des = $data['des'];
        $movie->slug = $data['slug'];
        $movie->country_id = $data['country'];
        //$movie->genre_id = $data['genre'];
        $movie->category_id = $data['category'];
        $movie->time = $data['time'];
        $movie->tag = $data['tag'];
        foreach ($data['genre'] as $genre) {
            $movie->genre_id = $genre[0];

       }
        $movie->update_at = Carbon::now('Asia/Ho_Chi_Minh') ;

        $get_img = $request->file('img');
        
        if($get_img){
            if(!empty($movie->img)){
                unlink('uploads/movie/'.$movie->img);
            }
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img ));
            $new_img = $name_img.rand(0,9999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('uploads/movie',$new_img);
           $movie->img = $new_img;    
        }
        $movie->save();
        $movie->movie_genre()->sync($data['genre']);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = phim::find($id);
        phim_theloai::whereIn('movie_id',[$movie->id])->delete();
        tap::whereIn('movie_id',[$movie->id])->delete();
        if(!empty($movie->img)){
            unlink('uploads/movie/'.$movie->img);
        }
        
        $movie->delete();
        return redirect()->back();
    }
}