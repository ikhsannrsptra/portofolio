<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBadge;
use Illuminate\Http\Request;

class HeroBadgeAdminController extends Controller
{
    public function index()
    {
        $badges = HeroBadge::orderBy('order', 'asc')->get();
        return view('admin.badges.index', compact('badges'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'icon_class' => 'nullable|string|max:100',
            'icon_color' => 'nullable|string|max:30',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'badge_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/badges'), $filename);
            $validated['image'] = 'uploads/badges/' . $filename;
        }

        $validated['order'] = HeroBadge::max('order') + 1;
        HeroBadge::create($validated);

        return redirect()->route('admin.badges.index')->with('success', 'Logo keahlian mengapung berhasil ditambahkan!');
    }

    public function destroy(HeroBadge $badge)
    {
        $badge->delete();
        return redirect()->route('admin.badges.index')->with('success', 'Logo keahlian berhasil dihapus.');
    }
}
