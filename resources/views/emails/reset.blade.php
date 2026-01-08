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
        تلقيت هذا البريد الإلكتروني لأننا تلقينا طلب إعادة تعيين كلمة المرور لحسابك. 🚀
        انقر على الزر أدناه لإعادة تعيين كلمة المرور:
      </p>

      <!-- Button -->
      <div style="text-align:center; margin:20px 0;">
        <a href="{{ $resetUrl }}"
          style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">إعادة
          تعيين كلمة المرور</a>
      </div>

      <p style="color:#777; font-size:14px; direction: rtl;">
        إذا لم تطلب إعادة تعيين كلمة المرور، فلا حاجة لاتخاذ أي إجراء آخر.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999; direction: rtl;">أطيب التحيات ❤️ فريق MyStoriesAi</p>
    @elseif(app()->getLocale() === 'de')
      <h2 style="color:#333;">Hallo {{ $notifiable->name }} 👋</h2>
      <p style="color:#555; font-size:16px;">
        Sie erhalten diese E-Mail, weil wir eine Anfrage zum Zurücksetzen des Passworts für Ihr MyStoriesAi-Konto erhalten haben. 🚀
        Klicken Sie auf die Schaltfläche unten, um Ihr Passwort zurückzusetzen:
      </p>

      <!-- Button -->
      <div style="text-align:center; margin:20px 0;">
        <a href="{{ $resetUrl }}"
          style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">Passwort
          zurücksetzen</a>
      </div>

      <p style="color:#777; font-size:14px;">
        Falls Sie keine Passwort-Zurücksetzung angefordert haben, ist keine weitere Aktion erforderlich.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999;">Mit freundlichen Grüßen ❤️ Ihr MyStoriesAi-Team</p>
    @else
      <h2 style="color:#333;">Hello {{ $notifiable->name }} 👋</h2>
      <p style="color:#555; font-size:16px;">
        You’re receiving this email because we received a request to reset the password for your MyStoriesAi account. 🚀
        Click the button below to reset your password:
      </p>

      <!-- Button -->
      <div style="text-align:center; margin:20px 0;">
        <a href="{{ $resetUrl }}"
          style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">Reset
          Password</a>
      </div>

      <p style="color:#777; font-size:14px;">
        If you didn’t request a password reset, no further action is required.
      </p>

      <p style="margin-top:30px; font-size:14px; color:#999;">Best regards ❤️ The MyStoriesAi Team</p>
    @endif
  </div>

  <!-- Footer -->
  <p style="margin-top:20px; font-size:12px; color:#aaa;">
    © {{ date('Y') }} MyStoriesAi. All rights reserved.
    <br />
    <a href="{{ config('app.url') }}"
      style="color:#555; text-decoration:none;">
      @if(app()->getLocale() === 'ar')
        الموقع الرسمي
      @elseif(app()->getLocale() === 'de')
        Offizielle Website
      @else
        Official Website
      @endif
    </a>
    |
    <a href="mailto:support@mystoriesai.com"
      style="color:#555; text-decoration:none;">
      @if(app()->getLocale() === 'ar')
        اتصل بنا
      @elseif(app()->getLocale() === 'de')
        Kontakt
      @else
        Contact Us
      @endif
    </a>
  </p>
</div>