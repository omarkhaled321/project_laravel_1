<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $flights = QueryBuilder::for(Flight::class)
            ->allowedFilters([
                'departure_city',
                'arrival_city',
                AllowedFilter::exact('id'),
            ])
            ->with('passengers')
            ->defaultSort('updated_at')
            ->allowedSorts([
                'id',
                'departure_city',
                'arrival_city',
                'created_at'
            ])
            ->paginate($request->input('per_page', 15));

        return response($flights);
    }

    public function show(Flight $flight)
    {
        return response($users);
    }
}
