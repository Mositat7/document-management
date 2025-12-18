<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Hekmatinasser\Verta\Verta;
class DocumentService
{
    public function list(array $filters = [])
    {
        return Document::query()
            ->latest()
            ->paginate(12);
    }

    public function store(array $data)
{
    // ذخیره مستند اصلی
    $document = Document::create([
        'title'      => $data['title'],
        'type'       => $data['type'],
        'receiver'   => $data['receiver'],
        'sender'     => 'کاربر جاری',
        'body'       => $data['content'] ?? null,
        'code'       => $this->generateCode(),
        'status'     => 'draft',
        'registered_at' => now()->toDateString(),
        'created_at' => now(),
    ]);

    // ذخیره پیوست‌ها (فایل‌ها)
    if (!empty($data['attachments']) && is_array($data['attachments'])) {
        foreach ($data['attachments'] as $file) {
            if ($file && $file->isValid()) {
                // ذخیره فایل در storage/app/public/documents
                $path = $file->store('documents', 'public');

                // ذخیره اطلاعات پیوست در دیتابیس
                $document->attachments()->create([
                    'original_name' => $file->getClientOriginalName(),
                    'file_path'     => $path,
                    'size'          => $file->getSize(),
                ]);
            }
        }
    }

    return $document;
}

    protected function generateCode(): string
    {
        // TG-1404-XXXX
        $year = verta()->year; // سال شمسی
        $random = rand(1000, 9999);

        return "TG-{$year}-{$random}";
    }
}
