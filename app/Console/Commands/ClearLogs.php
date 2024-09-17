<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearLogs extends Command
{
    // Name and description of the command
    protected $signature = 'logs:clear';
    protected $description = 'Clear Laravel log files';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Define the log path
        $logPath = storage_path('logs');

        // Delete all .log files in the storage/logs directory
        File::cleanDirectory($logPath);

        // Notify that logs have been cleared
        $this->info('Logs have been cleared!');
    }
}
