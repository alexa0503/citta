<?php

namespace Alix\Cms\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use DB;
use Carbon\Carbon;

class AppointmentController extends Controller
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
        $orm = Appointment::orderBy('id','DESC');
        session(['redirect_uri' => url()->full()]);
        $rows = $orm->paginate($perPage);
        return view('cms::appointment.index', [
            'items' => $rows,
        ]);
    }
}