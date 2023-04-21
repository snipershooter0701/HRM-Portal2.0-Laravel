<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\BackupHistory;
use Storage;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $oldBackup = BackupHistory::get()->last();

        $filename = "backup-" . Carbon::now()->format('Y-m-d') . '-' . ($oldBackup != null ? ($oldBackup['id'] + 1) : 1) . ".sql";
        $command = "F:\\Xampp_8\mysql\bin\mysqldump.exe --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . " > " . storage_path() . "/app/public/backup/" . $filename;
        $returnVar = NULL;
        $output = NULL;

        system($command, $output);

        // Create new history
        $size = Storage::disk('local')->size('/public/backup/' . $filename);
        $backupHistory = BackupHistory::create([
            'name' => $filename,
            'size' => $size
        ]);

        $dateDiff = Carbon::now()->diffInDays(date_create($backupHistory->created_at));
        
        return Command::SUCCESS;
    }
}
