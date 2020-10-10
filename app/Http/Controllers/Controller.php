<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\BaseModel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    static abstract function getModelClass();

    public function save(Request $request)
    {
        $content = $this->validate($request, [
            'id' => 'integer|min:1',
            'name' => 'required|max:100'
        ]);
        $modelClass = static::getModelClass();
        if (empty($content['id'])) {
            return $modelClass::create(['name' => $content['name']]);
        } else {
            $id = $modelClass::where('id', $content['id'])
                ->update(['name' => $content['name']]);
            if ($id > 0) {
                return $modelClass::find($id);
            }
            throw new NotFoundHttpException("Model #" . $content['id'] . " not found");
        }
    }

    public function index()
    {
        return static::getModelClass()::all();
    }

    public function show($id)
    {
        return static::getModelClass()::firstOrFail($id);
    }

    public function destroy($id)
    {
        $model = static::getModelClass()::firstOrFail($id);
        $model->delete();
    }
}
