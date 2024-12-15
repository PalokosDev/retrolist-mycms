<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TeamMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next) {
            if (!Gate::allows('admin-or-editor')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $members = TeamMember::orderBy('created_at','desc')->get();
        return view('admin.team_members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team_members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'title' => 'nullable',
            'image_url' => 'nullable|url'
        ]);
        TeamMember::create($data);
        return redirect()->route('admin.team_members.index')->with('success','Teammitglied erstellt!');
    }

    public function edit(TeamMember $team_member)
    {
        return view('admin.team_members.edit', compact('team_member'));
    }

    public function update(Request $request, TeamMember $team_member)
    {
        $data = $request->validate([
            'name' => 'required',
            'title' => 'nullable',
            'image_url' => 'nullable|url'
        ]);
        $team_member->update($data);
        return redirect()->route('admin.team_members.index')->with('success','Teammitglied bearbeitet!');
    }

    public function destroy(TeamMember $team_member)
    {
        $team_member->delete();
        return redirect()->route('admin.team_members.index')->with('success','Teammitglied gelöscht!');
    }
}
