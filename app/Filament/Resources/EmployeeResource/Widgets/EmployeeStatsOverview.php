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
            Card::make('All Employees', Employee::all()->count()),
            Card::make($ke->name.' Employees', $ke->employees_count),
            Card::make($us->name.' Employees', $us->employees_count),
        ];
    }
}
