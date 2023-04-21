<?php

namespace App\Http\Controllers;

use App\Models\Backup;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\BackupHistory;
use Storage;
use Artisan;

class SettingBackupController extends Controller
{
    private $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Show the Backup & Download Settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $backups = BackupHistory::all();

        if (count($backups) >= 2) {
            $last = $backups[count($backups) - 1];
            $old = $backups[count($backups) - 2];
        } else if (count($backups) == 1) {
            $last = $backups[0];
            $old = null;
        } else {
            $last = null;
            $old = null;
        }

        return view('settings.backup.index')->with([
            'randNum' => rand(),
            'last' => $last,
            'old' => $old
        ]);
    }

    // ========================== BEGIN PUBLIC FUNCTIONS ==========================
    public function downloadCurrent()
    {
        Artisan::call('database:backup');   
        $backups = BackupHistory::all();

        if (count($backups) >= 2) {
            $last = $backups[count($backups) - 1];
            $old = $backups[count($backups) - 2];
        } else if (count($backups) == 1) {
            $last = $backups[0];
            $old = null;
        } else {
            $last = null;
            $old = null;
        }
        $dateDiff = Carbon::now()->diffInDays(date_create($last->created_at));

        return response()->json([
            'result' => 'success',
            'url' => url('/storage/backup/'),
            'last' => $last,
            'old' => $old,
            'filesize' => round($last->size / 1024, 2),
            'dateDiff' => $dateDiff
        ]);
    }

    public function changeAutoOption()
    {
        // Check Validation
        $this->request->validate([
            'auto' => ['required']
        ]);

        // Create new record
        Backup::create([
            'auto' => $this->request['auto'],
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }
    // ========================== END PUBLIC FUNCTIONS ==========================

    // ========================== BEGIN PRIVATE FUNCTIONS ==========================
// ========================== END PRIVATE FUNCTIONS ==========================
}
