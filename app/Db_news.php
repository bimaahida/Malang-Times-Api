<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Db_news extends Model {

	protected $fillable = [
        "news_id",
        "catnews_id", 
        "editor_id", 
        "news_datepub", 
        "news_headline", 
        "news_headline_k", 
        "news_type", 
        "news_title", 
        "news_subtitle", 
        "news_ytube_id", 
        "news_image", 
        "news_image_new", 
        "news_caption", 
        "news_description", 
        "news_content", 
        "news_tags", 
        "focnews_id", 
        "news_view", 
        "news_status", 
        "news_wm", 
        "news_writer", 
        "source_site_id", 
        "news_chapter", 
        "news_related", 
        "created_by", 
        "modified_by", 
    ];

	protected $dates = ["created","modified","news_datepub"];

	public static $rules = [
        "news_id" => "required",
		"catnews_id"=> "required", 
        "editor_id"=> "required", 
        "news_headline"=> "required", 
        "news_headline_k"=> "required", 
        "news_type"=> "required", 
        "news_title"=> "required", 
        "news_subtitle"=> "required", 
        "news_ytube_id"=> "required", 
        "news_image"=> "required", 
        "news_image_new"=> "required", 
        "news_caption"=> "required", 
        "news_description"=> "required", 
        "news_content"=> "required", 
        "news_tags"=> "required", 
        "focnews_id"=> "required", 
        "news_view"=> "required", 
        "news_status"=> "required", 
        "news_wm"=> "required", 
        "news_writer"=> "required", 
        "source_site_id"=> "required", 
        "news_chapter"=> "required", 
        "news_related"=> "required", 
        "created_by"=> "required", 
        "modified_by"=> "required", 
	];

    // public function category_news(){
    //     return $this->belongsTo("App\Db_category_news");
    // }
}