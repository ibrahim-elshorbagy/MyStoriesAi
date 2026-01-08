<div style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:10px; text-align:center;">
  <!-- Logo -->
  <img src="{{ asset('assets/auth/logo.png') }}" alt="MyStoriesAi Logo" width="150"
    style="margin:0 auto 20px auto; width:100%; max-width:400px;" />

  <!-- Card -->
  <div
    style="max-width:600px; margin:0 auto; background:#fff; padding:20px; border-radius:12px; box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:{{ $locale === 'ar' ? 'right' : 'left' }};"
    dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
    @if ($locale === 'ar')
      <h2 style="color:#333; direction: rtl;">تحديث حالة الدفع - طلب رقم #{{ $order->id }} 🎉</h2>
      <p style="color:#555; font-size:16px; direction: rtl;">
        مرحباً {{ $notifiable->name }}،
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0; direction: rtl;">
        <h3 style="color:#fa7508; margin-top:0;">تفاصيل الدفع المحدث:</h3>
        <strong style="color:#333;">رقم الطلب:</strong> #{{ $order->id }}<br />
        <strong style="color:#333;">اسم الطفل:</strong> {{ $order->child_name }}<br />
        <strong style="color:#333;">طريقة الدفع:</strong>
        {{ $payment->payment_method === 'cod' ? 'الدفع عند الاستلام' : 'دفع إلكتروني' }}<br />
        <strong style="color:#333;">المبلغ:</strong> {{ $payment->amount }} EUR<br />
        <strong style="color:#333;">الحالة الجديدة:</strong>
        @if ($payment->status === 'paid')
          <span style="color:#28a745;">تم الدفع</span>
        @elseif($payment->status === 'pending')
          <span style="color:#ffc107;">في الانتظار</span>
        @elseif($payment->status === 'failed')
          <span style="color:#dc3545;">فشل في الدفع</span>
        @else
          <span style="color:#6c757d;">تم الاسترداد</span>
        @endif
        <br />
        {{-- @if ($payment->transaction_id)
          <strong style="color:#333;">رقم المعاملة:</strong> {{ $payment->transaction_id }}<br />
        @endif --}}
      </div>

      <div style="background:#e8f5e8; padding:15px; border-radius:8px; margin:20px 0; direction: rtl;">
        <h4 style="color:#2d5a2d; margin-top:0;">ماذا يعني ذلك؟</h4>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          @if ($payment->status === 'paid')
            تم تأكيد دفعك بنجاح. سنبدأ في معالجة طلبك قريباً.
          @elseif($payment->status === 'pending')
            دفعك لا يزال قيد المراجعة. سنقوم بتحديثك عند تأكيد الدفع.
          @elseif($payment->status === 'failed')
            لم نتمكن من معالجة دفعتك. يرجى المحاولة مرة أخرى أو التواصل معنا.
          @else
            تم استرداد مبلغ الدفع. إذا كان لديك أي أسئلة، يرجى التواصل معنا.
          @endif
        </p>
      </div>

      <p style="color:#777; font-size:14px; direction: rtl;">
        إذا كان لديك أي أسئلة حول هذا التحديث، يرجى التواصل معنا.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999; direction: rtl;">
        شكراً لاختيار MyStoriesAi!
      </p>
    @elseif($locale === 'de')
      <h2 style="color:#333;">Zahlungsstatus-Update – Bestellung #{{ $order->id }} 🎉</h2>
      <p style="color:#555; font-size:16px;">
        Hallo {{ $notifiable->name }},
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0;">
        <h3 style="color:#fa7508; margin-top:0;">Aktualisierte Zahlungsdetails:</h3>
        <strong style="color:#333;">Bestellnummer:</strong> #{{ $order->id }}<br />
        <strong style="color:#333;">Name des Kindes:</strong> {{ $order->child_name }}<br />
        <strong style="color:#333;">Zahlungsmethode:</strong>
        {{ $payment->payment_method === 'cod' ? 'Zahlung bei Lieferung' : 'Online-Zahlung' }}<br />
        <strong style="color:#333;">Betrag:</strong> {{ $payment->amount }} EUR<br />
        <strong style="color:#333;">Neuer Status:</strong>
        @if ($payment->status === 'paid')
          <span style="color:#28a745;">Bezahlt</span>
        @elseif($payment->status === 'pending')
          <span style="color:#ffc107;">Ausstehend</span>
        @elseif($payment->status === 'failed')
          <span style="color:#dc3545;">Fehlgeschlagen</span>
        @else
          <span style="color:#6c757d;">Erstattet</span>
        @endif
        <br />
        {{-- @if ($payment->transaction_id)
          <strong style="color:#333;">Transaktions-ID:</strong> {{ $payment->transaction_id }}<br />
        @endif --}}
      </div>

      <div style="background:#e8f5e8; padding:15px; border-radius:8px; margin:20px 0;">
        <h4 style="color:#2d5a2d; margin-top:0;">Was bedeutet das?</h4>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          @if ($payment->status === 'paid')
            Ihre Zahlung wurde erfolgreich bestätigt. Wir beginnen in Kürze mit der Bearbeitung Ihrer Bestellung.
          @elseif($payment->status === 'pending')
            Ihre Zahlung wird derzeit geprüft. Wir informieren Sie, sobald sie bestätigt wurde.
          @elseif($payment->status === 'failed')
            Wir konnten Ihre Zahlung leider nicht verarbeiten. Bitte versuchen Sie es erneut oder kontaktieren Sie uns.
          @else
            Ihre Zahlung wurde erstattet. Wenn Sie Fragen haben, kontaktieren Sie uns bitte.
          @endif
        </p>
      </div>

      <p style="color:#777; font-size:14px;">
        Wenn Sie Fragen zu diesem Update haben, kontaktieren Sie uns bitte jederzeit.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999;">
        Vielen Dank, dass Sie MyStoriesAi gewählt haben!
      </p>
    @else
      <h2 style="color:#333;">Payment Status Update – Order #{{ $order->id }} 🎉</h2>
      <p style="color:#555; font-size:16px;">
        Hello {{ $notifiable->name }},
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0;">
        <h3 style="color:#fa7508; margin-top:0;">Updated Payment Details:</h3>
        <strong style="color:#333;">Order ID:</strong> #{{ $order->id }}<br />
        <strong style="color:#333;">Child Name:</strong> {{ $order->child_name }}<br />
        <strong style="color:#333;">Payment Method:</strong>
        {{ $payment->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}<br />
        <strong style="color:#333;">Amount:</strong> {{ $payment->amount }} EUR<br />
        <strong style="color:#333;">New Status:</strong>
        @if ($payment->status === 'paid')
          <span style="color:#28a745;">Paid</span>
        @elseif($payment->status === 'pending')
          <span style="color:#ffc107;">Pending</span>
        @elseif($payment->status === 'failed')
          <span style="color:#dc3545;">Failed</span>
        @else
          <span style="color:#6c757d;">Refunded</span>
        @endif
        <br />
        {{-- @if ($payment->transaction_id)
          <strong style="color:#333;">Transaction ID:</strong> {{ $payment->transaction_id }}<br />
        @endif --}}
      </div>

      <div style="background:#e8f5e8; padding:15px; border-radius:8px; margin:20px 0;">
        <h4 style="color:#2d5a2d; margin-top:0;">What does this mean?</h4>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          @if ($payment->status === 'paid')
            Your payment has been confirmed successfully. We’ll start processing your order shortly.
          @elseif($payment->status === 'pending')
            Your payment is currently under review. We’ll notify you once it has been confirmed.
          @elseif($payment->status === 'failed')
            We were unable to process your payment. Please try again or contact us for assistance.
          @else
            Your payment has been refunded. If you have any questions, please contact us.
          @endif
        </p>
      </div>

      <p style="color:#777; font-size:14px;">
        If you have any questions about this update, please feel free to contact us.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999;">
        Thank you for choosing MyStoriesAi!
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
