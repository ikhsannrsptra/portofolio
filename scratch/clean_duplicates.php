<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

foreach (\App\Models\ExperienceAttachment::with('experience')->get() as $att) {
    if ($att->experience && trim($att->description) === trim($att->experience->description)) {
        $att->description = null;
        $att->save();
        echo "Cleaned duplicate description for Attachment ID {$att->id}\n";
    }
}

echo "Clean up done!\n";
