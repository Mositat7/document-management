<?php

namespace App\Services\Document;

use App\Models\Document;
use Hekmatinasser\Verta\Verta;

class DocumentCodeGenerator
{
    public function generate(): string
    {
        $year = (new Verta())->year; // سال شمسی

        $lastDocument = Document::whereYear('created_at', now()->year)
            ->latest('id')
            ->first();

        $lastNumber = $lastDocument
            ? intval(substr($lastDocument->code, -4))
            : 0;

        $newNumber = $lastNumber + 1;

        return sprintf('TG-%d-%04d', $year, $newNumber);
    }
}
