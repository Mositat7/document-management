@extends('layouts.app')

@section('title', 'ویرایش مستند')

@section('content')
<div class="crumbs">
    <a href="{{ route('documents.index') }}">مستندات و مکاتبات</a>
    <span>›</span>
    <span>ویرایش مستند</span>
</div>

<div class="page-header">
    <div>
        <div class="page-title">ویرایش مستند: {{ $document->title }}</div>
        <div class="page-sub">ایجاد نامه یا مستند اداری + متن + پیوست + ارسال</div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <a href="{{ route('documents.index') }}" class="btn btn-ghost">بازگشت به لیست</a>
        <button type="submit" form="document-form" class="btn">ذخیره تغییرات</button>
    </div>
</div>

<div class="split">
    <div class="card">
        <form id="document-form" method="POST" action="{{ route('documents.update', $document) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="filters">
                <div class="field col-12">
                    <div class="label">عنوان</div>
                    <input class="input" type="text" name="title" value="{{ old('title', $document->title) }}" required placeholder="عنوان مستند/نامه را وارد کنید" />
                </div>

                <div class="field col-6">
                    <div class="label">گیرنده</div>
                    <select class="select" name="receiver" required>
                        <option value="">انتخاب گیرنده...</option>
                        <option value="واحد تولید" {{ old('receiver', $document->receiver) == 'واحد تولید' ? 'selected' : '' }}>واحد تولید</option>
                        <option value="انبار" {{ old('receiver', $document->receiver) == 'انبار' ? 'selected' : '' }}>انبار</option>
                        <option value="کنترل پروژه" {{ old('receiver', $document->receiver) == 'کنترل پروژه' ? 'selected' : '' }}>کنترل پروژه</option>
                        <option value="بازرگانی فروش" {{ old('receiver', $document->receiver) == 'بازرگانی فروش' ? 'selected' : '' }}>بازرگانی فروش</option>
                        <option value="مدیریت مالی" {{ old('receiver', $document->receiver) == 'مدیریت مالی' ? 'selected' : '' }}>مدیریت مالی</option>
                    </select>
                </div>

                <div class="field col-6">
                    <div class="label">نوع</div>
                    <select class="select" name="type" required>
                        <option value="">انتخاب نوع...</option>
                        <option value="letter" {{ old('type', $document->type) == 'letter' ? 'selected' : '' }}>نامه</option>
                        <option value="document" {{ old('type', $document->type) == 'document' ? 'selected' : '' }}>مستند اداری</option>
                    </select>
                </div>

                <div class="field col-12">
                    <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;">
                        <div class="label">متن</div>
                        <div style="display:flex;gap:10px;flex-wrap:wrap;">
                            <button type="button" class="btn btn-ghost">استفاده از الگوی سربرگ (Word)</button>
                            <button type="button" class="btn btn-ghost">پیش‌نمایش</button>
                        </div>
                    </div>
                    <textarea class="textarea" name="content" placeholder="متن نامه/مستند را اینجا بنویسید...">{{ old('content', $document->body) }}</textarea>
                </div>

                <div class="field col-12">
                    <div class="label">پیوست‌های فعلی</div>
                    @if($document->attachments->count())
                        <div class="card" style="padding:10px;background:#f9fafb;">
                            @foreach($document->attachments as $att)
                                <div style="display:flex;justify-content:space-between;gap:10px;padding:6px 0;">
                                    <span>{{ $att->original_name }}</span>
                                    <a href="{{ route('documents.download', [$document, $att]) }}" class="btn btn-ghost" style="padding:4px 8px;font-size:12px;">دانلود</a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="muted">پیوستی وجود ندارد.</div>
                    @endif
                </div>

                <div class="field col-12">
                    <div class="label">افزودن پیوست جدید</div>
                    <input type="file" name="attachments[]" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip" />
                    <div class="hint">فرمت‌های مجاز: pdf, docx, jpg, png, zip</div>
                </div>
            </div>
        </form>
    </div>

    <aside class="note">
        <h4>راهنمای سریع</h4>
        <ul>
            <li>فقط مستندات با وضعیت «پیش‌نویس» قابل ویرایش هستند.</li>
            <li>پیوست‌های جدید به لیست قبلی اضافه می‌شوند.</li>
        </ul>

        <div class="divider"></div>

        <h4>اطلاعات سیستمی</h4>
        <div class="muted" style="line-height:2;">
            شماره سند: <b>{{ $document->code }}</b><br/>
            تاریخ ثبت: <b>{{ verta($document->registered_at)->format('Y/m/d') }}</b><br/>
            فرستنده: <b>{{ $document->sender }}</b>
        </div>
    </aside>
</div>
@endsection