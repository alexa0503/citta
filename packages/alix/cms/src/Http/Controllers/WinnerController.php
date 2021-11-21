<?php

namespace Alix\Cms\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Winner;
use DB;
use Carbon\Carbon;

class WinnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $perPage = $request->input('perPage') ?: 25;
        $orm = Winner::orderBy('id','DESC');
        if ($request->input('keywords')) {
            $orm->where(function ($query) use ($request) {
                $query->where('mallcoo_mobile', 'LIKE', '%' . $request->input('keywords') . '%');
            });
        }
        session(['redirect_uri' => url()->full()]);
        // if ($request->input('export') == 1) {
        //     $filename = date('YmdHis') . '.csv';
        //     $fp = fopen(public_path("downloads/users_" . $filename), 'w');
        //     fwrite($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        //     $titles = ["id", "手机号","CAID","SPID","创建时间"];
        //     fputcsv($fp, $titles);
        //     $orm->chunk(30000, function ($items) use ($fp, $request) {
        //         foreach ($items as $k => $v) {
        //             $array = [
        //                 $v->id,
        //                 $v->phone,
        //                 $v->mz_ca,
        //                 $v->mz_sp,
        //                 $v->created_at
        //             ];
        //             fputcsv($fp, $array);
        //         }
        //     });
        //     fclose($fp);
        //     return response()->download("downloads/users_" . $filename);
        // }
        $users = $orm->paginate($perPage);
        return view('cms::winner.index', [
            'items' => $users,
            'setting' => \App\Models\Setting::find(1),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms::winner.create');
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
            'avatar' => 'required',
            'mobile' => 'required',
            'nickname' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        DB::beginTransaction();
        try {
            $winner = new Winner();
            $winner->mobile = $request->mobile;
            $winner->nickname = $request->nickname;
            $winner->avatar = $request->avatar;
            $winner->save();
            DB::commit();
        } catch (\Illuminate\Database\QueryException $exception) {
            DB::rollback();
            return $exception->errorInfo;
        }

        return response()->json([
            'redirectUri' => session('redirect_uri', route('cms.winners.index')),
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
        $winner = Winner::find($id);
        return view('cms::winner.edit',['item'=>$winner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'avatar' => 'required',
            'mobile' => 'required',
            'nickname' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        DB::beginTransaction();
        try {
            $winner = Winner::find($id);
            $winner->mobile = $request->mobile;
            $winner->nickname = $request->nickname;
            $winner->avatar = $request->avatar;
            $winner->save();
            DB::commit();
        } catch (\Illuminate\Database\QueryException $exception) {
            DB::rollback();
            return $exception->errorInfo;
        }

        return response()->json([
            'redirectUri' => session('redirect_uri', route('cms.winners.index')),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $winner = Winner::find(1);
        $winner->delete();
        return response()->json([]);
    }


}
