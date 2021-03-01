<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_log;
use App\Models\language;
use Auth;
class logController extends Controller
{
    public function logView(){
        $logs = user_log::orderBy('id', 'DESC')->get();
         $language = language::all();
        return view('admin.user_logs',compact('logs','language'));
    }

    public function createLog($user,$data){
        $log = new user_log;
        $log->user = $user;
        $log->log = $data;
        $log->save();
        return true;
    }
}
