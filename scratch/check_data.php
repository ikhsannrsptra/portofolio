<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== EXPERIENCES ===\n";
foreach (\App\Models\Experience::with('attachments')->get() as $e) {
    echo "ID: {$e->id}\n";
    echo "Company: {$e->company}\n";
    echo "Role: {$e->role}\n";
    echo "Logo: {$e->logo}\n";
    echo "Image: {$e->image}\n";
    echo "Attachment Title: {$e->attachment_title}\n";
    echo "Attachments Count: " . $e->attachments->count() . "\n";
    foreach ($e->attachments as $att) {
        echo "   - Attachment ID: {$att->id} | Title: {$att->title} | Image: {$att->image}\n";
    }
    echo "-----------------------------------------\n";
}
