<?php

namespace App\Http\Controllers;

use App\Models\language;
use Illuminate\Http\Request;
use Alert;
use Artisan;
use Log;
use Storage;

class BackupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function index(){
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);

        $files = $disk->files(config('laravel-backup.backup.name'));
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }

	    $backups = array_reverse($backups);
        $language = language::all();
        //echo json_encode($backups);
        return view("admin.backup")->with(compact('backups','language'));
    }

    public function create()
    {
        try {
            /* only database backup*/
            Artisan::call('backup:run', ['--only-db'=> true,'--disable-notifications'=> true]);
            //Artisan::call('database:backup');
            //Artisan::call('backup:run',['--only-db'=>true]);
            //Artisan::call('backup:run --only-db');
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            //session()->flash('success', 'Successfully created backup!');
            return redirect()->back();
        } catch (Exception $e) {
            //session()->flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }


    // public function getDate($date_modified){
    //     return Carbon::createFromTimeStamp($date_modified,'Asia/Kolkata')->formatLocalized('%d %B %Y %H:%M');
    // }

    public static function humanFileSize($size) {
        $unit="";
        if( (!$unit && $size >= 1<<30) || $unit == "GB")
             return number_format($size/(1<<30),2)."GB";
        if( (!$unit && $size >= 1<<20) || $unit == "MB")
             return number_format($size/(1<<20),2)."MB";
        if( (!$unit && $size >= 1<<10) || $unit == "KB")
             return number_format($size/(1<<10),2)."KB";
        return number_format($size)." bytes";
  }
 
    public function download($file_name)
    {
        $file = config('laravel-backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('laravel-backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);

            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists(config('laravel-backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('laravel-backup.backup.name') . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

}
