<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phim extends Model
{
    public $timestamps = false;
    use HasFactory;
   public function category(){
    return $this->belongsTo(danhmuc::class, 'category_id' ,'id');
   }
   public function genre(){
    return $this->belongsTo(theloai::class, 'genre_id' ,'id');
   }
   public function country(){
    return $this->belongsTo(quocgia::class, 'country_id' ,'id');
   }
   public function movie_genre(){
    return $this->belongsToMany(theloai::class, 'phim_theloai','movie_id', 'genre_id');
   }
   public function episode(){
    return $this->hasMany(tap::class, 'movie_id' );
   }
   public function rating(){
    return $this->hasMany(danhgia::class, 'movie_id' );
   }
}