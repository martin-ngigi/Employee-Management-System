<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use App\Models\Country;
use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class EmployeeStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $ke = Country::where('country_code', 'KE')->withCount('employees')->first();
        $us = Country::where('country_code', 'US')->withCount('employees')->first();
        return [
            /**
             * "$ke? $ke->employees_count : 0" means
             * if($ke is not null){
             *   $ke->employees_count
             * }
             * else {
             *   $ke->0
             * }
             */
            Card::make('All Employees', Employee::all()->count()),
            Card::make('Kenya Employees',$ke? $ke->employees_count : 0),
            Card::make('US Employees',$us? $us->employees_count: 0),
        ];
    }
}
