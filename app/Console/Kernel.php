<?php

namespace App\Console;

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
        'App\Console\Commands\TareaClienteCumpleanio',
        'App\Console\Commands\TareaCambioAceite',
        'App\Console\Commands\TareaLicenciaVencida',
        'App\Console\Commands\TareaRevisionTecnicaVencida',
        'App\Console\Commands\TareaSoatVencida',
        'App\Console\Commands\TareaNotificacionCambioAceite',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('tarea:clientecumpleanios')->dailyAt('9:01');
        $schedule->command('tarea:soatvencido')->dailyAt('9:01');
        $schedule->command('tarea:reviciontecnicavencida')->dailyAt('9:01');
        $schedule->command('tarea:licenciavencido')->dailyAt('9:01');
        $schedule->command('tarea:cambioaciete')->everyMinute();
        $schedule->command('tarea:cambioaceitex2')->cron('0 */72 * * *');
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
