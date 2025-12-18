<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DocumentService;
use App\Models\Document;
use App\Models\DocumentAttachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
class DocumentController extends Controller
{
    public function __construct(
        protected DocumentService $documentService
    ) {}

    public function index(Request $request)
    {
    $filters = Arr::only($request->all(), ['search', 'type', 'sender', 'receiver', 'from_date', 'to_date']);
    $documents = $this->documentService->list($filters);
    return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:letter,document',
            'receiver' => 'required|string',
            'content' => 'nullable|string',
            'attachments' => 'nullable|array',

            'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,zip|max:10240',
        ]);

        $this->documentService->store($request->all());
        return redirect()->route('documents.index')->with('success', 'مستند با موفقیت ثبت شد.');
    }

    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        // فقط پیش‌نویس‌ها قابل ویرایش هستن
        if ($document->status !== 'draft') {
            abort(403, 'این مستند قابل ویرایش نیست.');
        }
        return view('documents.edit', compact('document'));
    }

   public function update(Request $request, Document $document)
{
    if ($document->status !== 'draft') {
        abort(403);
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'type' => 'required|in:letter,document',
        'receiver' => 'required|string',
        'content' => 'nullable|string',
        'attachments' => 'nullable|array',
        'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,zip|max:10240',
    ]);

    // آپدیت فیلدهای اصلی
    $document->update([
        'title' => $request->title,
        'type' => $request->type,
        'receiver' => $request->receiver,
        'body' => $request->content,
        'registered_at' => now()->toDateString(),
    ]);

    // ذخیره پیوست‌های جدید (اگر آپلود شده باشن)
    if (!empty($request->file('attachments'))) {
        foreach ($request->file('attachments') as $file) {
            if ($file && $file->isValid()) {
                $path = $file->store('documents', 'public');
                $document->attachments()->create([
                    'original_name' => $file->getClientOriginalName(),
                    'file_path'     => $path,
                    'size'          => $file->getSize(),
                ]);
            }
        }
    }

    return redirect()->route('documents.index')->with('success', 'مستند با موفقیت به‌روزرسانی شد.');
}

    public function download(Document $document, DocumentAttachment $attachment)
    {
        if ($attachment->document_id !== $document->id) {
            abort(403);
        }
        return Storage::disk('public')->download($attachment->file_path, $attachment->original_name);
    }

    public function destroy(Document $document)
    {
        if ($document->status !== 'draft') {
            abort(403, 'فقط پیش‌نویس‌ها قابل حذف هستند.');
        }
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'مستند حذف شد.');
    }
}