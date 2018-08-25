<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\User;

class UserController extends Controller {

    use RestControllerTrait;
    const MODEL = "App\Model\User";

    protected $validationRules  = [
        'username' => 'required',
        'password' => 'required',
        'name' => 'required',
    ];

    public function login(Request $request){
        // var_dump($request->all()['username']);
        $data = User::select('id','name','username')->where('username','=',$request->all()['username'])->where('password','=',hash('sha1', $request->all()['password']))->first();
        if ($data) {
            return $this->showResponse($data);   
        }
        return $this->notFoundResponse();
    }
    public function register(Request $request){
        $model_user =  new User();
        $v = \Validator::make($request->all(), $this->validationRules);
        try
        {
            if($v->fails())
            {
                throw new \Exception("ValidationException");
            }

            $model_user->username = $request->username;
            $model_user->password = hash('sha1', $request->username);
            $model_user->name = $request->name;
            $model_user->save();
            return $this->createdResponse($model_user);
        }catch(\Exception $ex)
        {
            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($data);
        }
    }
}
