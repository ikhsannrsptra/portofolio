<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\ExperienceAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExperienceAdminController extends Controller
{
    public function index()
    {
        $experiences = Experience::with('attachments')->orderBy('order', 'asc')->get();
        return view('admin.experience.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experience.form', ['experience' => new Experience()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'period' => 'required|string|max:100',
            'role' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
            'color' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'attachment_title' => 'nullable|string|max:255',
        ]);

        if (empty($validated['color'])) {
            $validated['color'] = 'var(--accent-purple)';
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'exp_' . time() . '_' . Str::slug($validated['company']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/experience'), $filename);
            $validated['logo'] = 'uploads/experience/' . $filename;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'doc_' . time() . '_' . Str::slug($validated['company']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/experience'), $filename);
            $validated['image'] = 'uploads/experience/' . $filename;
        }

        $validated['order'] = Experience::max('order') + 1;
        $experience = Experience::create($validated);

        // If an initial image was uploaded, also create a primary attachment record
        if (!empty($validated['image'])) {
            $experience->attachments()->create([
                'title' => $validated['attachment_title'] ?: ($validated['role'] . ' — Sertifikat / Dokumentasi'),
                'subtitle' => $validated['period'],
                'description' => $validated['description'],
                'image' => $validated['image'],
            ]);
        }

        return redirect()->route('admin.experience.attachments', $experience->id)->with('success', 'Pengalaman kerja berhasil ditambahkan! Silakan tambahkan sertifikat/foto kegiatan lainnya di bawah ini.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experience.form', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'period' => 'required|string|max:100',
            'role' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
            'color' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'attachment_title' => 'nullable|string|max:255',
        ]);

        if (empty($validated['color'])) {
            $validated['color'] = 'var(--accent-purple)';
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'exp_' . time() . '_' . Str::slug($validated['company']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/experience'), $filename);
            $validated['logo'] = 'uploads/experience/' . $filename;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'doc_' . time() . '_' . Str::slug($validated['company']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/experience'), $filename);
            $validated['image'] = 'uploads/experience/' . $filename;

            $experience->attachments()->create([
                'title' => $validated['attachment_title'] ?: ($validated['role'] . ' — Sertifikat / Dokumentasi'),
                'subtitle' => $validated['period'],
                'description' => $validated['description'],
                'image' => $validated['image'],
            ]);
        }

        $experience->update($validated);

        return redirect()->route('admin.experience.index')->with('success', 'Pengalaman kerja berhasil diperbarui!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experience.index')->with('success', 'Pengalaman kerja berhasil dihapus.');
    }

    /**
     * Manage attachments/certificates for a specific experience.
     */
    public function attachments(Experience $experience)
    {
        $experience->load('attachments');
        return view('admin.experience.attachments', compact('experience'));
    }

    public function storeAttachment(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'attachment_' . time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/experience'), $filename);
            $validated['image'] = 'uploads/experience/' . $filename;
        }

        $validated['order'] = $experience->attachments()->max('order') + 1;
        $experience->attachments()->create($validated);

        return redirect()->route('admin.experience.attachments', $experience->id)->with('success', 'Lampiran sertifikat / kegiatan baru berhasil ditambahkan!');
    }

    public function destroyAttachment(ExperienceAttachment $attachment)
    {
        $experienceId = $attachment->experience_id;
        $attachment->delete();
        return redirect()->route('admin.experience.attachments', $experienceId)->with('success', 'Lampiran berhasil dihapus.');
    }
}
