@extends('layouts.app')

@section('title', 'مشاهده مستند')

@section('content')
<div class="crumbs">
    <a href="{{ route('documents.index') }}">مستندات و مکاتبات</a>
    <span>›</span>
    <span>مشاهده مستند</span>
</div>

<div class="page-header">
    <div>
        <div class="page-title">مشاهده مستند: {{ $document->title }}</div>
    </div>
    <a href="{{ route('documents.index') }}" class="btn btn-ghost">بازگشت به لیست</a>
</div>

<div class="card">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
        <div>
            <div class="label">شماره سند</div>
            <div>{{ $document->code }}</div>
        </div>
        <div>
            <div class="label">نوع</div>
            <div>{{ $document->type === 'letter' ? 'نامه' : 'مستند اداری' }}</div>
        </div>
        <div>
            <div class="label">فرستنده</div>
            <div>{{ $document->sender }}</div>
        </div>
        <div>
            <div class="label">گیرنده</div>
            <div>{{ $document->receiver }}</div>
        </div>
        <div>
            <div class="label">تاریخ ثبت</div>
            <div>{{ verta($document->registered_at)->format('Y/m/d') }}</div>
        </div>
        <div>
            <div class="label">وضعیت</div>
            <div>
                @if($document->status === 'draft')
                    <span class="chip">پیش‌نویس</span>
                @elseif($document->status === 'sent')
                    <span class="chip soft">ارسال شده</span>
                @else
                    <span class="chip soft">بایگانی</span>
                @endif
            </div>
        </div>
    </div>

    <div class="field">
        <div class="label">متن مستند</div>
        <div class="card" style="padding:12px;background:#f9fafb;">
            {!! nl2br(e($document->body)) !!}
        </div>
    </div>

    @if($document->attachments->count())
        <div class="field" style="margin-top:20px;">
            <div class="label">پیوست‌ها ({{ $document->attachments->count() }})</div>
            <div class="card" style="padding:12px;">
                @foreach($document->attachments as $attachment)
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;padding:8px 0;border-bottom:1px solid #eee;">
                        <div>
                            <strong>{{ $attachment->original_name }}</strong>
                            <div class="muted">{{ number_format($attachment->size) }} بایت</div>
                        </div>
                        <a href="{{ route('documents.download', [$document, $attachment]) }}" class="btn btn-ghost" style="padding:4px 10px;font-size:12px;">دانلود</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection