<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index() {}
    public function create() {}
    public function store(Request $request) {}
    public function show(Document $document) {}
    public function download(Document $document, DocumentAttachment $attachment) {}
    public function destroy(Document $document) {}
}

