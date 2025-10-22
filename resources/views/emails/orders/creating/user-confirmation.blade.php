<div style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:10px; text-align:center;">
  <!-- Logo -->
  <img src="{{ config('app.url') }}/assets/auth/logo.webp" alt="MyStoryAI Logo" width="200" style="margin:0 auto 20px auto; width:100%; max-width:600px;" />

  <!-- Card -->
  <div style="max-width:600px; margin:0 auto; background:#fff; padding:20px; border-radius:12px; box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:{{ $locale === 'ar' ? 'right' : 'left' }};" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
    @if($locale === 'ar')
      <h2 style="color:#333; direction: rtl;">شكراً لك {{ $notifiable->name }} 🎉</h2>
      <p style="color:#555; font-size:16px; direction: rtl;">
        تم إنشاء طلبك بنجاح! نحن متحمسون لإنشاء قصة مخصصة لطفلك.
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0; direction: rtl;">
        <h3 style="color:#fa7508; margin-top:0;">تفاصيل طلبك:</h3>
        <strong style="color:#333;">رقم الطلب:</strong> #{{ $order->id }}<br/>
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
        <strong style="color:#333;">طريقة الدفع:</strong> {{ $order->payment_method === 'cod' ? 'الدفع عند الاستلام' : 'دفع إلكتروني' }}
      </div>

      <div style="background:#e8f5e8; padding:15px; border-radius:8px; margin:20px 0; direction: rtl;">
        <h4 style="color:#2d5a2d; margin-top:0;">ماذا سيحدث الآن؟</h4>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          ✅ سيقوم فريقنا بمراجعة طلبك<br/>
          ✅ سنبدأ في إنشاء القصة المخصصة لطفلك<br/>
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
        شكراً لاختيارك MyStoryAI ❤️
      </p>
    @else
      <h2 style="color:#333;">Thank you {{ $notifiable->name }} 🎉</h2>
      <p style="color:#555; font-size:16px;">
        Your order has been successfully created! We're excited to create a personalized story for your child.
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0;">
        <h3 style="color:#fa7508; margin-top:0;">Your Order Details:</h3>
        <strong style="color:#333;">Order Number:</strong> #{{ $order->id }}<br/>
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
        <strong style="color:#333;">Payment Method:</strong> {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}
      </div>

      <div style="background:#e8f5e8; padding:15px; border-radius:8px; margin:20px 0;">
        <h4 style="color:#2d5a2d; margin-top:0;">What happens next?</h4>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          ✅ Our team will review your order<br/>
          ✅ We'll start creating your child's personalized story<br/>
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
        Thank you for choosing MyStoryAI ❤️
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
