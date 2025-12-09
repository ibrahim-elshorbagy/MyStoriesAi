<div style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:10px; text-align:center;">
        <!-- Logo -->
        <img src="{{ asset('assets/auth/logo.png') }}" alt="MyStoryAI Logo" width="200" style="margin:0 auto 20px auto; width:100%; max-width:600px;" />

        <!-- Card -->
        <div style="max-width:600px; margin:0 auto; background:#fff; padding:10px; border-radius:12px; box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:{{ app()->getLocale() === 'ar' ? 'right' : 'left' }};" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
          @if(app()->getLocale() === 'ar')
            <h2 style="color:#333; direction: rtl;">مرحباً {{ $notifiable->name }} 👋</h2>
            <p style="color:#555; font-size:16px; direction: rtl;">
              تلقيت هذا البريد الإلكتروني لأننا تلقينا طلب إعادة تعيين كلمة المرور لحسابك. 🚀
              انقر على الزر أدناه لإعادة تعيين كلمة المرور:
            </p>

            <!-- Button -->
            <div style="text-align:center; margin:20px 0;">
              <a href="{{ $resetUrl }}" style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">إعادة تعيين كلمة المرور</a>
            </div>

            <p style="color:#777; font-size:14px; direction: rtl;">
              إذا لم تطلب إعادة تعيين كلمة المرور، فلا حاجة لاتخاذ أي إجراء آخر.
            </p>

            <p style="margin-top:30px; font-size:14px; color:#999; direction: rtl;">أطيب التحيات ❤️ فريق MyStoryAI</p>
          @elseif(app()->getLocale() === 'de')
            <h2 style="color:#333;">Hallo {{ $notifiable->name }} 👋</h2>
            <p style="color:#555; font-size:16px;">
              Sie erhalten diese E-Mail, weil wir eine Anfrage zum Zurücksetzen des Passworts für Ihr Konto erhalten haben. 🚀
              Klicken Sie auf den untenstehenden Button, um Ihr Passwort zurückzusetzen:
            </p>

            <!-- Button -->
            <div style="text-align:center; margin:20px 0;">
              <a href="{{ $resetUrl }}" style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">Passwort zurücksetzen</a>
            </div>

            <p style="color:#777; font-size:14px;">
              Wenn Sie das Zurücksetzen des Passworts nicht angefordert haben, ist keine weitere Aktion erforderlich.
            </p>

            <p style="margin-top:30px; font-size:14px; color:#999;">Mit freundlichen Grüßen ❤️ Das MyStoryAI Team</p>
          @else
            <h2 style="color:#333;">Hello {{ $notifiable->name }} 👋</h2>
            <p style="color:#555; font-size:16px;">
              You are receiving this email because we received a password reset request for your account. 🚀
              Click the button below to reset your password:
            </p>

            <!-- Button -->
            <div style="text-align:center; margin:20px 0;">
              <a href="{{ $resetUrl }}" style="background:#fa7508; color:#fff; padding:15px 30px; text-decoration:none; border-radius:8px; display:inline-block;">Reset Password</a>
            </div>

            <p style="color:#777; font-size:14px;">
              If you did not request a password reset, no further action is required.
            </p>

            <p style="margin-top:30px; font-size:14px; color:#999;">Best regards ❤️ The MyStoryAI Team</p>
          @endif
        </div>

        <!-- Footer -->
        <p style="margin-top:20px; font-size:12px; color:#aaa;">
          © {{ date('Y') }} MyStoryAI. All rights reserved.
          <br/>
          <a href="{{ config('app.url') }}" style="color:#555; text-decoration:none;">{{ app()->getLocale() === 'ar' ? 'الموقع الرسمي' : 'Official Website' }}</a> |
          <a href="mailto:mystoryai.webiste@gmail.com" style="color:#555; text-decoration:none;">{{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us' }}</a>
        </p>
      </div>
