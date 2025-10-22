<div style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:10px; text-align:center;">
  <!-- Logo -->
  <img src="{{ config('app.url') }}/assets/auth/logo.webp" alt="MyStoryAI Logo" width="200" style="margin:0 auto 20px auto; width:100%; max-width:600px;" />

  <!-- Card -->
  <div style="max-width:600px; margin:0 auto; background:#fff; padding:20px; border-radius:12px; box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:{{ $locale === 'ar' ? 'right' : 'left' }};" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
    @if($locale === 'ar')
      <h2 style="color:#333; direction: rtl;">قصة طفلك جاهزة! - طلب رقم #{{ $order->id }} 📖✨</h2>
      <p style="color:#555; font-size:16px; direction: rtl;">
        مرحباً {{ $notifiable->name }}،
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0; direction: rtl;">
        <h3 style="color:#fa7508; margin-top:0;">تفاصيل القصة الجاهزة:</h3>
        <strong style="color:#333;">رقم الطلب:</strong> #{{ $order->id }}<br/>
        <strong style="color:#333;">اسم الطفل:</strong> {{ $order->child_name }}<br/>
        <strong style="color:#333;">عمر الطفل:</strong> {{ $order->child_age }} سنوات<br/>
        <strong style="color:#333;">التنسيق:</strong>
        @if($order->format === 'pdf')
          PDF فقط
        @elseif($order->format === 'soft')
          PDF + غلاف ناعم
        @else
          PDF + غلاف صلب
        @endif
        <br/>
        <strong style="color:#333;">تاريخ الإنجاز:</strong> {{ $order->updated_at->format('Y-m-d H:i') }}
      </div>

      <div style="background:#e8f5e8; padding:15px; border-radius:8px; margin:20px 0; direction: rtl;">
        <h4 style="color:#2d5a2d; margin-top:0;">🎉 تهانينا! قصة طفلك جاهزة الآن 🎉</h4>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          لقد أكملنا إنشاء القصة المخصصة لطفلك! القصة الآن جاهزة للتحميل والقراءة.
        </p>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          يمكنك الآن:
        </p>
        <ul style="color:#2d5a2d; font-size:14px; margin:5px 0; padding-right:20px;">
          <li>تحميل القصة وطباعتها</li>
          <li>قراءتها على جهازك اللوحي أو الهاتف</li>
          <li>مشاركتها مع العائلة والأصدقاء</li>
          @if($order->format !== 'pdf')
            <li>انتظار وصول النسخة المطبوعة قريباً</li>
          @endif
        </ul>
      </div>

      <div style="text-align:center; margin:20px 0;">
        <a href="{{ config('app.url') }}/storage/{{ $order->pdf_path }}" style="background:#fa7508; color:#fff; padding:12px 24px; text-decoration:none; border-radius:6px; display:inline-block; margin:5px;">
          📖 تحميل القصة الآن
        </a>
        <br/>
        <a href="{{ config('app.url') }}/orders/{{ $order->id }}" style="background:#007bff; color:#fff; padding:12px 24px; text-decoration:none; border-radius:6px; display:inline-block; margin:5px;">
          عرض تفاصيل الطلب
        </a>
      </div>

      <p style="color:#777; font-size:14px; direction: rtl;">
        نأمل أن تستمتع طفلك بقراءة قصته المخصصة! إذا كان لديك أي ملاحظات أو اقتراحات، يرجى التواصل معنا.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999; direction: rtl;">
        شكراً لاختيار MyStoryAI - حيث يصبح كل طفل بطلاً في قصته!
      </p>
    @else
      <h2 style="color:#333;">Your Child's Story is Ready! - Order #{{ $order->id }} 📖✨</h2>
      <p style="color:#555; font-size:16px;">
        Hello {{ $notifiable->name }},
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0;">
        <h3 style="color:#fa7508; margin-top:0;">Completed Story Details:</h3>
        <strong style="color:#333;">Order ID:</strong> #{{ $order->id }}<br/>
        <strong style="color:#333;">Child Name:</strong> {{ $order->child_name }}<br/>
        <strong style="color:#333;">Child Age:</strong> {{ $order->child_age }} years<br/>
        <strong style="color:#333;">Format:</strong>
        @if($order->format === 'pdf')
          PDF Only
        @elseif($order->format === 'soft')
          PDF + Softcover
        @else
          PDF + Hardcover
        @endif
        <br/>
        <strong style="color:#333;">Completion Date:</strong> {{ $order->updated_at->format('Y-m-d H:i') }}
      </div>

      <div style="background:#e8f5e8; padding:15px; border-radius:8px; margin:20px 0;">
        <h4 style="color:#2d5a2d; margin-top:0;">🎉 Congratulations! Your Child's Story is Ready 🎉</h4>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          We've completed creating your child's personalized story! The story is now ready for download and reading.
        </p>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          You can now:
        </p>
        <ul style="color:#2d5a2d; font-size:14px; margin:5px 0; padding-left:20px;">
          <li>Download and print the story</li>
          <li>Read it on your tablet or phone</li>
          <li>Share it with family and friends</li>
          @if($order->format !== 'pdf')
            <li>Wait for your printed copy to arrive soon</li>
          @endif
        </ul>
      </div>

      <div style="text-align:center; margin:20px 0;">
        <a href="{{ config('app.url') }}/storage/{{ $order->pdf_path }}" style="background:#fa7508; color:#fff; padding:12px 24px; text-decoration:none; border-radius:6px; display:inline-block; margin:5px;">
          📖 Download Story Now
        </a>
        <br/>
        <a href="{{route('user.orders.show', $order->id)}}" style="background:#007bff; color:#fff; padding:12px 24px; text-decoration:none; border-radius:6px; display:inline-block; margin:5px;">
          View Order Details
        </a>
      </div>

      <p style="color:#777; font-size:14px;">
        We hope your child enjoys reading their personalized story! If you have any feedback or suggestions, please contact us.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999;">
        Thank you for choosing MyStoryAI - where every child becomes the hero of their story!
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
