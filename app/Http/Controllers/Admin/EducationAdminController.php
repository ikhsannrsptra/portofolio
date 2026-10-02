<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EducationAdminController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('order', 'asc')->get();
        return view('admin.education.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.education.form', ['education' => new Education()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'level' => 'required|string|max:50',
            'period' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'edu_' . time() . '_' . Str::slug($validated['institution']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/education'), $filename);
            $validated['logo'] = 'uploads/education/' . $filename;
        }

        $validated['order'] = Education::max('order') + 1;
        Education::create($validated);

        return redirect()->route('admin.education.index')->with('success', 'Riwayat pendidikan & logo sekolah berhasil ditambahkan!');
    }

    public function edit(Education $education)
    {
        return view('admin.education.form', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'level' => 'required|string|max:50',
            'period' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'edu_' . time() . '_' . Str::slug($validated['institution']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/education'), $filename);
            $validated['logo'] = 'uploads/education/' . $filename;
        }

        $education->update($validated);

        return redirect()->route('admin.education.index')->with('success', 'Riwayat pendidikan & logo sekolah berhasil diperbarui!');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('admin.education.index')->with('success', 'Riwayat pendidikan berhasil dihapus.');
    }
}
