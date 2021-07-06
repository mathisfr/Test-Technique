<?php

namespace App\Console;

use App\Console\Commands\ApiToDatabase;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ApiToDatabase::class, // Commande Artisan pour faire une nouvelle requête à l'api
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Pour avoir cette fonctionnalité vous devez exécuter la commande "php artisan shedule:work"
        $schedule->command(ApiToDatabase::class)->everySixHours(); // Exécuter la commande toutes les 6 heures
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
