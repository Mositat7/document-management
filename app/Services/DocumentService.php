<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return Document::create([
            'title'      => $data['title'],
            'type'       => $data['type'],
            'receiver'   => $data['receiver'],
            'sender'     => 'کاربر جاری', // فعلاً استاتیک
            'content'    => $data['content'],
            'code'       => $this->generateCode(),
            'status'     => 'draft',
            'created_at' => now(),
        ]);
    }

    protected function generateCode(): string
    {
        // TG-1404-XXXX
        $year = verta()->year; // سال شمسی
        $random = rand(1000, 9999);

        return "TG-{$year}-{$random}";
    }
}
