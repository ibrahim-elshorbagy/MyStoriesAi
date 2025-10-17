import { Head } from '@inertiajs/react';
import { useState } from 'react';
import { useTrans } from '@/Hooks/useTrans';
import AppLayout from '@/Layouts/AppLayout';
import ContactSettings from './Partials/ContactSettings';
import PricingSettings from './Partials/PricingSettings';
import CookieSettings from './Partials/CookieSettings';

export default function SiteSettings({ settings = {}, timezones = [] }) {
  const { t } = useTrans();
  const [activeSection, setActiveSection] = useState('contact');

  const handleMenuClick = (section) => {
    setActiveSection(section);
  };

  const menuItems = [
    { id: 'contact', icon: 'fa-solid fa-phone', label: t('contact_info') },
    { id: 'pricing', icon: 'fa-solid fa-dollar-sign', label: t('pricing_settings') },
    { id: 'cookies', icon: 'fa-solid fa-cookie-bite', label: t('cookie_settings') },
  ];

  return (
    <AppLayout>
      <Head title={t('site_settings')} />

      <div className='m-3 xl:m-5'>
        <div className="mb-6">
          <h1 className="text-2xl font-bold text-neutral-900 dark:text-neutral-100">
            {t('site_settings')}
          </h1>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
          {/* Left sidebar with navigation */}
          <div className="lg:col-span-1">
            <div className="bg-neutral-100 dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 overflow-hidden sticky top-4">
              <div className="p-4 border-b border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-950/30">
                <h2 className="font-semibold text-neutral-900 dark:text-neutral-100">
                  {t('settings_menu')}
                </h2>
              </div>
              <div className="p-2 space-y-2">
                {menuItems.map((item) => (
                  <button
                    key={item.id}
                    onClick={() => handleMenuClick(item.id)}
                    className={`flex w-full items-center gap-2 p-2 rounded-lg text-neutral-700 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-800 transition-all ${activeSection === item.id
                      ? 'bg-blue-500/10 text-black dark:text-white font-medium'
                      : ''
                      }`}
                  >
                    <i className={`${item.icon} ${activeSection === item.id ? 'text-blue-500' : ''
                      }`}></i>
                    <span>{item.label}</span>
                  </button>
                ))}
              </div>
            </div>
          </div>

          {/* Main content area */}
          <div className="lg:col-span-2 min-h-[60vh]">
            {activeSection === 'contact' && (
              <ContactSettings settings={settings} />
            )}
            {activeSection === 'pricing' && (
              <PricingSettings settings={settings} />
            )}
            {activeSection === 'cookies' && (
              <CookieSettings settings={settings} />
            )}
          </div>
        </div>
      </div>
    </AppLayout>
  );
}
