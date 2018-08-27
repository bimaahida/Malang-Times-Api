<?php namespace App\Http\Controllers;

class CategorisController extends Controller {

    const MODEL = "App\Model\Category";

    use RestControllerTrait;
    protected $validationRules = ['kategori' => 'required',];

}
