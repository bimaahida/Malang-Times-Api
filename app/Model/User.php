<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'user';

    protected $fillable = ['username','password','name'];

    public function  news(){
        return $this->hasMany('App\Model\News');
    }

}
