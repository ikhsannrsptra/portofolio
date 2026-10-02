<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileAdminController extends Controller
{
    public function index()
    {
        $profile = Profile::firstOrCreate(['id' => 1], [
            'name' => 'Alex Dev',
            'title' => 'Full-Stack Developer & UI/UX Specialist',
            'status' => 'Siap Menerima Project & Kolaborasi',
            'bio_short' => 'Mengembangkan aplikasi web berkualitas tinggi.',
            'location' => 'Jakarta, Indonesia',
            'avatar' => 'assets/images/avatar.png',
        ]);

        return view('admin.profile.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'title' => 'required|string|max:150',
            'status' => 'required|string|max:150',
            'bio_short' => 'nullable|string',
            'bio_full' => 'nullable|string',
            'location' => 'nullable|string|max:100',
            'years_exp' => 'nullable|string|max:20',
            'projects_completed' => 'nullable|string|max:20',
            'certificates_count' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'phone' => 'nullable|string|max:50',
            'github_url' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|max:255',
            'contact_intro' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);


        $validated['years_exp'] = $validated['years_exp'] ?? $profile->years_exp ?? '5+';
        $validated['projects_completed'] = $validated['projects_completed'] ?? $profile->projects_completed ?? '35+';
        $validated['certificates_count'] = $validated['certificates_count'] ?? $profile->certificates_count ?? '12+';

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'avatar_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile'), $filename);
            $validated['avatar'] = 'uploads/profile/' . $filename;
        }

        $profile->update($validated);

        return redirect()->route('admin.profile.index')->with('success', 'Profil & Foto Avatar berhasil diperbarui!');
    }
}
