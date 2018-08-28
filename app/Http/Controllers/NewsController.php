<?php 
namespace App\Http\Controllers;

use App\Model\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller {
    use RestControllerTrait;
    const MODEL = "App\Model\News";

    protected $validationRules  = [
        'catnews_id' => 'required',
        'editor_id' => 'required',
        'news_datepub' => 'required',
        'news_headline' => 'required',
        'news_title' => 'required',
        'news_caption' => 'required',
        'news_description' => 'required',
        'news_content' => 'required',
        'news_writer' => 'required',
    ];

    public function create(Request $request){
        $news =  new News();
        $v = \Validator::make($request->all(), $this->validationRules);
        try
        {
            
            if($v->fails())
            {
                throw new \Exception("ValidationException");
            }

            $image_base64 = explode(',',$request->news_image);
            $image_type = explode('/',explode(';',$image_base64[0])[0])[1];
            $image_name = 'Images/'.str_random(10).'.'.$image_type;
            if (Storage::put('public/'.$image_name, base64_decode($image_base64[1]))) {
                $news->catnews_id = $request->catnews_id;
                $news->editor_id = $request->editor_id;
                $news->news_datepub = $request->news_datepub;
                $news->news_headline = $request->news_headline;
                $news->news_title = $request->news_title;
                $news->news_image = $image_name;
                $news->news_caption = $request->news_caption;
                $news->news_description = $request->news_description;
                $news->news_content = $request->news_content;
                $news->news_writer = $request->news_writer;
                $news->save();
                return $this->createdResponse($news);
            }
        }catch(\Exception $ex)
        {
            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($data);
        }
    }
    public function update(Request $request,$id){
        $news =  new News();
        $v = \Validator::make($request->all(), $this->validationRules);
        if(!$data = $news::find($id))
        {
            return $this->notFoundResponse();   
        }
        try
        {
            if($v->fails())
            {
                throw new \Exception("ValidationException");
            }
            if ($request->news_image !== null) {
                $image_base64 = explode(',',$request->news_image);
                $image_type = explode('/',explode(';',$image_base64[0])[0])[1];
                $image_name = 'Images/'.str_random(10).'.'.$image_type;
                if (Storage::put('public/'.$image_name, base64_decode($image_base64[1]))) {
                    $data->catnews_id = $request->catnews_id;
                    $data->editor_id = $request->editor_id;
                    $data->news_datepub = $request->news_datepub;
                    $data->news_headline = $request->news_headline;
                    $data->news_title = $request->news_title;
                    $data->news_image = $image_name;
                    $data->news_caption = $request->news_caption;
                    $data->news_description = $request->news_description;
                    $data->news_content = $request->news_content;
                    $data->news_writer = $request->news_writer;   
                }
            }else{
                $data->catnews_id = $request->catnews_id;
                $data->editor_id = $request->editor_id;
                $data->news_datepub = $request->news_datepub;
                $data->news_headline = $request->news_headline;
                $data->news_title = $request->news_title;
                $data->news_caption = $request->news_caption;
                $data->news_description = $request->news_description;
                $data->news_content = $request->news_content;
                $data->news_writer = $request->news_writer;
            }
            $data->save();
            return $this->createdResponse($news);
        }catch(\Exception $ex)
        {
            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($data);
        }
    }
    public function newsById($id,$limit){
        $data = News::where('id',$id)->first();
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
