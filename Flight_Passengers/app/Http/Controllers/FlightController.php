<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::query();

        // Filtering
        if ($request->has('departure_city')) {
            $query->where('departure_city', 'like', '%' . $request->input('departure_city') . '%');
        }
        if ($request->has('arrival_city')) {
            $query->where('arrival_city', 'like', '%' . $request->input('arrival_city') . '%');
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->input('per_page', 15);
        $flights = $query->paginate($perPage);

        return response($flights);
    }
    public function getUsers($flightId)
    {
        $flight = Flight::findOrFail($flightId);

        $users = $flight->passengers()->paginate(); // Adjust pagination as needed

        return response($users);
    }

}
