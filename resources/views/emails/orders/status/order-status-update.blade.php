<div style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:10px; text-align:center;">
  <!-- Logo -->
  <img src="{{ config('app.url') }}/assets/auth/logo.webp" alt="MyStoryAI Logo" width="200" style="margin:0 auto 20px auto; width:100%; max-width:600px;" />

  <!-- Card -->
  <div style="max-width:600px; margin:0 auto; background:#fff; padding:20px; border-radius:12px; box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:{{ $locale === 'ar' ? 'right' : 'left' }};" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
    @if($locale === 'ar')
      <h2 style="color:#333; direction: rtl;">تحديث حالة الطلب - رقم #{{ $order->id }} 🎉</h2>
      <p style="color:#555; font-size:16px; direction: rtl;">
        مرحباً {{ $notifiable->name }}،
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0; direction: rtl;">
        <h3 style="color:#fa7508; margin-top:0;">تفاصيل الطلب المحدث:</h3>
        <strong style="color:#333;">رقم الطلب:</strong> #{{ $order->id }}<br/>
        <strong style="color:#333;">اسم الطفل:</strong> {{ $order->child_name }}<br/>
        <strong style="color:#333;">الحالة الجديدة:</strong>
        @if($order->status === 'processing')
          <span style="color:#ffc107;">قيد المعالجة</span>
        @elseif($order->status === 'completed')
          <span style="color:#28a745;">مكتمل</span>
        @elseif($order->status === 'cancelled')
          <span style="color:#dc3545;">ملغي</span>
        @else
          <span style="color:#6c757d;">في الانتظار</span>
        @endif
        <br/>
        <strong style="color:#333;">تاريخ التحديث:</strong> {{ $order->updated_at->format('Y-m-d H:i') }}
      </div>

      <div style="background:#e8f5e8; padding:15px; border-radius:8px; margin:20px 0; direction: rtl;">
        <h4 style="color:#2d5a2d; margin-top:0;">ماذا يعني ذلك؟</h4>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          @if($order->status === 'processing')
            بدأنا في العمل على قصة طفلك! سنقوم بإنشاء القصة المخصصة وإعدادها للطباعة أو الإرسال الرقمي.
          @elseif($order->status === 'completed')
            تم الانتهاء من قصة طفلك بنجاح! ستتلقى القصة قريباً حسب طريقة التوصيل التي اخترتها.
          @elseif($order->status === 'cancelled')
            تم إلغاء طلبك. إذا كان هذا خطأ أو كان لديك أي أسئلة، يرجى التواصل معنا فوراً.
          @else
            طلبك قيد الانتظار. سنبدأ المعالجة قريباً.
          @endif
        </p>
      </div>

      @if($order->status === 'completed')
      <div style="text-align:center; margin:20px 0;">
        <a href="{{ config('app.url') }}/orders/{{ $order->id }}" style="background:#fa7508; color:#fff; padding:12px 24px; text-decoration:none; border-radius:6px; display:inline-block;">
          عرض تفاصيل الطلب
        </a>
      </div>
      @endif

      <p style="color:#777; font-size:14px; direction: rtl;">
        إذا كان لديك أي أسئلة حول حالة طلبك، يرجى التواصل معنا.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999; direction: rtl;">
        شكراً لاختيار MyStoryAI!
      </p>
    @else
      <h2 style="color:#333;">Order Status Update - #{{ $order->id }} 🎉</h2>
      <p style="color:#555; font-size:16px;">
        Hello {{ $notifiable->name }},
      </p>

      <div style="background:#f8f9fa; padding:15px; border-radius:8px; margin:20px 0;">
        <h3 style="color:#fa7508; margin-top:0;">Updated Order Details:</h3>
        <strong style="color:#333;">Order ID:</strong> #{{ $order->id }}<br/>
        <strong style="color:#333;">Child Name:</strong> {{ $order->child_name }}<br/>
        <strong style="color:#333;">New Status:</strong>
        @if($order->status === 'processing')
          <span style="color:#ffc107;">Processing</span>
        @elseif($order->status === 'completed')
          <span style="color:#28a745;">Completed</span>
        @elseif($order->status === 'cancelled')
          <span style="color:#dc3545;">Cancelled</span>
        @else
          <span style="color:#6c757d;">Pending</span>
        @endif
        <br/>
        <strong style="color:#333;">Update Date:</strong> {{ $order->updated_at->format('Y-m-d H:i') }}
      </div>

      <div style="background:#e8f5e8; padding:15px; border-radius:8px; margin:20px 0;">
        <h4 style="color:#2d5a2d; margin-top:0;">What does this mean?</h4>
        <p style="color:#2d5a2d; font-size:14px; margin:5px 0;">
          @if($order->status === 'processing')
            We've started working on your child's story! We'll create the personalized story and prepare it for printing or digital delivery.
          @elseif($order->status === 'completed')
            Your child's story has been completed successfully! You'll receive the story soon according to your chosen delivery method.
          @elseif($order->status === 'cancelled')
            Your order has been cancelled. If this was a mistake or you have any questions, please contact us immediately.
          @else
            Your order is pending. We'll start processing it soon.
          @endif
        </p>
      </div>

      @if($order->status === 'completed')
      <div style="text-align:center; margin:20px 0;">
        <a href="{{ config('app.url') }}/orders/{{ $order->id }}" style="background:#fa7508; color:#fff; padding:12px 24px; text-decoration:none; border-radius:6px; display:inline-block;">
          View Order Details
        </a>
      </div>
      @endif

      <p style="color:#777; font-size:14px;">
        If you have any questions about your order status, please contact us.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999;">
        Thank you for choosing MyStoryAI!
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
