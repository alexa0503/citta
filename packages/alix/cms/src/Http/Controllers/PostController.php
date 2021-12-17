<?php

namespace Alix\Cms\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use DB;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $perPage = $request->input('perPage') ?: 25;
        $orm = Post::orderBy('id','DESC');
        session(['redirect_uri' => url()->full()]);
        $rows = $orm->paginate($perPage);
        return view('cms::post.index', [
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
        return view('cms::post.create');
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
            'redirectUri' => session('redirect_uri', route('cms.posts.index')),
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
        $row = Post::find($id);
        return view('cms::post.edit',['item'=>$row]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Post $post
     * @return void
     */
    public function update(Request $request,Post $post)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($message = $this->handleData($request,$post)) {
            return response()->json([
                'errors' => ['body' => $message],
            ], 422);
        }

        return response()->json([
            'redirectUri' => session('redirect_uri', route('cms.posts.index')),
        ]);
    }
    
    /**
     * Undocumented function
     *
     * @param Post $post
     * @return void
     */
    public function destroy(Post $post)
    {
        DB::beginTransaction();
        try {
            $post->delete();
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
    protected function handleData($request, $post = null)
    {
        DB::beginTransaction();
        try {
            if (!$post) {
                $post = new Post;
            }
            $post->title = $request->input('title')??[];
            $post->body = $request->input('body') ?: [];
            $post->save();
            DB::commit();
        } catch (\Illuminate\Database\QueryException $exception) {
            DB::rollback();
            return $exception->errorInfo;
        }
    }
}
