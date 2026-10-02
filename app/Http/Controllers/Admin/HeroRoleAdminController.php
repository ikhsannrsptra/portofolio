<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroRole;
use Illuminate\Http\Request;

class HeroRoleAdminController extends Controller
{
    public function index()
    {
        $roles = HeroRole::orderBy('order', 'asc')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $validated['order'] = HeroRole::max('order') + 1;
        HeroRole::create($validated);

        return redirect()->route('admin.roles.index')->with('success', 'Teks role profesi baru berhasil ditambahkan!');
    }

    public function destroy(HeroRole $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role profesi berhasil dihapus.');
    }
}
