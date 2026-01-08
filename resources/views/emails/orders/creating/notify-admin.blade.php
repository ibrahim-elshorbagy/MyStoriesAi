<div style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:10px; text-align:center;">
  <!-- Logo -->
  <img src="{{ asset('assets/auth/logo.png') }}" alt="MyStoriesAi Logo" width="150"
    style="margin:0 auto 20px auto; width:100%; max-width:400px;" />

  <!-- Card -->
  <div
    style="max-width:600px; margin:0 auto; background:#fff; padding:20px; border-radius:12px; box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:{{ $locale === 'ar' ? 'right' : 'left' }};"
    dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
    @if ($locale === 'ar')
      <h2 style="color:#333; direction: rtl;">طلب جديد تم إنشاؤه 🎉</h2>
      <p style="color:#555; font-size:16px; direction: rtl;">
        تم إنشاء طلب جديد في موقعك. تفاصيل الطلب:
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0; direction: rtl;">
        <strong style="color:#333;">معرف الطلب:</strong> #{{ $order->id }}<br />
        <strong style="color:#333;">اسم العميل:</strong> {{ $order->user ? $order->user->name : 'غير معروف' }}<br />
        <strong style="color:#333;">عدد القصص:</strong> {{ $order->orderItems->count() }} قصة<br />
        <strong style="color:#333;">المبلغ الإجمالي:</strong> {{ $order->total_price }} EUR<br />
        <strong style="color:#333;">طريقة الدفع:</strong>
        {{ $order->payment_method === 'cod' ? __('website.cod') : __('website.online_payment') }}<br />
        <strong style="color:#333;">حالة الطلب:</strong>
        @if ($order->status === 'pending')
          في الانتظار
        @elseif($order->status === 'processing')
          قيد المعالجة
        @elseif($order->status === 'completed')
          مكتمل
        @else
          ملغي
        @endif
        <br /><br />
        <strong style="color:#333;">تفاصيل القصص:</strong><br />
        @foreach ($order->orderItems as $item)
          <div style="background:#fff; padding:10px; margin:5px 0; border-radius:5px; border-left:3px solid #fa7508;">
            <strong>الطفل:</strong> {{ $item->child_name }} ({{ $item->child_age }} سنوات)<br />
            <strong>اللغة:</strong>
            {{ $item->language === 'arabic' ? 'العربية' : ($item->language === 'english' ? 'الإنجليزية' : 'الألمانية') }}<br />
            <strong>التنسيق:</strong>
            @if ($item->format === 'first_plan')
              الخطة الأولى
            @elseif($item->format === 'second_plan')
              الخطة الثانية
            @else
              الخطة الثالثة
            @endif
            <br />
            <strong>السعر:</strong> {{ $item->story_price }} EUR
          </div>
        @endforeach
      </div>

      <div style="text-align:center; margin:20px 0;">
        <a href="{{ route('admin.orders.show', $order->id) }}"
          style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">
          عرض تفاصيل الطلب
        </a>
      </div>

      <p style="margin-top:30px; font-size:14px; color:#999; direction: rtl;">
        تحياتنا ❤️ فريق MyStoriesAi
      </p>
    @elseif($locale === 'de')
      <h2 style="color:#333;">Neue Bestellung eingegangen 🎉</h2>
      <p style="color:#555; font-size:16px;">
        Auf Ihrer Website wurde eine neue Bestellung erstellt. Hier sind die Details:
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0;">
        <strong style="color:#333;">Bestellnummer:</strong> #{{ $order->id }}<br />
        <strong style="color:#333;">Kundenname:</strong> {{ $order->user ? $order->user->name : 'Unbekannt' }}<br />
        <strong style="color:#333;">Anzahl der Geschichten:</strong> {{ $order->orderItems->count() }} Geschichte(n)<br />
        <strong style="color:#333;">Gesamtbetrag:</strong> {{ $order->total_price }} EUR<br />
        <strong style="color:#333;">Zahlungsmethode:</strong>
        {{ $order->payment_method === 'cod' ? __('website.cod') : __('website.online_payment') }}<br />
        <strong style="color:#333;">Bestellstatus:</strong>
        @if ($order->status === 'pending')
          Ausstehend
        @elseif($order->status === 'processing')
          In Bearbeitung
        @elseif($order->status === 'completed')
          Abgeschlossen
        @else
          Storniert
        @endif
        <br /><br />
        <strong style="color:#333;">Details zu den Geschichten:</strong><br />
        @foreach ($order->orderItems as $item)
          <div style="background:#fff; padding:10px; margin:5px 0; border-radius:5px; border-left:3px solid #fa7508;">
            <strong>Kind:</strong> {{ $item->child_name }} ({{ $item->child_age }} Jahre)<br />
            <strong>Sprache:</strong>
            {{ $item->language === 'arabic' ? 'Arabisch' : ($item->language === 'english' ? 'Englisch' : 'Deutsch') }}<br />
            <strong>Format:</strong>
            @if ($item->format === 'first_plan')
              Plan 1
            @elseif($item->format === 'second_plan')
              Plan 2
            @else
              Plan 3
            @endif
            <br />
            <strong>Preis:</strong> {{ $item->story_price }} EUR
          </div>
        @endforeach
      </div>

      <div style="text-align:center; margin:20px 0;">
        <a href="{{ route('admin.orders.show', $order->id) }}"
          style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">
          Bestelldetails ansehen
        </a>
      </div>

      <p style="margin-top:30px; font-size:14px; color:#999;">Mit freundlichen Grüßen ❤️ Ihr MyStoriesAi Team</p>
    @else
      <h2 style="color:#333;">New Order Received 🎉</h2>
      <p style="color:#555; font-size:16px;">
        A new order has been placed on your website. Here are the details:
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0;">
        <strong style="color:#333;">Order ID:</strong> #{{ $order->id }}<br />
        <strong style="color:#333;">Customer Name:</strong> {{ $order->user ? $order->user->name : 'Unknown' }}<br />
        <strong style="color:#333;">Number of Stories:</strong> {{ $order->orderItems->count() }} story/stories<br />
        <strong style="color:#333;">Total Amount:</strong> {{ $order->total_price }} EUR<br />
        <strong style="color:#333;">Payment Method:</strong>
        {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}<br />
        <strong style="color:#333;">Order Status:</strong>
        @if ($order->status === 'pending')
          Pending
        @elseif($order->status === 'processing')
          Processing
        @elseif($order->status === 'completed')
          Completed
        @else
          Cancelled
        @endif
        <br /><br />
        <strong style="color:#333;">Story Details:</strong><br />
        @foreach ($order->orderItems as $item)
          <div style="background:#fff; padding:10px; margin:5px 0; border-radius:5px; border-left:3px solid #fa7508;">
            <strong>Child:</strong> {{ $item->child_name }} ({{ $item->child_age }} years)<br />
            <strong>Language:</strong>
            {{ $item->language === 'arabic' ? 'Arabic' : ($item->language === 'english' ? 'English' : 'German') }}<br />
            <strong>Format:</strong>
            @if ($item->format === 'first_plan')
              Plan 1
            @elseif($item->format === 'second_plan')
              Plan 2
            @else
              Plan 3
            @endif
            <br />
            <strong>Price:</strong> {{ $item->story_price }} EUR
          </div>
        @endforeach
      </div>

      <div style="text-align:center; margin:20px 0;">
        <a href="{{ route('admin.orders.show', $order->id) }}"
          style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">
          View Order Details
        </a>
      </div>

      <p style="margin-top:30px; font-size:14px; color:#999;">
        Best regards ❤️ The MyStoriesAi Team
      </p>
    @endif
  </div>

  <!-- Footer -->
  <p style="margin-top:20px; font-size:12px; color:#aaa;">
    © {{ date('Y') }} MyStoriesAi. All rights reserved.
    <br />
    <a href="{{ config('app.url') }}" style="color:#555; text-decoration:none;">
      {{ $locale === 'ar' ? 'الموقع الرسمي' : ($locale === 'de' ? 'Offizielle Website' : 'Official Website') }}
    </a> |
    <a href="mailto:support@mystoriesai.com" style="color:#555; text-decoration:none;">
      {{ $locale === 'ar' ? 'اتصل بنا' : ($locale === 'de' ? 'Kontakt' : 'Contact Us') }}
    </a>
  </p>
</div>