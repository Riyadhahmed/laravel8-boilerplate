<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use View;
use Artisan;
use Log;
use Storage;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view("backend.admin.backup.index");
    }


    public function getAll()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));
        $backups = [];

        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top

        $backups = array_reverse($backups);
        return Datatables::of($backups)
            ->addColumn('file_name', function ($backups) {
                return $backups['file_name'];
            })
            ->addColumn('file_size', function ($backups) {
                return $this->formatBytes($backups['file_size']); // $backups['file_size'];
            })
            ->addColumn('created_at', function ($backups) {
                return date('F d, Y h:i:s A', $backups['last_modified']);
            })
            ->addColumn('time_elapsed', function ($backups) {
                $dt = Carbon::parse(date('F d, Y h:i:s A', $backups['last_modified']));
                return $dt->diffForHumans();
            })
            ->addColumn('time', function ($backups) {
                return $backups['last_modified'];
            })
            ->addColumn('action', 'backend.admin.backup.dbaction')
            ->rawColumns(['file_path', 'file_size', 'time_elapsed', 'action'])
            ->make(true);
    }

    function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function db_backup()
    {
        try {
            // start the backup process
            Artisan::call('backup:run', ['--only-db' => true]);
            $output = Artisan::output();
            Log::info("new backup started from admin interface \r\n" . $output);
            return response()->json(['type' => 'success', 'message' => 'Successfully Created']);
        } catch (Exception $e) {
            return response()->json(['type' => 'danger', 'message' => $e->getMessage()]);
        }
    }

    public function full_backup()
    {
        try {
            // start the backup process
            Artisan::call('backup:run');
            $output = Artisan::output();
            Log::info("new backup started from admin interface \r\n" . $output);
            return response()->json(['type' => 'success', 'message' => 'Successfully Created']);
        } catch (Exception $e) {
            return response()->json(['type' => 'danger', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
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
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
            return response()->json(['type' => 'success', 'message' => 'Successfully Deleted']);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
}
