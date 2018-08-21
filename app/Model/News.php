<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class News extends Model {
    protected $table = 'news';

    protected $fillable = ['catnews_id','editor_id','news_datepub','news_headline','news_title','news_image','news_caption','news_description','news_content','news_writer'];

    public static $rules = [
        'catnews_id' => 'required',
        'editor_id' => 'required',
        'news_datepub' => 'required',
        'news_headline' => 'required',
        'news_title' => 'required','
        news_image' => 'required',
        'news_caption' => 'required',
        'news_description' => 'required',
        'news_content' => 'required',
        'news_writer' => 'required'
    ];

    // Relationships
    public function user(){
        return $this->hasOne('App\Model\User');
    }
    public function categori(){
        return $this->hasOne('App\Model\Categori');
    }

}
