<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Db_category_news extends Model {

    protected $fillable = [
        "catnews_order",
        "catnews_title",
        "catnews_slug",
        "catnews_description",
        "catnews_keyword",
        "catnews_img",
        "catnews_status",
        "created_by",
        "modified_by",
    ];

    protected $dates = ["created","modified"];

    public static $rules = [
        "catnews_order" =>"required",
        "catnews_title" =>"required",
        "catnews_slug" =>"required",
        "catnews_description" =>"required",
        "catnews_keyword" =>"required",
        "catnews_img" =>"required",
        "catnews_status" =>"required",
        "created_by" =>"required",
        "modified_by" =>"required",
    ];

    // Relationships

}
