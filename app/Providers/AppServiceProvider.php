<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\role;
use Auth;
use App\Models\language;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('admin.layouts', function($view) {
    
            $role_get = role::find(Auth::guard('admin')->user()->role_id);
            // $language = language::all();
            // $en = ['Dashboard'];
            // $ar = ['Dashboard1'];
            // $language = array('en'=>$en,'ar'=>$ar);
            // $request->session()->put('language', 'english');
            $view->with(compact('role_get'));
        });
    }
}
