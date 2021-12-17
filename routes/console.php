<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use  App\Models\Visitor;
use  App\Models\Report;
Artisan::command('report:create {n?}', function(){
    $n = $this->argument('n') ?: 30;
    for ($i = 0; $i <= $n; $i++) {
        $date = Carbon::today()->addDays(-1 * ($n - $i))->format('Y-m-d');
        // $data1['label'][] = $date;
        $data['PV'] =Visitor::whereRaw('DATE_FORMAT(created_at,"%Y-%m-%d") = ?', $date)->count();
        $data['UV'] = Visitor::whereRaw('DATE_FORMAT(created_at,"%Y-%m-%d") = ?', $date)->distinct('created_ip')->count();

        // $data['BOOK_PV'] = Visitor::whereRaw('DATE_FORMAT(created_at,"%Y-%m-%d") = ?', $date)->where('model_type','App\Book')->count();
        // $data['BOOK_UV'] = Visitor::whereRaw('DATE_FORMAT(created_at,"%Y-%m-%d") = ?', $date)->where('model_type','App\Book')->distinct('created_ip')->count();
        $report = Report::where('reported_date',$date)->first();
        $this->info($date);
        if(!$report){
            $report = new Report();
        }
        $report->pv = $data['PV'];
        $report->uv = $data['UV'];
        // $report->booking_pv = $data['BOOK_PV'];
        // $report->booking_uv = $data['BOOK_UV'];
        $report->reported_date = $date;
        $report->save();
    }
});