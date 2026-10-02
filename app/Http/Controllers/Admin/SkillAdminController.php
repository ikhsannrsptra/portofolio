<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillAdminController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('order', 'asc')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'icon_class' => 'nullable|string|max:150',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp,gif|max:3072',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'skill_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/skills'), $filename);
            $validated['image'] = 'uploads/skills/' . $filename;
        }

        if (empty($validated['order'])) {
            $validated['order'] = (Skill::max('order') ?? 0) + 1;
        }

        Skill::create($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Teknologi & Keahlian baru berhasil ditambahkan!');
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'icon_class' => 'nullable|string|max:150',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp,gif|max:3072',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'skill_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/skills'), $filename);
            $validated['image'] = 'uploads/skills/' . $filename;
        }

        $skill->update($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Teknologi & Keahlian berhasil diperbarui!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Teknologi & Keahlian berhasil dihapus.');
    }
}
