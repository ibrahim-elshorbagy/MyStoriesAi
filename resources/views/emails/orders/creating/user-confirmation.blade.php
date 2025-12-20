<div style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:10px; text-align:center;">
  <!-- Logo -->
  <img src="{{ asset('assets/auth/logo.png') }}" alt="MyStoriesAi Logo" width="150" style="margin:0 auto 20px auto; width:100%; max-width:400px;" />

  <!-- Card -->
  <div style="max-width:600px; margin:0 auto; background:#fff; padding:20px; border-radius:12px; box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:{{ $locale === 'ar' ? 'right' : 'left' }};" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
  @if($locale === 'ar')
      <h2 style="color:#333; direction: rtl;">شكراً لك {{ $notifiable->name }} 🎉</h2>
      <p style="color:#555; font-size:16px; direction: rtl;">
        تم إنشاء طلبك بنجاح! نحن متحمسون لإنشاء قصص مخصصة لأطفالك.
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0; direction: rtl;">
        <h3 style="color:#fa7508; margin-top:0;">تفاصيل طلبك:</h3>
        <strong style="color:#333;">رقم الطلب:</strong> #{{ $order->id }}<br/>
        <strong style="color:#333;">عدد القصص:</strong> {{ $order->orderItems->count() }} قصة<br/>
        <strong style="color:#333;">المبلغ الإجمالي:</strong> {{ $order->total_price }} EUR<br/>
        <strong style="color:#333;">طريقة الدفع:</strong> {{ $order->payment_method === 'cod' ? 'الدفع عند الاستلام' : 'دفع إلكتروني' }}
        <br/><br/>
        <strong style="color:#333;">تفاصيل القصص:</strong><br/>
        @foreach($order->orderItems as $item)
          <div style="background:#fff; padding:10px; margin:5px 0; border-radius:5px; border-right:3px solid #fa7508; direction: rtl;">
            <strong>الطفل:</strong> {{ $item->child_name }} ({{ $item->child_age }} سنوات)<br/>
            <strong>اللغة:</strong> {{ $item->language === 'arabic' ? 'العربية' : ($item->language === 'english' ? 'الإنجليزية' : 'الألمانية') }}<br/>
            <strong>التنسيق:</strong>
            @if($item->format === 'first_plan')
              الخطة الأولى
            @elseif($item->format === 'second_plan')
              الخطة الثانية
            @else
              الخطة الثالثة
            @endif
            <br/>
            <strong>السعر:</strong> {{ $item->story_price }} EUR
          </div>
        @endforeach
      </div>

      <div style="background:#e8f5e8; padding:15px; border-radius:8px; margin:20px 0; direction: rtl;">
        <h4 style="color:#2d5a2d; margin-top:0;">ماذا سيحدث الآن؟</h4>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          ✅ سيقوم فريقنا بمراجعة طلبك<br/>
          ✅ سنبدأ في إنشاء القصص المخصصة لأطفالك<br/>
          ✅ ستتلقى تحديثات عبر البريد الإلكتروني<br/>
        </p>
      </div>

      <div style="text-align:center; margin:20px 0;">
        <a href="{{ route('user.orders.show', $order->id) }}" style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">
          عرض طلبي
        </a>
      </div>

      <p style="color:#777; font-size:14px; direction: rtl;">
        إذا كان لديك أي أسئلة، لا تتردد في التواصل معنا.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999; direction: rtl;">
        شكراً لاختيارك MyStoriesAi ❤️
      </p>
    @elseif($locale === 'de')
      <h2 style="color:#333;">Vielen Dank {{ $notifiable->name }} 🎉</h2>
      <p style="color:#555; font-size:16px;">
        Ihre Bestellung wurde erfolgreich erstellt! Wir freuen uns darauf, personalisierte Geschichten für Ihre Kinder zu erstellen.
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0;">
        <h3 style="color:#fa7508; margin-top:0;">Ihre Bestelldetails:</h3>
        <strong style="color:#333;">Bestellnummer:</strong> #{{ $order->id }}<br/>
        <strong style="color:#333;">Anzahl Geschichten:</strong> {{ $order->orderItems->count() }} Geschichte(n)<br/>
        <strong style="color:#333;">Gesamtbetrag:</strong> {{ $order->total_price }} EUR<br/>
        <strong style="color:#333;">Zahlungsmethode:</strong> {{ $order->payment_method === 'cod' ? 'Zahlung bei Lieferung' : 'Online-Zahlung' }}
        <br/><br/>
        <strong style="color:#333;">Geschichtsdetails:</strong><br/>
        @foreach($order->orderItems as $item)
          <div style="background:#fff; padding:10px; margin:5px 0; border-radius:5px; border-left:3px solid #fa7508;">
            <strong>Kind:</strong> {{ $item->child_name }} ({{ $item->child_age }} Jahre)<br/>
            <strong>Sprache:</strong> {{ $item->language === 'arabic' ? 'Arabisch' : ($item->language === 'english' ? 'Englisch' : 'Deutsch') }}<br/>
            <strong>Format:</strong>
            @if($item->format === 'first_plan')
              Erster Plan
            @elseif($item->format === 'second_plan')
              Zweiter Plan
            @else
              Dritter Plan
            @endif
            <br/>
            <strong>Preis:</strong> {{ $item->story_price }} EUR
          </div>
        @endforeach
      </div>

      <div style="background:#e8f5e8; padding:15px; border-radius:8px; margin:20px 0;">
        <h4 style="color:#2d5a2d; margin-top:0;">Was passiert jetzt?</h4>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          ✅ Unser Team prüft Ihre Bestellung<br/>
          ✅ Wir beginnen mit der Erstellung der personalisierten Geschichten für Ihre Kinder<br/>
          ✅ Sie erhalten per E-Mail Updates zum Fortschritt<br/>
        </p>
      </div>

      <div style="text-align:center; margin:20px 0;">
        <a href="{{ route('user.orders.show', $order->id) }}" style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">
          Meine Bestellung ansehen
        </a>
      </div>

      <p style="color:#777; font-size:14px;">Bei Fragen kontaktieren Sie uns bitte.</p>

      <p style="margin-top:30px; font-size:14px; color:#999;">Vielen Dank, dass Sie MyStoriesAi gewählt haben ❤️</p>
    @else
      <h2 style="color:#333;">Thank you {{ $notifiable->name }} 🎉</h2>
      <p style="color:#555; font-size:16px;">
        Your order has been successfully created! We're excited to create personalized stories for your children.
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0;">
        <h3 style="color:#fa7508; margin-top:0;">Your Order Details:</h3>
        <strong style="color:#333;">Order Number:</strong> #{{ $order->id }}<br/>
        <strong style="color:#333;">Number of Stories:</strong> {{ $order->orderItems->count() }} story/stories<br/>
        <strong style="color:#333;">Total Amount:</strong> {{ $order->total_price }} EUR<br/>
        <strong style="color:#333;">Payment Method:</strong> {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}
        <br/><br/>
        <strong style="color:#333;">Story Details:</strong><br/>
        @foreach($order->orderItems as $item)
          <div style="background:#fff; padding:10px; margin:5px 0; border-radius:5px; border-left:3px solid #fa7508;">
            <strong>Child:</strong> {{ $item->child_name }} ({{ $item->child_age }} years)<br/>
            <strong>Language:</strong> {{ $item->language === 'arabic' ? 'Arabic' : ($item->language === 'english' ? 'English' : 'German') }}<br/>
            <strong>Format:</strong>
            @if($item->format === 'first_plan')
              First Plan
            @elseif($item->format === 'second_plan')
              Second Plan
            @else
              Third Plan
            @endif
            <br/>
            <strong>Price:</strong> {{ $item->story_price }} EUR
          </div>
        @endforeach
      </div>

      <div style="background:#e8f5e8; padding:15px; border-radius:8px; margin:20px 0;">
        <h4 style="color:#2d5a2d; margin-top:0;">What happens next?</h4>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          ✅ Our team will review your order<br/>
          ✅ We'll start creating your children's personalized stories<br/>
          ✅ You'll receive email updates on progress<br/>
        </p>
      </div>

      <div style="text-align:center; margin:20px 0;">
        <a href="{{ route('user.orders.show', $order->id) }}" style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">
          View My Order
        </a>
      </div>

      <p style="color:#777; font-size:14px;">
        If you have any questions, don't hesitate to contact us.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999;">
        Thank you for choosing MyStoriesAi ❤️
      </p>
    @endif
  </div>

  <!-- Footer -->
  <p style="margin-top:20px; font-size:12px; color:#aaa;">
    © {{ date('Y') }} MyStoriesAi. All rights reserved.
    <br/>
    <a href="{{ config('app.url') }}" style="color:#555; text-decoration:none;">{{ $locale === 'ar' ? 'الموقع الرسمي' : 'Official Website' }}</a> |
    <a href="mailto:MyStoriesAi.webiste@gmail.com" style="color:#555; text-decoration:none;">{{ $locale === 'ar' ? 'اتصل بنا' : 'Contact Us' }}</a>
  </p>
</div>
