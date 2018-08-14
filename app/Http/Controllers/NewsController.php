<?php 
namespace App\Http\Controllers;

use App\Db_news;
use Illuminate\Http\Request;

class NewsController extends Controller {

    public function allNews(){
        $data = Db_news::orderBy('created', 'desc')->take(20)->get();
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
        
    }
    public function newsById($id,$limit){
        $data = Db_news::where('news_id',$id)->first();
        if ($limit >= 2 ) {
            $data = Db_news::where('catnews_id',$data['catnews_id'])->skip($limit)->take(1)->get();
        }
        // var_dump($data['catnews_id']);
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
    }
    public function newPopuler(){
        $data = Db_news::limit(3)->orderBy('news_view', 'desc')->get();
        // var_dump($data);
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
    }
    public function newNews(){
        $data = Db_news::limit(3)->orderBy('created', 'desc')->get();
        // var_dump($data);
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
    }
    public function headline(){
        $data = Db_news::where('news_headline','1')->orderBy('created', 'desc')->take(5)->get();
        // var_dump($data);
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
    }
    public function categoriLimit($kat){
        $data = Db_news::where('catnews_id',$kat)->orderBy('created', 'desc')->take(2)->get();
        // var_dump($data);
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
    }
    public function newsCategori($kat,$limit){
        if ($limit == 1) {
            $limit = 0;
        }else{
            $limit = $limit * 20;
        }
        $data = Db_news::where('catnews_id',$kat)->orderBy('created', 'desc')->skip($limit)->take(20)->get();
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
