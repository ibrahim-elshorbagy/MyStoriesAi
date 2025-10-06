<?php

return [
  /*
  |--------------------------------------------------------------------------
  | All Website Controllers Responses Lines
  |--------------------------------------------------------------------------
  |
  |
  */

  'language_changed_title' => 'Language Changed',
  'language_changed_message' => 'Language updated successfully.',
  "blocked_account" => "Your account has been blocked. Please contact administrator",

  /* Auth Controller Responses */
  'login_successful_title' => 'Login Successful',
  'login_successful_message' => 'Welcome back! You have been logged in successfully.',
  'logout_successful_title' => 'Logged Out',
  'logout_successful_message' => 'You have been logged out successfully.',
  'registration_successful_title' => 'Registration Successful',
  'registration_successful_message' => 'Your account has been created successfully. Welcome!',
  'password_reset_link_sent_title' => 'Password Reset Link Sent',
  'password_reset_link_sent_message' => 'A password reset link has been sent to your email address.',
  'password_reset_successful_title' => 'Password Reset Successful',
  'password_reset_successful_message' => 'Your password has been reset successfully. You can now log in.',
  'verification_link_sent_title' => 'Verification Link Sent',
  'verification_link_sent_message' => 'A new verification link has been sent to your email address.',
  'password_confirmed_title' => 'Password Confirmed',
  'password_confirmed_message' => 'Your password has been confirmed successfully.',

  /* Auth Validation Messages */
  'username_required' => 'The username field is required.',
  'password_required' => 'The password field is required.',
  'name_required' => 'The name field is required.',
  'username_unique' => 'This username is already taken.',
  'email_required' => 'The email field is required.',
  'email_invalid' => 'Please enter a valid email address.',
  'email_unique' => 'This email is already registered.',
  'password_confirmation' => 'The password confirmation does not match.',
  'phone_invalid' => 'Please enter a valid phone number (e.g., +1234567890).',
  /* End Auth Validation Messages */

  /* End Auth Controller Responses */

  /* Profile Controller Responses */
  'profile_updated_title' => 'Profile Updated',
  'profile_updated_message' => 'Your profile information has been updated successfully.',
  'account_deleted_title' => 'Account Deleted',
  'account_deleted_message' => 'Your account has been permanently deleted.',
  'password_updated_title' => 'Password Updated',
  'password_updated_message' => 'Your password has been updated successfully.',
  'profile_image_updated_title' => 'Profile Image Updated',
  'profile_image_updated_message' => 'Your profile image has been updated successfully.',


  /* User Management Responses */
  'user_created_title' => 'User Created',
  'user_created_message' => 'User has been created successfully.',
  'user_updated_title' => 'User Updated',
  'user_updated_message' => 'User has been updated successfully.',
  'user_deleted_title' => 'User Deleted',
  'user_deleted_message' => 'User has been deleted successfully.',
  'users_deleted_title' => 'Users Deleted',
  'users_deleted_message' => ':count users have been deleted successfully.',
  'user_blocked_title' => 'User Blocked',
  'user_blocked_message' => 'User has been blocked successfully.',
  'user_unblocked_title' => 'User Unblocked',
  'user_unblocked_message' => 'User has been unblocked successfully.',
  'user_delete_error_title' => 'Delete Error',
  'user_delete_error_self_message' => 'You cannot delete your own account.',


  /* Admin Impersonation Responses */
  'impersonation_success_title' => 'Logged in as user',
  'impersonation_success_message' => 'Successfully logged in as user: :name',
  'impersonation_return_title' => 'Returned to admin',
  'impersonation_return_message' => 'Successfully returned to the admin account.',
  'impersonation_failed_title' => 'Return failed',
  'impersonation_failed_message' => 'Could not return to the admin account.',

  // Static Pages
  'page_created_title' => 'Created',
  'page_created_message' => 'Page created successfully',
  'page_updated_title' => 'Updated',
  'page_updated_message' => 'Page updated successfully',
  'page_deleted_title' => 'Deleted',
  'page_deleted_message' => 'Page deleted successfully',
  'pages_published_title' => 'Published',
  'pages_published_message' => 'Selected pages published successfully',
  'pages_archived_title' => 'Archived',
  'pages_archived_message' => 'Selected pages archived successfully',
  'pages_deleted_title' => 'Deleted',
  'pages_deleted_message' => 'Selected pages deleted successfully',

  // Static Page Categories
  'static_page_category_created_title' => 'Created',
  'static_page_category_created_message' => 'Category created successfully',
  'static_page_category_updated_title' => 'Updated',
  'static_page_category_updated_message' => 'Category updated successfully',
  'static_page_category_deleted_title' => 'Deleted',
  'static_page_category_deleted_message' => 'Category deleted successfully',
  'static_page_category_delete_failed_title' => 'Delete Failed',
  'static_page_category_delete_failed_message' => 'Cannot delete category that contains pages',
  'static_page_categories_deleted_title' => 'Deleted',
  'static_page_categories_deleted_message' => ':count categories deleted successfully',
  'static_page_categories_bulk_delete_failed_title' => 'Delete Failed',
  'static_page_categories_bulk_delete_failed_message' => 'Cannot delete categories that contain pages',

  // FAQ Categories
  'faq_category_created_title' => 'Created',
  'faq_category_created_message' => 'Category created successfully',
  'faq_category_updated_title' => 'Updated',
  'faq_category_updated_message' => 'Category updated successfully',
  'faq_category_deleted_title' => 'Deleted',
  'faq_category_deleted_message' => 'Category deleted successfully',
  'faq_category_delete_failed_title' => 'Delete Failed',
  'faq_category_delete_failed_message' => 'Cannot delete category that contains FAQs',
  'faq_categories_deleted_title' => 'Deleted',
  'faq_categories_deleted_message' => ':count categories deleted successfully',
  'faq_categories_bulk_delete_failed_title' => 'Delete Failed',
  'faq_categories_bulk_delete_failed_message' => 'Cannot delete categories that contain FAQs',
  'faq_category_name_exists' => 'Category name already exists',

  // Site Settings Responses
  'settings_updated_title' => 'Updated',
  'settings_updated_message' => 'Site settings have been saved successfully',

  // FAQ Responses
  'faq_created_title' => 'FAQ Created',
  'faq_created_message' => 'FAQ has been created successfully.',
  'faq_updated_title' => 'FAQ Updated',
  'faq_updated_message' => 'FAQ has been updated successfully.',
  'faq_deleted_title' => 'FAQ Deleted',
  'faq_deleted_message' => 'FAQ has been deleted successfully.',
  'faqs_deleted_title' => 'FAQs Deleted',
  'faqs_deleted_message' => ':count FAQs deleted successfully.',

  // FAQ Toggle Responses
  'faq_toggle_title' => 'FAQ Updated',
  'faq_toggle_message' => 'FAQ has been :status on home page.',
  'faqs_bulk_toggle_title' => 'FAQs Updated',
  'faqs_bulk_toggle_message' => ':count FAQs have been :status on home page.',
  'show' => 'shown',
  'hide' => 'hidden',

];
