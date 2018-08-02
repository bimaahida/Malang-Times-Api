<?php 
namespace App\Http\Controllers;

use App\Db_news;
use Illuminate\Http\Request;

class NewsController extends Controller {

    public function allNews(){
        $data = Db_news::limit(10)->get();
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
        
    }
    public function newsById($id){
        $data = Db_news::where('news_view',$id)->first();
        // var_dump($data);
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
    }
    public function newPopuler(){
        $data = Db_news::limit(10)->orderBy('news_view', 'desc')->get();
        // var_dump($data);
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
    }
    private function result($status,$data){
        $res['status'] = $status;
        $res['result'] = $data;
        return $res;
    }

}
