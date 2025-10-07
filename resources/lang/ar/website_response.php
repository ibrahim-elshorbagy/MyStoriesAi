<?php

return [
  /*
  |--------------------------------------------------------------------------
  | All Website Controllers Responses Lines
  |--------------------------------------------------------------------------
  |
  |
  */

  'language_changed_title' => 'تم تغيير اللغة',
  'language_changed_message' => 'تم تغيير اللغة بنجاح.',
  "blocked_account"=>"تم حظر حسابك. يُرجى التواصل مع المسؤول.",

  /* Auth Controller Responses */
  'login_successful_title' => 'تم تسجيل الدخول بنجاح',
  'login_successful_message' => 'مرحباً بعودتك! تم تسجيل دخولك بنجاح.',
  'logout_successful_title' => 'تم تسجيل الخروج',
  'logout_successful_message' => 'تم تسجيل خروجك بنجاح.',
  'registration_successful_title' => 'تم إنشاء الحساب بنجاح',
  'registration_successful_message' => 'تم إنشاء حسابك بنجاح. مرحباً بك!',
  'password_reset_link_sent_title' => 'تم إرسال رابط إعادة تعيين كلمة المرور',
  'password_reset_link_sent_message' => 'تم إرسال رابط إعادة تعيين كلمة المرور إلى عنوان بريدك الإلكتروني.',
  'password_reset_successful_title' => 'تم إعادة تعيين كلمة المرور بنجاح',
  'password_reset_successful_message' => 'تم إعادة تعيين كلمة المرور بنجاح. يمكنك الآن تسجيل الدخول.',
  'verification_link_sent_title' => 'تم إرسال رابط التحقق',
  'verification_link_sent_message' => 'تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.',
  'password_confirmed_title' => 'تم تأكيد كلمة المرور',
  'password_confirmed_message' => 'تم تأكيد كلمة المرور بنجاح.',

  /* Auth Validation Messages */
  'username_required' => 'حقل اسم المستخدم مطلوب.',
  'password_required' => 'حقل كلمة المرور مطلوب.',
  'name_required' => 'حقل الاسم مطلوب.',
  'username_unique' => 'اسم المستخدم هذا مُستخدم بالفعل.',
  'email_required' => 'حقل البريد الإلكتروني مطلوب.',
  'email_invalid' => 'يرجى إدخال عنوان بريد إلكتروني صحيح.',
  'email_unique' => 'هذا البريد الإلكتروني مُسجل بالفعل.',
  'password_confirmation' => 'تأكيد كلمة المرور غير متطابق.',
  'phone_invalid' => 'يرجى إدخال رقم هاتف صحيح (مثال: +1234567890).',
  /* End Auth Validation Messages */

  /* End Auth Controller Responses */

  /* Profile Controller Responses */
  'profile_updated_title' => 'تم تحديث الملف الشخصي',
  'profile_updated_message' => 'تم تحديث معلومات ملفك الشخصي بنجاح.',
  'account_deleted_title' => 'تم حذف الحساب',
  'account_deleted_message' => 'تم حذف حسابك بشكل دائم.',
  'password_updated_title' => 'تم تحديث كلمة المرور',
  'password_updated_message' => 'تم تحديث كلمة المرور الخاصة بك بنجاح.',
  'profile_image_updated_title' => 'تم تحديث الصورة ',
  'profile_image_updated_message' => 'تم تحديث صورة الملف الشخصي بنجاح.',

  /* User Management Responses */
  'user_created_title' => 'تم إنشاء المستخدم',
  'user_created_message' => 'تم إنشاء المستخدم بنجاح.',
  'user_updated_title' => 'تم تحديث المستخدم',
  'user_updated_message' => 'تم تحديث المستخدم بنجاح.',
  'user_deleted_title' => 'تم حذف المستخدم',
  'user_deleted_message' => 'تم حذف المستخدم بنجاح.',
  'users_deleted_title' => 'تم حذف المستخدمين',
  'users_deleted_message' => 'تم حذف :count من المستخدمين بنجاح.',
  'user_blocked_title' => 'تم حظر المستخدم',
  'user_blocked_message' => 'تم حظر المستخدم بنجاح.',
  'user_unblocked_title' => 'تم إلغاء حظر المستخدم',
  'user_unblocked_message' => 'تم إلغاء حظر المستخدم بنجاح.',
  'user_delete_error_title' => 'خطأ في الحذف',
  'user_delete_error_self_message' => 'لا يمكنك حذف حسابك الخاص.',

  /* Admin Impersonation Responses */
  'impersonation_success_title' => 'تم تسجيل الدخول كمستخدم',
  'impersonation_success_message' => 'تم تسجيل الدخول بنجاح كمستخدم: :name',
  'impersonation_return_title' => 'تم العودة إلى المدير',
  'impersonation_return_message' => 'تم العودة إلى حساب المدير بنجاح.',
  'impersonation_failed_title' => 'فشل العودة',
  'impersonation_failed_message' => 'تعذر العودة إلى حساب المدير.',

  // Static Pages
  'page_created_title' => 'تم الإنشاء',
  'page_created_message' => 'تم إنشاء الصفحة بنجاح',
  'page_updated_title' => 'تم التحديث',
  'page_updated_message' => 'تم تحديث الصفحة بنجاح',
  'page_deleted_title' => 'تم الحذف',
  'page_deleted_message' => 'تم حذف الصفحة بنجاح',
  'pages_published_title' => 'تم النشر',
  'pages_published_message' => 'تم نشر الصفحات المحددة بنجاح',
  'pages_archived_title' => 'تم الأرشفة',
  'pages_archived_message' => 'تم أرشفة الصفحات المحددة بنجاح',
  'pages_deleted_title' => 'تم الحذف',
  'pages_deleted_message' => 'تم حذف الصفحات المحددة بنجاح',

  // Static Page Categories
  'static_page_category_created_title' => 'تم الإنشاء',
  'static_page_category_created_message' => 'تم إنشاء الفئة بنجاح',
  'static_page_category_updated_title' => 'تم التحديث',
  'static_page_category_updated_message' => 'تم تحديث الفئة بنجاح',
  'static_page_category_deleted_title' => 'تم الحذف',
  'static_page_category_deleted_message' => 'تم حذف الفئة بنجاح',
  'static_page_category_delete_failed_title' => 'فشل الحذف',
  'static_page_category_delete_failed_message' => 'لا يمكن حذف الفئة التي تحتوي على صفحات',
  'static_page_categories_deleted_title' => 'تم الحذف',
  'static_page_categories_deleted_message' => 'تم حذف :count فئات بنجاح',
    'static_page_categories_bulk_delete_failed_title' => 'فشل الحذف',
  'static_page_categories_bulk_delete_failed_message' => 'لا يمكن حذف الفئات التي تحتوي على صفحات',

  // FAQ Categories
  'faq_category_created_title' => 'تم الإنشاء',
  'faq_category_created_message' => 'تم إنشاء الفئة بنجاح',
  'faq_category_updated_title' => 'تم التحديث',
  'faq_category_updated_message' => 'تم تحديث الفئة بنجاح',
  'faq_category_deleted_title' => 'تم الحذف',
  'faq_category_deleted_message' => 'تم حذف الفئة بنجاح',
  'faq_category_delete_failed_title' => 'فشل الحذف',
  'faq_category_delete_failed_message' => 'لا يمكن حذف الفئة التي تحتوي على أسئلة شائعة',
  'faq_categories_deleted_title' => 'تم الحذف',
  'faq_categories_deleted_message' => 'تم حذف :count فئات بنجاح',
  'faq_categories_bulk_delete_failed_title' => 'فشل الحذف',
  'faq_categories_bulk_delete_failed_message' => 'لا يمكن حذف الفئات التي تحتوي على أسئلة شائعة',
  'faq_category_name_exists' => 'اسم الفئة موجود بالفعل',

  // Site Settings Responses


  // Site Settings Responses
  'settings_updated_title' => 'تم التحديث',
  'settings_updated_message' => 'تم حفظ إعدادات الموقع بنجاح',

  // FAQ Responses
  'faq_created_title' => 'تم إنشاء السؤال الشائع',
  'faq_created_message' => 'تم إنشاء السؤال الشائع بنجاح.',
  'faq_updated_title' => 'تم تحديث السؤال الشائع',
  'faq_updated_message' => 'تم تحديث السؤال الشائع بنجاح.',
  'faq_deleted_title' => 'تم حذف السؤال الشائع',
  'faq_deleted_message' => 'تم حذف السؤال الشائع بنجاح.',
  'faqs_deleted_title' => 'تم حذف الأسئلة الشائعة',
  'faqs_deleted_message' => 'تم حذف :count أسئلة شائعة بنجاح.',

  // FAQ Toggle Responses
  'faq_toggle_title' => 'تم تحديث السؤال الشائع',
  'faq_toggle_message' => 'تم :status السؤال الشائع في الصفحة الرئيسية.',
  'faqs_bulk_toggle_title' => 'تم تحديث الأسئلة الشائعة',
  'faqs_bulk_toggle_message' => 'تم :status :count أسئلة شائعة في الصفحة الرئيسية.',
  'show' => 'إظهار',
  'hide' => 'إخفاء',

  /* Age Category Responses */
  'age_category_created_title' => 'تم إنشاء فئة العمر',
  'age_category_created_message' => 'تم إنشاء فئة العمر بنجاح.',
  'age_category_updated_title' => 'تم تحديث فئة العمر',
  'age_category_updated_message' => 'تم تحديث فئة العمر بنجاح.',
  'age_category_deleted_title' => 'تم حذف فئة العمر',
  'age_category_deleted_message' => 'تم حذف فئة العمر بنجاح.',
  'age_categories_deleted_title' => 'تم حذف فئات العمر',
  'age_categories_deleted_message' => 'تم حذف :count فئات عمر بنجاح.',
  'age_category_name_exists' => 'اسم فئة العمر موجود بالفعل.',

];
