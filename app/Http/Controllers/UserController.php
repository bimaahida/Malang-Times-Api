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

    public function Login(Request $request){
        // var_dump($request->all()['username']);
        $data = User::where('username','=',$request->all()['username'])->where('password','=',hash('sha1', $request->all()['password']))->first();
        if ($data) {
            return $this->showResponse($data);   
        }
        return $this->notFoundResponse();
    }
}
