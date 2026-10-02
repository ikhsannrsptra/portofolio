<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Certificate;
use App\Models\Project;
use App\Models\Skill;
use App\Models\HeroRole;
use App\Models\HeroBadge;
use App\Models\Message;

class PortfolioController extends Controller
{
    /**
     * Display the main interactive portfolio page using live database records.
     */
    public function index()
    {
        $profileModel = Profile::first();

        $ensureUrl = fn($url) => $url && !str_starts_with($url, 'http') ? 'https://' . $url : $url;

        $profile = [
            'name' => $profileModel ? $profileModel->name : 'Ikhsan Nur Saputra',
            'title' => $profileModel ? $profileModel->title : 'Network Engineer',
            'status' => $profileModel ? $profileModel->status : 'Siap Menerima Project & Kolaborasi',
            'bio_short' => $profileModel ? $profileModel->bio_short : 'Information Systems student at Universitas Sriwijaya with interests in System Analysis, Web Development, and Network Engineering. Passionate about creating reliable digital solutions through technology, analysis, and innovation.',
            'bio_full' => $profileModel ? $profileModel->bio_full : null,
            'location' => $profileModel ? $profileModel->location : 'Jakarta, Indonesia',
            'avatar' => ($profileModel && $profileModel->avatar) ? asset($profileModel->avatar) : asset('assets/images/avatar.png'),
            'email' => $profileModel ? $profileModel->email : '',
            'phone' => $profileModel ? $profileModel->phone : '',
            'github_url' => $ensureUrl($profileModel ? $profileModel->github_url : 'https://github.com'),
            'linkedin_url' => $ensureUrl($profileModel ? $profileModel->linkedin_url : 'https://linkedin.com'),
            'contact_intro' => $profileModel ? $profileModel->contact_intro : 'Saya siap merespons pesan Anda secepatnya. Mari diskusikan proyek impian Anda!',
            'stats' => [
                'years_exp' => $profileModel ? $profileModel->years_exp : '5+',
                'projects_completed' => $profileModel ? $profileModel->projects_completed : '35+',
                'certificates_count' => $profileModel ? $profileModel->certificates_count : '12+',
            ],
        ];



        // Typewriter roles list
        $heroRoles = HeroRole::orderBy('order', 'asc')->pluck('name')->toArray();
        if (empty($heroRoles)) {
            $heroRoles = [$profile['title'], 'Full-Stack Developer', 'UI/UX Specialist', 'System Administrator'];
        }

        // Floating badges around avatar
        $heroBadges = HeroBadge::orderBy('order', 'asc')->get();

        $education = Education::orderBy('order', 'asc')->get();
        $experience = Experience::with('attachments')->orderBy('order', 'asc')->get();
        
        $certificates = Certificate::orderBy('order', 'asc')->get()->map(function($c) {
            return [
                'id' => $c->id,
                'title' => $c->title,
                'issuer' => $c->issuer,
                'image' => str_starts_with($c->image, 'http') ? $c->image : asset($c->image),
                'issued_year' => $c->issued_year,
            ];
        });

        $projects = Project::orderBy('order', 'asc')->get()->map(function($p) {
            return [
                'id' => $p->id,
                'title' => $p->title,
                'category' => $p->category,
                'description' => $p->description,
                'tags' => array_map('trim', explode(',', $p->tags ?? '')),
                'image' => str_starts_with($p->image, 'http') ? $p->image : asset($p->image),
                'github' => $p->github_url ?? '#',
                'demo' => $p->demo_url ?? '#',
            ];
        });

        $skills = Skill::orderBy('order', 'asc')->get();

        return view('portfolio.index', compact('profile', 'heroRoles', 'heroBadges', 'education', 'experience', 'certificates', 'projects', 'skills'));
    }

    /**
     * Handle AJAX Contact Form Submission.
     */
    public function sendContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'message' => 'required|string|min:10',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'message.required' => 'Pesan tidak boleh kosong.',
            'message.min' => 'Pesan minimal berisi 10 karakter.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pesan Anda telah berhasil dikirim! Terima kasih telah menghubungi saya.'
        ]);
    }
}
