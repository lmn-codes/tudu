<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use function PHPUnit\Framework\stringStartsWith;

class BaseController extends Controller
{
    protected $editable_attributes = [];
    protected $model = Model::class;

    public function index(Request $request)
    {
        $sort_attributes = explode( ',', $request->query('sort', ''));
        $query = $this->model::query();

        foreach ($sort_attributes as $attribute) {
            $attribute_name = preg_replace('/[^a-zA-Z]/', '', $attribute);

            if (in_array($attribute_name, $this->model::$sortable)) {
                $is_descending = str_starts_with($attribute, '-');
                $query->orderBy($attribute_name, $is_descending ? 'desc' : 'asc');
            } else {
                return response()->json(['error' => "{$attribute} is not sortable"], 400);
            }
        }

        return response()->json($query->paginate(25));
    }

    public function show($id)
    {
        return $this->model::findOrFail($id);
    }

    public function create(Request $request, ?array $initial_data = [])
    {
        $data = $initial_data;

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
