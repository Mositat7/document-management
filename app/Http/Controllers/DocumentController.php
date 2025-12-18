<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index() {}
    public function create() {}
        public function store(Request $request, DocumentCodeGenerator $codeGenerator)
    {
        $document = Document::create([
            'title'     => $request->title,
            'type'      => $request->type,
            'receiver'  => $request->receiver,
            'sender'    => 'کاربر جاری', // فعلاً ثابت
            'status'    => 'draft',
            'code'      => $codeGenerator->generate(),
            'content'   => $request->content,
        ]);
    public function show(Document $document) {}
    public function download(Document $document, DocumentAttachment $attachment) {}
    public function destroy(Document $document) {}
}

