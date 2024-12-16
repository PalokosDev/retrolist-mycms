<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Retrohotel;
use Illuminate\Http\Request;

class RetrohotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retrohotels = Retrohotel::all();
        return view('admin.retrohotels.index', compact('retrohotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.retrohotels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'required|url',
            'background_url' => 'nullable|url',
            'user_count' => 'required|integer|min:0',
            'hotel_link' => 'nullable|url',
            'maintenance_mode' => 'boolean',
            'is_retro_of_the_month' => 'boolean', // Validation for Retro of the Month
        ]);

        // Ensure only one Retrohotel can be "Retro of the Month"
        if (!empty($data['is_retro_of_the_month'])) {
            Retrohotel::where('is_retro_of_the_month', true)->update(['is_retro_of_the_month' => false]);
        }

        Retrohotel::create($data);

        return redirect()->route('admin.retrohotels.index')->with('success', 'Retrohotel created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Retrohotel  $retrohotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Retrohotel $retrohotel)
    {
        return view('admin.retrohotels.edit', compact('retrohotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Retrohotel  $retrohotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retrohotel $retrohotel)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'required|url',
            'background_url' => 'nullable|url',
            'user_count' => 'required|integer|min:0',
            'hotel_link' => 'nullable|url',
            'maintenance_mode' => 'boolean',
            'is_retro_of_the_month' => 'boolean', // Validation for Retro of the Month
        ]);

        // Ensure only one Retrohotel can be "Retro of the Month"
        if (!empty($data['is_retro_of_the_month'])) {
            Retrohotel::where('is_retro_of_the_month', true)->update(['is_retro_of_the_month' => false]);
        }

        $retrohotel->update($data);

        return redirect()->route('admin.retrohotels.index')->with('success', 'Retrohotel updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Retrohotel  $retrohotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retrohotel $retrohotel)
    {
        $retrohotel->delete();

        return redirect()->route('admin.retrohotels.index')->with('success', 'Retrohotel deleted successfully!');
    }
}
