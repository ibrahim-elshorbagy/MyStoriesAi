<div style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:10px; text-align:center;">
  <!-- Logo -->
  <img src="{{ config('app.url') }}/assets/auth/logo.webp" alt="MyStoryAI Logo" width="200" style="margin:0 auto 20px auto; width:100%; max-width:600px;" />

  <!-- Card -->
  <div style="max-width:600px; margin:0 auto; background:#fff; padding:20px; border-radius:12px; box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:{{ $locale === 'ar' ? 'right' : 'left' }};" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
  @if($locale === 'ar')
      <h2 style="color:#333; direction: rtl;">طلب جديد تم إنشاؤه 🎉</h2>
      <p style="color:#555; font-size:16px; direction: rtl;">
        تم إنشاء طلب جديد في موقعك. تفاصيل الطلب:
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0; direction: rtl;">
        <strong style="color:#333;">معرف الطلب:</strong> #{{ $order->id }}<br/>
        <strong style="color:#333;">اسم العميل:</strong> {{ $order->user ? $order->user->name : 'غير معروف' }}<br/>
        <strong style="color:#333;">اسم الطفل:</strong> {{ $order->child_name }}<br/>
        <strong style="color:#333;">عمر الطفل:</strong> {{ $order->child_age }} سنوات<br/>
        <strong style="color:#333;">اللغة:</strong> {{ $order->language === 'arabic' ? 'العربية' : 'الإنجليزية' }}<br/>
        <strong style="color:#333;">التنسيق:</strong>
        @if($order->format === 'pdf')
          PDF فقط
        @elseif($order->format === 'soft')
          PDF + غلاف ناعم
        @else
          PDF + غلاف صلب
        @endif
        <br/>
        <strong style="color:#333;">المبلغ الإجمالي:</strong> {{ $order->total_price }} جنيه<br/>
        <strong style="color:#333;">طريقة الدفع:</strong> {{ $order->payment_method === 'cod' ? __('website.cod') : __('website.online_payment') }}<br/>
        <strong style="color:#333;">حالة الطلب:</strong>
        @if($order->status === 'pending')
          في الانتظار
        @elseif($order->status === 'processing')
          قيد المعالجة
        @elseif($order->status === 'completed')
          مكتمل
        @else
          ملغي
        @endif
      </div>

      <div style="text-align:center; margin:20px 0;">
        <a href="{{ route('admin.orders.show', $order->id) }}" style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">
          عرض تفاصيل الطلب
        </a>
      </div>

      <p style="margin-top:30px; font-size:14px; color:#999; direction: rtl;">
        تحياتنا ❤️ فريق MyStoryAI
      </p>
    @elseif($locale === 'de')
      <h2 style="color:#333;">Neue Bestellung erstellt 🎉</h2>
      <p style="color:#555; font-size:16px;">
        Eine neue Bestellung wurde auf Ihrer Website erstellt. Bestelldetails:
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0;">
        <strong style="color:#333;">Bestellnummer:</strong> #{{ $order->id }}<br/>
        <strong style="color:#333;">Kundenname:</strong> {{ $order->user ? $order->user->name : 'Unbekannt' }}<br/>
        <strong style="color:#333;">Name des Kindes:</strong> {{ $order->child_name }}<br/>
        <strong style="color:#333;">Alter des Kindes:</strong> {{ $order->child_age }} Jahre<br/>
        <strong style="color:#333;">Sprache:</strong> {{ $order->language === 'arabic' ? 'Arabisch' : 'Englisch' }}<br/>
        <strong style="color:#333;">Format:</strong>
        @if($order->format === 'pdf')
          Nur PDF
        @elseif($order->format === 'soft')
          PDF + Softcover
        @else
          PDF + Hardcover
        @endif
        <br/>
        <strong style="color:#333;">Gesamtbetrag:</strong> {{ $order->total_price }} EGP<br/>
        <strong style="color:#333;">Zahlungsmethode:</strong> {{ $order->payment_method === 'cod' ? __('website.cod') : __('website.online_payment') }}<br/>
        <strong style="color:#333;">Bestellstatus:</strong>
        @if($order->status === 'pending')
          Ausstehend
        @elseif($order->status === 'processing')
          In Bearbeitung
        @elseif($order->status === 'completed')
          Abgeschlossen
        @else
          Storniert
        @endif
      </div>

      <div style="text-align:center; margin:20px 0;">
        <a href="{{ route('admin.orders.show', $order->id) }}" style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">
          Bestelldetails anzeigen
        </a>
      </div>

      <p style="margin-top:30px; font-size:14px; color:#999;">Mit freundlichen Grüßen ❤️ Das MyStoryAI Team</p>
    @else
      <h2 style="color:#333;">New Order Created 🎉</h2>
      <p style="color:#555; font-size:16px;">
        A new order has been created on your website. Order details:
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0;">
        <strong style="color:#333;">Order ID:</strong> #{{ $order->id }}<br/>
        <strong style="color:#333;">Customer Name:</strong> {{ $order->user ? $order->user->name : 'Unknown' }}<br/>
        <strong style="color:#333;">Child Name:</strong> {{ $order->child_name }}<br/>
        <strong style="color:#333;">Child Age:</strong> {{ $order->child_age }} years<br/>
        <strong style="color:#333;">Language:</strong> {{ $order->language === 'arabic' ? 'Arabic' : 'English' }}<br/>
        <strong style="color:#333;">Format:</strong>
        @if($order->format === 'pdf')
          PDF Only
        @elseif($order->format === 'soft')
          PDF + Softcover
        @else
          PDF + Hardcover
        @endif
        <br/>
        <strong style="color:#333;">Total Amount:</strong> {{ $order->total_price }} EGP<br/>
        <strong style="color:#333;">Payment Method:</strong> {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}<br/>
        <strong style="color:#333;">Order Status:</strong>
        @if($order->status === 'pending')
          Pending
        @elseif($order->status === 'processing')
          Processing
        @elseif($order->status === 'completed')
          Completed
        @else
          Cancelled
        @endif
      </div>

      <div style="text-align:center; margin:20px 0;">
        <a href="{{ route('admin.orders.show', $order->id) }}" style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">
          View Order Details
        </a>
      </div>

      <p style="margin-top:30px; font-size:14px; color:#999;">
        Best regards ❤️ The MyStoryAI Team
      </p>
    @endif
  </div>

  <!-- Footer -->
  <p style="margin-top:20px; font-size:12px; color:#aaa;">
    © {{ date('Y') }} MyStoryAI. All rights reserved.
    <br/>
    <a href="{{ config('app.url') }}" style="color:#555; text-decoration:none;">{{ $locale === 'ar' ? 'الموقع الرسمي' : 'Official Website' }}</a> |
    <a href="mailto:mystoryai.webiste@gmail.com" style="color:#555; text-decoration:none;">{{ $locale === 'ar' ? 'اتصل بنا' : 'Contact Us' }}</a>
  </p>
</div>
