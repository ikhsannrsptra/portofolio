<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'certificates' => Certificate::count(),
            'education' => Education::count(),
            'experience' => Experience::count(),
            'skills' => Skill::count(),
            'messages' => Message::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
        ];

        $latestProjects = Project::latest()->take(5)->get();
        $latestCerts = Certificate::latest()->take(5)->get();
        $latestMessages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestProjects', 'latestCerts', 'latestMessages'));
    }
}
