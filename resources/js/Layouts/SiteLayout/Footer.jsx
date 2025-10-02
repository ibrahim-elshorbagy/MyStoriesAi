import React from 'react';
import { Link } from '@inertiajs/react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import { useTrans } from '@/Hooks/useTrans';

export default function Footer() {
  const { t } = useTrans();

  return (
    <footer className="py-6 border-t border-t-neutral-300 text-center text-sm text-neutral-600 bg-orange-50">
      <div className='mx-4'>
        <div className="flex justify-center mb-3">
          <div className='w-24'>
            <Link href={route("home")} >
              <ApplicationLogo />
            </Link>
          </div>
        </div>
        <p className='text-sm'>{t('MyStoriesAi_description')}</p>
      </div>
    </footer>
  );
}
