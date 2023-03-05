<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quocgia extends Model
{
    public $timestamps = false;
    use HasFactory;
    public function movie(){
        return $this->hasMany(phim::class, 'country_id')->orderBy('id', 'desc');
    }
}