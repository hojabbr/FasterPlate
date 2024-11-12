<?php

namespace App\Listeners;

use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Support\Facades\Artisan;

class RunIdeHelperAfterMigration
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(MigrationsEnded $event)
    {
        // Run the additional IDE helper commands
        Artisan::call('ide-helper:generate', ['-M' => true]);
        Artisan::call('ide-helper:meta');
        Artisan::call('ide-helper:models', ['-M' => true]);
    }
}
