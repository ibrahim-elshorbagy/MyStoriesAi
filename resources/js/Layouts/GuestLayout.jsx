import React from 'react';
import { Head, Link, usePage } from '@inertiajs/react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import NavigationToggles from '@/Components/NavigationToggles';
import { useTrans } from '@/Hooks/useTrans';

export default function GuestLayout({ children, title = 'Authentication' }) {
  const { locale } = usePage().props;
  const { t } = useTrans();

  return (
    <div className="min-h-screen relative overflow-hidden" dir={locale === 'ar' ? 'rtl' : 'ltr'}>
      <Head title={title} />

      {/* Enhanced Background with Multiple Gradient Layers */}
      <div className="absolute inset-0 bg-gradient-to-br from-orange-50 via-neutral-50 to-orange-100"></div>
      <div className="absolute inset-0 bg-gradient-to-t from-orange-100/80 via-orange-50/60 to-neutral-50/40"></div>

      {/* Floating Decorative Elements - Matching Home Page Style */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        <div className="absolute top-20 -right-40 w-96 h-96 bg-gradient-to-br from-orange-400/8 to-orange-600/5 rounded-full blur-3xl animate-pulse"></div>
        <div className="absolute -bottom-32 -left-40 w-80 h-80 bg-gradient-to-tr from-orange-500/6 to-orange-300/4 rounded-full blur-3xl"></div>
        <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-r from-orange-200/6 to-orange-400/3 rounded-full blur-2xl"></div>
        <div className="absolute top-10 left-20 w-32 h-32 bg-orange-300/6 rounded-full blur-xl animate-bounce"></div>
        <div className="absolute bottom-20 right-20 w-24 h-24 bg-orange-400/8 rounded-full blur-lg"></div>
      </div>
      {/* Header */}
      <header className="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-orange-200/30 shadow-lg shadow-orange-100/20">
        <div className='py-3 border-b border-b-orange-200/50 bg-gradient-to-r from-orange-50/80 to-neutral-50/80'>
          <div className='container mx-auto'>
            <div className='flex justify-between items-center mx-4'>
              {/* Logo */}
              <Link
                href={route('home')}
                className="w-16 transform hover:scale-105 transition-transform duration-200"
              >
                <ApplicationLogo />
              </Link>

              <div className="hidden md:block">
                <h2 className="text-lg font-bold bg-gradient-to-r from-orange-600 to-orange-700 bg-clip-text text-transparent">
                  {t('welcome')}
                </h2>
              </div>

              {/* Right Side - Navigation Toggles */}
              <div className="flex items-center gap-4">
                <NavigationToggles
                  variant="compact"
                  showLabels={false}
                  className=""
                />
              </div>
            </div>

          </div>
        </div>
      </header>

      {/* Main Content */}
      <main className="flex min-h-screen items-center justify-center pt-20 relative z-10 px-4 sm:px-6 lg:px-8">
        <div className="w-full max-w-lg">
          <div className="bg-white/80 backdrop-blur-sm rounded-2xl border border-neutral-200/50 shadow-2xl shadow-orange-100/20 p-8 transform hover:scale-[1.01] transition-all duration-300">
            {children}
          </div>
        </div>
      </main>


    </div>
  );
}
