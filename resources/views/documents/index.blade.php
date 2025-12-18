@extends('layouts.app')

@section('title', 'مستندات و مکاتبات')

@section('content')
<div class="page-header">
    <div>
        <div class="page-title">مستندات و مکاتبات</div>
        <div class="page-sub">لیست نامه‌ها و مستندات ثبت‌شده + جستجو و فیلتر</div>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <!-- دکمه پاک کردن فیلترها -->
        <button class="btn btn-ghost" onclick="alert('نمایشی: ریست فیلترها (در آینده پیاده‌سازی می‌شود)')">پاک کردن فیلترها</button>
        <!-- دکمه ثبت مستند جدید -->
        <a href="{{ route('documents.create') }}" class="btn">ثبت مستند جدید</a>
    </div>
</div>
<!-- Filters (همانند letter.html) -->
<div class="card" style="margin-bottom:12px;">
    <div class="filters">
        <div class="field col-4">
            <div class="label">جستجو بر اساس عنوان / نام</div>
            <input class="input" type="text" placeholder="مثلاً: نامه درخواست قطعه..." disabled />
        </div>

        <div class="field col-4">
            <div class="label">بازه تاریخ</div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <input class="input" type="date" style="flex:1;min-width:140px;" disabled />
                <input class="input" type="date" style="flex:1;min-width:140px;" disabled />
            </div>
        </div>

        <div class="field col-4">
            <div class="label">نوع</div>
            <select class="select" disabled>
                <option>همه</option>
                <option>نامه</option>
                <option>مستند اداری</option>
            </select>
        </div>

        <div class="field col-4">
            <div class="label">فرستنده</div>
            <select class="select" disabled>
                <option>همه</option>
                <option>واحد نگهبانی</option>
                <option>بازرگانی فروش</option>
                <option>مدیریت ارشد</option>
                <option>مدیر فنی مهندسی</option>
            </select>
        </div>

        <div class="field col-4">
            <div class="label">گیرنده</div>
            <select class="select" disabled>
                <option>همه</option>
                <option>واحد تولید</option>
                <option>انبار</option>
                <option>کنترل پروژه</option>
                <option>مدیریت مالی</option>
            </select>
        </div>

        <div class="field col-4" style="display:flex;justify-content:flex-end;">
            <div class="label" style="visibility:hidden;">اقدام</div>
            <button class="btn" style="width:100%;" disabled>اعمال فیلتر</button>
        </div>
    </div>
</div>

<!-- Table -->
<div class="card table-card">
    <div class="table-head">
        <div class="table-title">لیست مستندات</div>
        <div class="chips">
            <span class="chip soft">نمایش: {{ $documents->total() }} مورد</span>
        </div>
    </div>

    <div style="overflow:auto;">
        <table>
            <thead>
                <tr>
                    <th>شماره</th>
                    <th>عنوان</th>
                    <th>نوع</th>
                    <th>فرستنده</th>
                    <th>گیرنده</th>
                    <th>تاریخ</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $doc)
                    <tr>
                        <td class="muted">{{ $doc->code }}</td>
                        <td>
                            {{ $doc->title }}
                            @if($doc->attachments->count())
                                <div class="muted">پیوست: {{ $doc->attachments->count() }} فایل</div>
                            @endif
                        </td>
                        <td>{{ $doc->type === 'letter' ? 'نامه' : 'مستند اداری' }}</td>
                        <td>{{ $doc->sender }}</td>
                        <td>{{ $doc->receiver }}</td>
                        <td class="muted">{{ verta($doc->registered_at)->format('Y/m/d') }}</td>
                        <td>
                            @if($doc->status === 'draft')
                                <span class="chip">پیش‌نویس</span>
                            @elseif($doc->status === 'sent')
                                <span class="chip soft">ارسال شده</span>
                            @else
                                <span class="chip soft">بایگانی</span>
                            @endif
                        </td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('documents.show', $doc) }}" class="icon-btn">مشاهده</a>
                                @if($doc->attachments->count())
                                    <a href="{{ route('documents.download', [$doc, $doc->attachments->first()]) }}" class="icon-btn">دانلود سند</a>
                                @endif
                                @if($doc->status === 'draft')
                                    <a href="{{ route('documents.edit', $doc) }}" class="icon-btn">ویرایش</a>
                                    <form action="{{ route('documents.destroy', $doc) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-btn" onclick="return confirm('آیا از حذف این مستند مطمئنید؟')">حذف</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="muted" style="text-align:center;">مستندی یافت نشد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding:12px 14px;display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;">
        <div class="muted">
            {{ $documents->onFirstPage() ? 'صفحه 1' : 'صفحه ' . ($documents->currentPage()) }} از {{ $documents->lastPage() }}
        </div>
        {{ $documents->links() }}
    </div>
</div>
@endsection