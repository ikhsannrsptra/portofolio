<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Certificate;
use App\Models\Project;
use App\Models\Skill;
use App\Models\HeroRole;
use App\Models\HeroBadge;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123456'),
            ]
        );

        // 2. Profile Record
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Ikhsan Nur Saputra',
                'title' => 'Network Engineer',
                'status' => 'Siap Menerima Project & Kolaborasi',
                'bio_short' => 'Mengembangkan infrastruktur jaringan, aplikasi web berbasis PHP Laravel & React berkualitas tinggi.',
                'location' => 'Jakarta, Indonesia',
                'email' => 'ikhsan.dev@gmail.com',
                'phone' => '+62 812-3456-7890',
                'avatar' => 'assets/images/avatar.png',
                'years_exp' => '5+',
                'projects_completed' => '35+',
                'certificates_count' => '12+',
            ]
        );

        // 3. Hero Roles (Typewriter Texts)
        if (HeroRole::count() === 0) {
            HeroRole::create(['name' => 'Network Engineer', 'order' => 1]);
            HeroRole::create(['name' => 'Full-Stack Developer', 'order' => 2]);
            HeroRole::create(['name' => 'UI/UX Specialist', 'order' => 3]);
            HeroRole::create(['name' => 'System Administrator', 'order' => 4]);
        }

        // 4. Hero Floating Badges
        if (HeroBadge::count() === 0) {
            HeroBadge::create(['name' => 'Laravel', 'icon_class' => 'fab fa-laravel', 'icon_color' => '#ff2d20', 'order' => 1]);
            HeroBadge::create(['name' => 'PHP 8.2', 'icon_class' => 'fab fa-php', 'icon_color' => '#777bb4', 'order' => 2]);
            HeroBadge::create(['name' => 'React.js', 'icon_class' => 'fab fa-react', 'icon_color' => '#61dafb', 'order' => 3]);
            HeroBadge::create(['name' => 'Figma', 'icon_class' => 'fab fa-figma', 'icon_color' => '#f24e1e', 'order' => 4]);
        }

        // 5. Education Records (Kuliah, SMK, SMP)
        if (Education::count() === 0) {
            Education::create([
                'level' => 'Kuliah',
                'period' => '2020 - 2024',
                'title' => 'S1 Teknik Informatika / Computer Science',
                'institution' => 'Universitas Teknologi Indonesia',
                'description' => 'Lulus dengan predikat Cum Laude (IPK 3.85). Berfokus pada Rekayasa Perangkat Lunak, Jaringan Komputer, dan Sistem Terdistribusi.',
                'badge_color' => 'var(--accent-cyan)',
                'order' => 1,
            ]);

            Education::create([
                'level' => 'SMK',
                'period' => '2017 - 2020',
                'title' => 'SMK Rekayasa Perangkat Lunak / TKJ',
                'institution' => 'SMK Negeri 1 Teknologi',
                'description' => 'Mempelajari dasar jaringan, Cisco, MikroTik, C++, HTML, CSS, JavaScript, PHP, MySQL, dan meraih Juara 1 LKS Tingkat Provinsi.',
                'badge_color' => 'var(--accent-primary)',
                'order' => 2,
            ]);

            Education::create([
                'level' => 'SMP',
                'period' => '2014 - 2017',
                'title' => 'Sekolah Menengah Pertama (SMP)',
                'institution' => 'SMP Negeri 1 Favorit',
                'description' => 'Aktif dalam ekstrakulikuler Komputer & Robotik. Menjadi ketua klub sains dan mempelajari logika dasar komputer.',
                'badge_color' => 'var(--accent-purple)',
                'order' => 3,
            ]);
        }

        // 6. Experience Records
        if (Experience::count() === 0) {
            Experience::create([
                'period' => '2024 - Sekarang',
                'role' => 'Network Engineer & Full-Stack Lead',
                'company' => 'TechNova Solutions Inc.',
                'description' => 'Memimpin infrastruktur jaringan dan pengembangan platform microservices berbasis Laravel dan React.',
                'color' => 'var(--accent-purple)',
                'order' => 1,
            ]);

            Experience::create([
                'period' => '2022 - 2024',
                'role' => 'Frontend React & UI/UX Developer',
                'company' => 'Digital Pulse Studio',
                'description' => 'Merancang dan mengimplementasikan antarmuka aplikasi web e-commerce dan dashboard analitik.',
                'color' => 'var(--accent-emerald)',
                'order' => 2,
            ]);

            Experience::create([
                'period' => '2021 - 2022',
                'role' => 'Junior Web Developer Intern',
                'company' => 'CyberCraft Software House',
                'description' => 'Mengembangkan fitur-fitur baru pada portal klien menggunakan PHP Laravel dan JavaScript.',
                'color' => 'var(--accent-gold)',
                'order' => 3,
            ]);
        }

        // 7. Certificates
        if (Certificate::count() === 0) {
            Certificate::create([
                'title' => 'Full-Stack Web Development Expert Certificate',
                'issuer' => 'International Tech Academy (2024)',
                'image' => 'assets/images/cert1.png',
                'issued_year' => '2024',
                'order' => 1,
            ]);

            Certificate::create([
                'title' => '1st Place Winner - National UI/UX Competition',
                'issuer' => 'Digital Innovation Hackathon (2023)',
                'image' => 'assets/images/cert2.png',
                'issued_year' => '2023',
                'order' => 2,
            ]);

            Certificate::create([
                'title' => 'Cloud Architecture & AWS Certified Associate',
                'issuer' => 'Global Cloud Institute (2023)',
                'image' => 'assets/images/cert1.png',
                'issued_year' => '2023',
                'order' => 3,
            ]);
        }

        // 8. Projects
        if (Project::count() === 0) {
            Project::create([
                'title' => 'Nexus Cyber E-Commerce',
                'category' => 'web',
                'description' => 'Platform belanja online futuristik berbasis Laravel & Next.js dengan dukungan pembayaran otomatis dan animasi smooth.',
                'tags' => 'Laravel, React.js, Tailwind, Stripe API',
                'image' => 'assets/images/project1.png',
                'github_url' => 'https://github.com',
                'order' => 1,
            ]);

            Project::create([
                'title' => 'Aether AI Analytics Dashboard',
                'category' => 'ai',
                'description' => 'Dashboard analitik bisnis berbasis AI untuk prediksi tren penjualan dan visualisasi grafik interaktif.',
                'tags' => 'Python, FastAPI, Chart.js, TensorFlow',
                'image' => 'assets/images/project2.png',
                'github_url' => 'https://github.com',
                'order' => 2,
            ]);

            Project::create([
                'title' => 'Pulse Fitness Mobile App',
                'category' => 'mobile',
                'description' => 'Aplikasi pelacak kebugaran dan kalori harian untuk Android & iOS dengan sinkronisasi detak jantung.',
                'tags' => 'React Native, Firebase, UI/UX',
                'image' => 'assets/images/project3.png',
                'github_url' => 'https://github.com',
                'order' => 3,
            ]);
        }

        // 9. Skills
        if (Skill::count() === 0) {
            Skill::create(['category' => 'frontend', 'name' => 'HTML5 / CSS3 / JavaScript (ES6+)', 'progress' => 95, 'order' => 1]);
            Skill::create(['category' => 'frontend', 'name' => 'React.js / Next.js / Vue.js', 'progress' => 90, 'order' => 2]);
            Skill::create(['category' => 'frontend', 'name' => 'Tailwind CSS / Sass / Responsive UI', 'progress' => 92, 'order' => 3]);

            Skill::create(['category' => 'backend', 'name' => 'PHP 8.2 / Laravel Framework', 'progress' => 94, 'order' => 1]);
            Skill::create(['category' => 'backend', 'name' => 'Node.js / Express.js', 'progress' => 88, 'order' => 2]);
            Skill::create(['category' => 'backend', 'name' => 'MySQL / PostgreSQL / SQLite', 'progress' => 90, 'order' => 3]);

            Skill::create(['category' => 'design_tools', 'name' => 'Figma / UI UX Wireframing', 'progress' => 90, 'order' => 1]);
            Skill::create(['category' => 'design_tools', 'name' => 'Git / GitHub Version Control', 'progress' => 94, 'order' => 2]);
            Skill::create(['category' => 'design_tools', 'name' => 'Docker / CI CD Deployment', 'progress' => 80, 'order' => 3]);
        }
    }
}
