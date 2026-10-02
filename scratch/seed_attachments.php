<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Auto-migrate any experience with 'image' to experience_attachments table
foreach (\App\Models\Experience::all() as $exp) {
    if (!empty($exp->image) && $exp->attachments()->count() === 0) {
        $exp->attachments()->create([
            'title' => $exp->attachment_title ?: ($exp->role . ' — Sertifikat / Dokumentasi'),
            'subtitle' => $exp->period,
            'description' => $exp->description,
            'image' => $exp->image,
            'order' => 1,
        ]);
        echo "Migrated single image for Experience ID {$exp->id}\n";
    }
}

// Add sample sub-attachments for HIMSI UNSRI (Experience ID 2) if it exists
$himsi = \App\Models\Experience::where('company', 'LIKE', '%HIMSI%')->first();
if ($himsi && $himsi->attachments()->count() < 2) {
    // Add sample certificate items if available or using existing cert images
    $cert1 = \App\Models\Certificate::first();
    $cert2 = \App\Models\Certificate::skip(1)->first();
    
    $img1 = $cert1 ? $cert1->image : 'assets/images/cert1.png';
    $img2 = $cert2 ? $cert2->image : 'assets/images/cert2.png';

    \App\Models\ExperienceAttachment::firstOrCreate([
        'experience_id' => $himsi->id,
        'title' => 'Academic Staff – Research and Technology Department',
    ], [
        'subtitle' => 'Feb 2025 - Dec 2025 · Contract',
        'description' => 'Bertanggung jawab dalam mencari, mengelola, dan menyebarkan informasi akademik kampus, seperti informasi lomba, webinar, kegiatan akademik, serta peluang beasiswa.',
        'image' => $img1,
        'order' => 1,
    ]);

    \App\Models\ExperienceAttachment::firstOrCreate([
        'experience_id' => $himsi->id,
        'title' => 'Competition Staff – SI FEST 2025',
    ], [
        'subtitle' => 'Nov 2025 · 1 mo',
        'description' => 'Berperan sebagai Staff Competition dalam rangkaian kegiatan SI FEST 2025 yang diselenggarakan oleh HIMSI FASILKOM Universitas Sriwijaya.',
        'image' => $img2,
        'order' => 2,
    ]);

    \App\Models\ExperienceAttachment::firstOrCreate([
        'experience_id' => $himsi->id,
        'title' => 'Academic Committee Member – PKKMB Information Systems 2025',
    ], [
        'subtitle' => 'Aug 2025 · 1 mo',
        'description' => 'Berperan sebagai Panitia Akademik dalam kegiatan PKKMB Jurusan Sistem Informasi 2025.',
        'image' => $img1,
        'order' => 3,
    ]);

    echo "Seeded 3 sub-attachments for HIMSI UNSRI!\n";
}

echo "Done!\n";
