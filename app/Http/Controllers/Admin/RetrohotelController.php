<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Retrohotel;
use Illuminate\Http\Request;

class RetrohotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!\Illuminate\Support\Facades\Gate::allows('admin-or-editor')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $retrohotels = Retrohotel::orderBy('created_at','desc')->get();
        return view('admin.retrohotels.index', compact('retrohotels'));
    }

    public function create()
    {
        return view('admin.retrohotels.create');
    }

    public function store(Request $request)
    {
    $data = $request->validate([
        'name' => 'required',
        'logo_url' => 'required|url',
        'background_url' => 'nullable|url',
        'user_count' => 'required|integer|min:0',
        'hotel_link' => 'nullable|url',
        'maintenance_mode' => 'boolean', // Validation für das neue Feld
    ]);

    Retrohotel::create($data);

    return redirect()->route('admin.retrohotels.index')->with('success', 'Retrohotel erstellt!');
}

    public function edit(Retrohotel $retrohotel)
    {
        return view('admin.retrohotels.edit', compact('retrohotel'));
    }

    public function update(Request $request, Retrohotel $retrohotel)
    {
    $data = $request->validate([
        'name' => 'required',
        'logo_url' => 'required|url',
        'background_url' => 'nullable|url',
        'user_count' => 'required|integer|min:0',
        'hotel_link' => 'nullable|url',
        'maintenance_mode' => 'boolean', // Validation für das neue Feld
    ]);

    $retrohotel->update($data);

    return redirect()->route('admin.retrohotels.index')->with('success', 'Retrohotel aktualisiert!');
    }

    public function destroy(Retrohotel $retrohotel)
    {
        $retrohotel->delete();
        return redirect()->route('admin.retrohotels.index')->with('success','Gelöscht!');
    }
}
