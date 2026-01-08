<div style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:10px; text-align:center;">
  <!-- Logo -->
  <img src="{{ asset('assets/auth/logo.png') }}" alt="MyStoriesAi Logo" width="150"
    style="margin:0 auto 20px auto; width:100%; max-width:400px;" />

  <!-- Card -->
  <div
    style="max-width:600px; margin:0 auto; background:#fff; padding:10px; border-radius:12px; box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:{{ app()->getLocale() === 'ar' ? 'right' : 'left' }};"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    @if (app()->getLocale() === 'ar')
      <h2 style="color:#333; direction: rtl;">مرحباً {{ $notifiable->name }} 👋</h2>
      <p style="color:#555; font-size:16px; direction: rtl;">
        شكراً لانضمامك إلى <strong>MyStoriesAi</strong> 🚀
        يرجى النقر على الزر أدناه للتحقق من عنوان بريدك الإلكتروني:
      </p>

      <!-- Button -->
      <div style="text-align:center; margin:20px 0;">
        <a href="{{ $verificationUrl }}"
          style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">التحقق
          من البريد الإلكتروني</a>
      </div>

      <p style="color:#777; font-size:14px; direction: rtl;">
        إذا لم تقم بإنشاء هذا الحساب، يمكنك تجاهل هذا البريد الإلكتروني بأمان.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999; direction: rtl;">أطيب التحيات ❤️ فريق MyStoriesAi</p>
    @elseif(app()->getLocale() === 'de')
      <h2 style="color:#333;">Hallo {{ $notifiable->name }} 👋</h2>
      <p style="color:#555; font-size:16px;">
        Vielen Dank für Ihre Registrierung bei <strong>MyStoriesAi</strong> 🚀
        Bitte klicken Sie auf den untenstehenden Button, um Ihre E-Mail-Adresse zu verifizieren:
      </p>

      <!-- Button -->
      <div style="text-align:center; margin:20px 0;">
        <a href="{{ $verificationUrl }}"
          style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">E-Mail-Adresse
          verifizieren</a>
      </div>

      <p style="color:#777; font-size:14px;">
        Wenn Sie dieses Konto nicht erstellt haben, können Sie diese E-Mail einfach ignorieren.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999;">Mit freundlichen Grüßen ❤️ Ihr MyStoriesAi Team</p>
    @else
      <h2 style="color:#333;">Hello {{ $notifiable->name }} 👋</h2>
      <p style="color:#555; font-size:16px;">
        Thanks for joining <strong>MyStoriesAi</strong> 🚀
        Please click the button below to verify your email address:
      </p>

      <!-- Button -->
      <div style="text-align:center; margin:20px 0;">
        <a href="{{ $verificationUrl }}"
          style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">Verify
          Email Address</a>
      </div>

      <p style="color:#777; font-size:14px;">
        If you didn’t create this account, you can safely ignore this email.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999;">Best regards ❤️ The MyStoriesAi Team</p>
    @endif
  </div>

  <!-- Footer -->
  <p style="margin-top:20px; font-size:12px; color:#aaa;">
    © {{ date('Y') }} MyStoriesAi. All rights reserved.
    <br />
    <a href="{{ config('app.url') }}" style="color:#555; text-decoration:none;">
      {{ app()->getLocale() === 'ar' ? 'الموقع الرسمي' : (app()->getLocale() === 'de' ? 'Offizielle Website' : 'Official Website') }}
    </a>
    |
    <a href="mailto:support@mystoriesai.com" style="color:#555; text-decoration:none;">
      {{ app()->getLocale() === 'ar' ? 'اتصل بنا' : (app()->getLocale() === 'de' ? 'Kontakt' : 'Contact Us') }}
    </a>
  </p>
</div>