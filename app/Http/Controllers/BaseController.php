<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $editable_attributes = [];
    protected $model = Model::class;

    public function create(Request $request)
    {
        $model = new $this->model;

        // TODO: validate input

        foreach ($this->editable_attributes as $attribute) {
            $model[$attribute] = $request[$attribute];
        }

        $model->save();

        return response(null, 200);
    }

    public function update()
    {
        // get input of attributes from $editable_attributes 
        // validate input 
        // find the model
        // update the model
    }
}
