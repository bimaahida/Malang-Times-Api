<?php 
namespace App\Http\Controllers;

use App\Model\News;
use Illuminate\Http\Request;

class NewsController extends Controller {
    use RestControllerTrait;
    const MODEL = "App\Model\User";

    protected $validationRules  = [
        'username' => 'required',
        'password' => 'required',
        'name' => 'required',
    ];

    public function newsById($id,$limit){
        $data = News::where('news_id',$id)->first();
        if ($limit >= 2 ) {
            $data = News::where('catnews_id',$data['catnews_id'])->skip($limit)->take(1)->get();
        }
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
    }
    public function newPopuler(){
        $data = News::limit(3)->orderBy('news_view', 'desc')->get();
        // var_dump($data);
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
    }
    public function newNews(){
        $data = News::limit(3)->orderBy('created_at', 'desc')->get();
        // var_dump($data);
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
    }
    public function headline(){
        $data = News::where('news_headline','1')->orderBy('created_at', 'desc')->take(5)->get();
        // var_dump($data);
        if (empty($data)) {
            return response()->json($this->result(FALSE,[]));    
        }else{
            return response()->json($this->result(TRUE,$data));
        }
    }
    public function categoriLimit($kat){
        $data = News::where('catnews_id',$kat)->orderBy('created_at', 'desc')->take(2)->get();
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
        $data = News::where('catnews_id',$kat)->orderBy('created_at', 'desc')->skip($limit)->take(20)->get();
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
