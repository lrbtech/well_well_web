<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_log;
use App\Models\language;
use App\Models\role;
use App\Models\shipment;
use App\Models\shipment_package;
use App\Models\system_logs;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use DB;
class logController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }
      
    public function getClientIP():string
    {
        $keys=array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR');
        foreach($keys as $k)
        {
            if (!empty($_SERVER[$k]) && filter_var($_SERVER[$k], FILTER_VALIDATE_IP))
            {
                return $_SERVER[$k];
            }
        }
        return "UNKNOWN";
    }

    public function logView(){
        $language = language::all();
        return view('admin.user_logs',compact('language'));
    }

    public function createLog($user,$data){
        $get_ip = $this->getClientIP();  
        $log = new user_log;
        $log->user_ip = $get_ip;
        $log->user = $user;
        $log->log = $data;
        $log->save();
        return true;
    }

    public function getLogView(){
        $logs = user_log::orderBy('id', 'DESC');
        return Datatables::of($logs)
        ->addColumn('user_ip', function ($logs) {
            return '<td>'.$logs->user_ip.'</td>';
        })
        ->addColumn('date', function ($logs) {
            return '<td>'.$logs->created_at.'</td>';
        })
        ->addColumn('user', function ($logs) {
            return '<td>'.$logs->user.'</td>';
        })
        ->addColumn('log', function ($logs) {
            return '<td>'.$logs->log.'</td>';
        })
        ->rawColumns(['user_ip','date', 'user', 'log'])
        //->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function getSystemLogs(){
        $systemLogs = system_logs::orderBy('id','DESC');
        return Datatables::of($systemLogs)
        ->addColumn('user_ip', function ($systemLogs) {
            return '<td>'.$systemLogs->user_ip.'</td>';
        })
        ->addColumn('user_id', function ($systemLogs) {
            if($systemLogs->category == 'shipment'){
                $shipment = shipment_package::where('shipment_id',$systemLogs->_id)->first();
                return '<td>'.$shipment->sku_value.'</td>';
            }
            else{
                return '<td>'.$systemLogs->_id.'</td>';
            }
        })
        ->addColumn('date', function ($systemLogs) {
            return '<td>'.$systemLogs->created_at.'</td>';
        })
        ->addColumn('user', function ($systemLogs) {
            return '<td>'.$systemLogs->to_id.'</td>';
        })
        ->addColumn('category', function ($systemLogs) {
            return '<td>'.$systemLogs->category.'</td>';
        })
        ->addColumn('remark', function ($systemLogs) {
            return '<td>'.$systemLogs->remark.'</td>';
        })
        ->rawColumns(['user_ip','date', 'user', 'remark','category','user_id'])
        //->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

}
