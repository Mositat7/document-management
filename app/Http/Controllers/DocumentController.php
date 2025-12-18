<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
        public function __construct(
        protected DocumentService $documentService
    ) {}
        public function index()
    {
        $documents = $this->documentService->list();

        return view('documents.index', compact('documents'));
    }
    public function create() {}
    public function store(Request $request)
    {
        $this->documentService->store($request->all());

        return redirect('/documents');
    }
    public function show(Document $document) {}
    public function download(Document $document, DocumentAttachment $attachment) {}
    public function destroy(Document $document) {}
}

