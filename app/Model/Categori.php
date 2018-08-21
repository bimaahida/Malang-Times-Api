<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categori extends Model {
    protected $table = 'Categori';

    protected $fillable = ['kategori'];

    public static $rules = [
        'kategori' => 'required',
    ];

    public function  news(){
        return $this->hasMany('App\Model\News');
    }

}
