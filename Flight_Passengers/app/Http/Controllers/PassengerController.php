<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passenger;

class PassengerController extends Controller
{
    // Display a listing of the passengers.
    public function index()
    {
        $passengers = Passenger::all();
        return response($passengers);
    }

    // Show the form for creating a new passenger.
    public function create()
    {
        // Typically used to return a view for creating a passenger
    }

    // Store a newly created passenger in storage.
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers,email',
            'phone' => 'required|string|max:15',
            // Add other fields as necessary
        ]);

        $passenger = Passenger::create($data);

        return response($passenger, 201);
    }

    // Display the specified passenger.
    public function show($id)
    {
        $passenger = Passenger::findOrFail($id);
        return response($passenger);
    }

    // Show the form for editing the specified passenger.
    public function edit($id)
    {
        // Typically used to return a view for editing a passenger
    }

    // Update the specified passenger in storage.
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:passengers,email,' . $id,
            'phone' => 'sometimes|required|string|max:15',
            // Add other fields as necessary
        ]);

        $passenger = Passenger::findOrFail($id);
        $passenger->update($data);

        return response($passenger);
    }

    // Remove the specified passenger from storage.
    public function destroy($id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->delete();

        return response(['message' => 'Passenger deleted successfully']);
    }
}
