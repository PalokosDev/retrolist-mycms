<?php

namespace App\Http\Controllers;

use App\Models\Retrohotel;
use Illuminate\Http\Request;

class RetroListController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort','desc');
        $retrohotels = Retrohotel::orderBy('user_count',$sort)->get();
        return view('retroliste', compact('retrohotels','sort'));
    }
}
