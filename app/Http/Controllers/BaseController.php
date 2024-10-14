<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $editable_attributes = [];
    protected $model = Model::class;

    public function index()
    {
        return $this->model::paginate(25);
    }

    public function show($id)
    {
        return $this->model::findOrFail($id);
    }

    public function create(Request $request)
    {
        $data = [];

        // TODO: validate input

        foreach ($this->editable_attributes as $attribute) {
            $data[$attribute] = $request->input($attribute);
        }

        $this->model::create($data);

        return response(null, 200);
    }

    public function update(Request $request, int $id)
    {
        $model = $this->model::findOrFail($id);
        $data = [];
        // validate input 

        foreach ($this->editable_attributes as $attribute) {
            if ($request->has($attribute)) {
                $data[$attribute] = $request->input($attribute);
            }
        }

        $model->update($data);

        return response(null, 200);
    }

    public function delete(int $id)
    {
        $this->model::destroy($id);
    }
}
