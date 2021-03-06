<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static abstract function getModelClass();

    public function save(Request $request)
    {
        $content = $this->validate($request, [
            'id' => 'integer|min:1',
            'name' => 'required|max:100'
        ]);
        $modelClass = static::getModelClass();
        if (empty($content['id'])) {
            $model = $modelClass::where('name', $content['name'])->first();
            if ($model) {
                throw new ConflictHttpException("Model #$model->id has the same name");
            }
            return $modelClass::create(['name' => $content['name']]);
        } else {
            $id = $modelClass::where('id', $content['id'])
                ->update(['name' => $content['name']]);
            if ($id > 0) {
                return $modelClass::find($id);
            }
            $id = $content['id'];
            throw new NotFoundHttpException("Model #$id not found");
        }
    }

    public function index()
    {
        return static::getModelClass()::all();
    }

    public function show($id)
    {
        $model = static::getModelClass()::where('id', $id)->first();
        if (!$model) {
            throw new NotFoundHttpException("Model #$id not found");
        }
        return $model;
    }

    public function destroy($id)
    {
        $model = $this->show($id);
        $model->delete();
        return ['ok' => 1];
    }
}
