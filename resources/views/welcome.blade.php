<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>مستندات و مکاتبات | پنل مدیریت پروژه توربو</title>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700;800&display=swap" rel="stylesheet">

    <style>
        :root{
            --sidebar-bg:#0f172a;
            --primary:#0284c7;
            --primary-soft:#e0f2fe;
            --border:#e5e7eb;
            --radius:14px;
            --shadow:0 6px 18px rgba(0,0,0,0.07);
            --bg:#f3f4f6;
        }

        *{box-sizing:border-box;}
        body{
            margin:0;
            background:var(--bg);
            font-family:"Vazirmatn",system-ui;
            color:#0f172a;
        }

        /* Layout کلی */
        .layout{display:flex;min-height:100vh;}

        .sidebar{
            width:250px;
            background:var(--sidebar-bg);
            color:#fff;
            padding:20px 16px;
        }
        .sidebar-top{display:flex;align-items:center;gap:10px;margin-bottom:18px;}
        .sidebar-logo{
            width:42px;height:42px;
            border-radius:12px;
            background:linear-gradient(135deg,#0ea5e9,#22c55e);
            display:flex;align-items:center;justify-content:center;
            font-weight:800;font-size:20px;color:#0f172a;
        }
        .sidebar-brand{font-weight:800;font-size:14px;line-height:1.2;}
        .sidebar-brand small{display:block;color:#cbd5e1;font-weight:500;margin-top:3px;}

        .sidebar-nav a{
            display:flex;align-items:center;
            padding:10px 12px;
            border-radius:10px;
            color:#d1d5db;
            text-decoration:none;
            margin-bottom:6px;
        }
        .sidebar-nav a.active{
            background:rgba(255,255,255,0.08);
            color:#fff;
        }

        .main{
            flex:1;
            padding:20px 26px;
        }

        /* کارت عمومی */
        .card{
            background:#fff;
            border-radius:var(--radius);
            border:1px solid var(--border);
            box-shadow:var(--shadow);
            padding:12px 14px;
        }

        /* هدر صفحه */
        .page-header{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:16px;
            gap:12px;
            flex-wrap:wrap;
        }
        .page-title{
            font-size:20px;
            font-weight:800;
        }
        .page-sub{color:#64748b;font-size:12px;margin-top:4px;}

        /* دکمه عمومی */
        .btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:6px;
            padding:8px 14px;
            border-radius:10px;
            border:0;
            font-size:13px;
            cursor:pointer;
            background:var(--primary);
            color:#fff;
            white-space:nowrap;
        }
        .btn-ghost{
            background:#fff;
            border:1px solid var(--border);
            color:var(--primary);
        }

        /* Tabs ساده برای 2 صفحه داخل یک فایل */
        .page{display:none;}
        .page.active{display:block;}

        /* فرم / فیلتر */
        .filters{
            display:grid;
            grid-template-columns:repeat(12,1fr);
            gap:10px;
        }
        .field{display:flex;flex-direction:column;gap:6px;}
        .label{font-size:12px;color:#475569;font-weight:700;}
        .input, .select, .textarea{
            width:100%;
            border:1px solid var(--border);
            border-radius:10px;
            padding:9px 10px;
            font-family:"Vazirmatn",system-ui;
            font-size:13px;
            outline:none;
            background:#fff;
        }
        .textarea{min-height:140px;resize:vertical;}
        .hint{
            font-size:11px;
            color:#64748b;
            line-height:1.6;
        }

        .col-12{grid-column:span 12;}
        .col-6{grid-column:span 6;}
        .col-4{grid-column:span 4;}
        .col-3{grid-column:span 3;}

        @media (max-width: 1100px){
            .col-6,.col-4,.col-3{grid-column:span 12;}
            .sidebar{display:none;}
            .main{padding:16px;}
        }

        /* Table */
        .table-card{padding:0;overflow:hidden;}
        .table-head{
            display:flex;align-items:center;justify-content:space-between;
            padding:12px 14px;border-bottom:1px solid var(--border);
            gap:10px;flex-wrap:wrap;
        }
        .table-title{font-weight:800;}
        .chips{display:flex;gap:8px;flex-wrap:wrap;}
        .chip{
            font-size:12px;
            border:1px solid var(--border);
            border-radius:999px;
            padding:6px 10px;
            background:#fff;
            color:#0f172a;
        }
        .chip.soft{background:var(--primary-soft);border-color:transparent;color:#0f172a;}

        table{width:100%;border-collapse:collapse;}
        thead th{
            text-align:right;
            font-size:12px;
            color:#475569;
            background:#fff;
            border-bottom:1px solid var(--border);
            padding:10px 12px;
            font-weight:800;
            white-space:nowrap;
        }
        tbody td{
            padding:10px 12px;
            border-bottom:1px solid var(--border);
            font-size:13px;
            vertical-align:middle;
        }
        tbody tr:hover{background:#fafafa;}
        .muted{color:#64748b;font-size:12px;}

        .row-actions{display:flex;gap:8px;justify-content:flex-start;flex-wrap:wrap;}
        .icon-btn{
            display:inline-flex;align-items:center;justify-content:center;
            border:1px solid var(--border);
            background:#fff;
            color:#0f172a;
            border-radius:10px;
            padding:7px 10px;
            font-size:12px;
            cursor:pointer;
        }

        /* Box های کمکی */
        .split{
            display:grid;
            grid-template-columns: 1fr 380px;
            gap:12px;
            align-items:start;
        }
        @media (max-width: 1100px){
            .split{grid-template-columns:1fr;}
        }

        .note{
            border:1px solid var(--border);
            border-radius:var(--radius);
            padding:12px 14px;
            background:#fff;
            box-shadow:var(--shadow);
        }
        .note h4{margin:0 0 8px 0;font-size:14px;font-weight:900;}
        .note ul{margin:0;padding:0 18px;line-height:1.9;color:#334155;font-size:13px;}
        .note li{margin:3px 0;}
        .divider{height:1px;background:var(--border);margin:12px 0;}

        /* Breadcrumb */
        .crumbs{
            display:flex;gap:8px;align-items:center;flex-wrap:wrap;
            font-size:12px;color:#64748b;margin-bottom:10px;
        }
        .crumbs a{color:var(--primary);text-decoration:none;}
    </style>
</head>

<body>
<div class="layout">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-top">
            <div class="sidebar-logo">T</div>
            <div class="sidebar-brand">
                پنل پروژه توربو
                <small>Turbo Generator Shahrood</small>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="javascript:void(0)" class="active" onclick="goList()">مستندات و مکاتبات</a>
        </nav>
    </aside>

    <!-- Main -->
    <main class="main">

        <!-- PAGE 1: لیست مستندات -->
        <section id="pageList" class="page active">
            <div class="page-header">
                <div>
                    <div class="page-title">مستندات و مکاتبات</div>
                    <div class="page-sub">لیست نامه‌ها و مستندات ثبت‌شده + جستجو و فیلتر</div>
                </div>

                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <button class="btn btn-ghost" onclick="resetFilters()">پاک کردن فیلترها</button>
                    <button class="btn" onclick="goCreate()">ثبت مستند جدید</button>
                </div>
            </div>

            <!-- Filters -->
            <div class="card" style="margin-bottom:12px;">
                <div class="filters">
                    <div class="field col-4">
                        <div class="label">جستجو بر اساس عنوان / نام</div>
                        <input class="input" type="text" placeholder="مثلاً: نامه درخواست قطعه..." />
                    </div>

                    <div class="field col-4">
                        <div class="label">بازه تاریخ</div>
                        <div style="display:flex;gap:10px;flex-wrap:wrap;">
                            <input class="input" type="date" style="flex:1;min-width:140px;">
                            <input class="input" type="date" style="flex:1;min-width:140px;">
                        </div>
                    </div>

                    <div class="field col-4">
                        <div class="label">نوع</div>
                        <select class="select">
                            <option>همه</option>
                            <option>نامه</option>
                            <option>مستند اداری</option>
                        </select>
                    </div>

                    <div class="field col-4">
                        <div class="label">فرستنده</div>
                        <select class="select">
                            <option>همه</option>
                            <option>واحد نگهبانی</option>
                            <option>بازرگانی فروش</option>
                            <option>مدیریت ارشد</option>
                            <option>مدیر فنی مهندسی</option>
                        </select>
                    </div>

                    <div class="field col-4">
                        <div class="label">گیرنده</div>
                        <select class="select">
                            <option>همه</option>
                            <option>واحد تولید</option>
                            <option>انبار</option>
                            <option>کنترل پروژه</option>
                            <option>مدیریت مالی</option>
                        </select>
                    </div>

                    <div class="field col-4" style="display:flex;justify-content:flex-end;">
                        <div class="label" style="visibility:hidden;">اقدام</div>
                        <button class="btn" style="width:100%;">اعمال فیلتر</button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="card table-card">
                <div class="table-head">
                    <div class="table-title">لیست مستندات</div>
                    <div class="chips">
                        <span class="chip soft">نمایش: 12 مورد</span>
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
                        <!-- ارسال شده (فقط مشاهده + دانلود) -->
                        <tr>
                            <td class="muted">TG-1404-0123</td>
                            <td>
                                درخواست تامین قطعه یدکی
                                <div class="muted">پروژه: TG-PRJ-778</div>
                            </td>
                            <td>نامه</td>
                            <td>کنترل پروژه</td>
                            <td>انبار</td>
                            <td class="muted">1404/09/18</td>
                            <td><span class="chip soft">ارسال شده</span></td>
                            <td>
                                <div class="row-actions">
                                    <button class="icon-btn">مشاهده</button>
                                    <button class="icon-btn">دانلود سند</button>
                                </div>
                            </td>
                        </tr>

                        <!-- پیش‌نویس (مشاهده + دانلود + ویرایش + حذف) -->
                        <tr>
                            <td class="muted">TG-1404-0109</td>
                            <td>
                                صورتجلسه تحویل پروژه
                                <div class="muted">پیوست: 2 فایل</div>
                            </td>
                            <td>مستند اداری</td>
                            <td>مدیریت ارشد</td>
                            <td>بازرگانی فروش</td>
                            <td class="muted">1404/09/09</td>
                            <td><span class="chip">پیش‌نویس</span></td>
                            <td>
                                <div class="row-actions">
                                    <button class="icon-btn">مشاهده</button>
                                    <button class="icon-btn">دانلود سند</button>
                                    <button class="icon-btn">ویرایش</button>
                                    <button class="icon-btn">حذف</button>
                                </div>
                            </td>
                        </tr>

                        <!-- بایگانی (فقط مشاهده + دانلود) -->
                        <tr>
                            <td class="muted">TG-1404-0098</td>
                            <td>
                                نامه هماهنگی حمل و نقل
                                <div class="muted">گیرنده: واحد حمل و نقل</div>
                            </td>
                            <td>نامه</td>
                            <td>نگهبانی</td>
                            <td>حمل و نقل</td>
                            <td class="muted">1404/09/02</td>
                            <td><span class="chip soft">بایگانی</span></td>
                            <td>
                                <div class="row-actions">
                                    <button class="icon-btn">مشاهده</button>
                                    <button class="icon-btn">دانلود سند</button>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div style="padding:12px 14px;display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;">
                    <div class="muted">صفحه 1 از 3</div>
                    <div style="display:flex;gap:8px;flex-wrap:wrap;">
                        <button class="btn btn-ghost">قبلی</button>
                        <button class="btn">بعدی</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- PAGE 2: ثبت مستند جدید -->
        <section id="pageCreate" class="page">
            <div class="crumbs">
                <a href="javascript:void(0)" onclick="goList()">مستندات و مکاتبات</a>
                <span>›</span>
                <span>ثبت مستند جدید</span>
            </div>

            <div class="page-header">
                <div>
                    <div class="page-title">ثبت مستند جدید</div>
                    <div class="page-sub">ایجاد نامه یا مستند اداری + متن + پیوست + ارسال</div>
                </div>

                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <button class="btn btn-ghost" onclick="goList()">بازگشت به لیست</button>
                    <button class="btn">ارسال</button>
                </div>
            </div>

            <div class="split">
                <!-- Form -->
                <div class="card">
                    <div class="filters">
                        <div class="field col-12">
                            <div class="label">عنوان</div>
                            <input class="input" type="text" placeholder="عنوان مستند/نامه را وارد کنید" />
                        </div>

                        <div class="field col-6">
                            <div class="label">گیرنده</div>
                            <select class="select">
                                <option>انتخاب گیرنده...</option>
                                <option>واحد تولید</option>
                                <option>انبار</option>
                                <option>کنترل پروژه</option>
                                <option>بازرگانی فروش</option>
                                <option>مدیریت مالی</option>
                            </select>
                        </div>

                        <div class="field col-6">
                            <div class="label">نوع</div>
                            <select class="select">
                                <option>انتخاب نوع...</option>
                                <option>نامه</option>
                                <option>مستند اداری</option>
                            </select>
                        </div>

                        <div class="field col-12">
                            <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;">
                                <div class="label">متن</div>
                                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                                    <button class="btn btn-ghost" type="button">استفاده از الگوی سربرگ (Word)</button>
                                    <button class="btn btn-ghost" type="button">پیش‌نمایش</button>
                                </div>
                            </div>

                            <textarea class="textarea" placeholder="متن نامه/مستند را اینجا بنویسید..."></textarea>

                            <div class="hint">
                                سناریو الگوی Word (نمایشی):
                                با کلیک روی «استفاده از الگوی سربرگ»، سیستم یک فایل Word قالب‌دار را برای کاربر باز می‌کند،
                                کاربر متن را تکمیل و ذخیره می‌کند، سپس متن دارای سربرگ به سیستم برمی‌گردد و
                                «شماره نامه جدید» و «تاریخ» توسط سیستم داخل همان فایل درج می‌شود.
                            </div>
                        </div>

                        <div class="field col-12">
                            <div class="label">پیوست‌ها</div>
                            <div class="card" style="padding:10px 12px;border-style:dashed;">
                                <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;">
                                    <div>
                                        <div style="font-weight:800;font-size:13px;">افزودن فایل پیوست</div>
                                        <div class="muted">pdf, docx, jpg, png, zip ...</div>
                                    </div>
                                    <button class="btn btn-ghost" type="button">انتخاب فایل</button>
                                </div>

                                <div class="divider"></div>

                                <!-- نمونه لیست پیوست‌ها -->
                                <div style="display:flex;flex-direction:column;gap:8px;">
                                    <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;">
                                        <div>
                                            <div style="font-weight:800;font-size:13px;">attachment-01.pdf</div>
                                            <div class="muted">245 KB</div>
                                        </div>
                                        <button class="icon-btn" type="button">حذف</button>
                                    </div>

                                    <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;">
                                        <div>
                                            <div style="font-weight:800;font-size:13px;">contract.docx</div>
                                            <div class="muted">88 KB</div>
                                        </div>
                                        <button class="icon-btn" type="button">حذف</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12" style="display:flex;gap:10px;justify-content:flex-end;flex-wrap:wrap;">
                            <button class="btn btn-ghost" type="button">ذخیره پیش‌نویس</button>
                            <button class="btn" type="button">ارسال</button>
                        </div>
                    </div>
                </div>

                <!-- Side Info -->
                <aside class="note">
                    <h4>راهنمای سریع</h4>
                    <ul>
                        <li>نوع را مشخص کنید: «نامه» یا «مستند اداری»</li>
                        <li>برای نامه‌های رسمی از «الگوی سربرگ (Word)» استفاده کنید.</li>
                        <li>پس از بازگشت فایل Word، سیستم شماره و تاریخ را درج می‌کند (نمایشی).</li>
                        <li>پیوست‌ها را اضافه کنید و در نهایت «ارسال» را بزنید.</li>
                    </ul>

                    <div class="divider"></div>

                    <h4>اطلاعات سیستمی (نمایشی)</h4>
                    <div class="muted" style="line-height:2;">
                        شماره نامه جدید: <b>TG-1404-XXXX</b><br/>
                        تاریخ ثبت: <b>1404/09/..</b><br/>
                        فرستنده: <b>کاربر جاری</b>
                    </div>
                </aside>
            </div>
        </section>

    </main>
</div>

<script>
    function goList(){
        document.getElementById('pageList').classList.add('active');
        document.getElementById('pageCreate').classList.remove('active');
        window.scrollTo({top:0, behavior:'smooth'});
    }
    function goCreate(){
        document.getElementById('pageCreate').classList.add('active');
        document.getElementById('pageList').classList.remove('active');
        window.scrollTo({top:0, behavior:'smooth'});
    }
    function resetFilters(){
        alert('نمایشی: ریست فیلترها (در بک‌اند پیاده‌سازی می‌شود).');
    }
</script>
</body>
</html>
