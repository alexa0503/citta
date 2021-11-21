<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request, $name = null)
    {
        if (!$name) {
            $name = 'file';
        }
        if(!$request->file($name)){
            return response('无效的图片',500);
        }
        if ($request->file($name)->isValid() ) {
            $path = $request->file($name)->storeAs(
                'uploads/' . $name . 's',
                uniqid() . '.' . $request->file($name)->extension()
            );
            return response()->json([
                'code' => 0,
                'path' => $path,
            ]);
        } else {
            return response('无效的图片',500);
        }
    }
}
