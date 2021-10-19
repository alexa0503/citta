<?php

namespace Alix\Cms\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use DB;
use Carbon\Carbon;

class SettingController extends Controller
{
    
    public function __construct(){
        $this->middleware(function(){
            if(auth('alix-cms')->user()->id !== 1){
                abort(404);
            }
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $perPage = $request->input('perPage') ?: 25;
        $orm = Setting::orderBy('id','DESC');
        session(['redirect_uri' => url()->full()]);
        $rows = $orm->paginate($perPage);
        return view('cms::setting.index', [
            'items' => $rows,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms::setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($message = $this->handleData($request)) {
            return response()->json([
                'errors' => ['body' => $message],
            ], 422);
        }

        return response()->json([
            'redirectUri' => session('redirect_uri', route('cms.settings.index')),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Setting::find($id);
        return view('cms::setting.edit',['item'=>$row]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Setting $setting
     * @return void
     */
    public function update(Request $request,Setting $setting)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($message = $this->handleData($request,$setting)) {
            return response()->json([
                'errors' => ['body' => $message],
            ], 422);
        }

        return response()->json([
            'redirectUri' => session('redirect_uri', route('cms.settings.index')),
        ]);
    }
    
    /**
     * Undocumented function
     *
     * @param Setting $setting
     * @return void
     */
    public function destroy(Setting $setting)
    {
        if($setting->id <= 3){
            return [];
        }
        DB::beginTransaction();
        try {
            $setting->delete();
            DB::commit();
            return response([]);
        } catch (\Illuminate\Database\QueryException $exception) {
            DB::rollback();
            return $exception->errorInfo;
        }
    }


    /**
     * 数据处理
     */
    protected function handleData($request, $setting = null)
    {
        DB::beginTransaction();
        try {
            if (!$setting) {
                $setting = new Setting;
            }
            $setting->title = $request->input('title')??[];
            $setting->name = $request->input('name');
            $setting->descr = $request->input('descr') ?: [];
            $setting->image = $request->input('image') ?: [];
            $setting->body = $request->input('body') ?: [];
            $setting->link_type = $request->input('link_type');
            $setting->link = $request->input('link');
            $setting->save();
            DB::commit();
        } catch (\Illuminate\Database\QueryException $exception) {
            DB::rollback();
            return $exception->errorInfo;
        }
    }
}
