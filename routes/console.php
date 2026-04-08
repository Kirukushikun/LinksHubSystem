<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('backup:run')
    ->dailyAt('19:00')
    ->description('Run database backup daily after working hours');

Schedule::command('backup:clean')
    ->dailyAt('05:00')
    ->description('Clean up old backups daily');

Schedule::command('backup:monitor')
    ->daily()
    ->description('Monitor backup health daily');