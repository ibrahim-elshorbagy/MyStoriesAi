import React from 'react';
import { usePage } from '@inertiajs/react';
import { useTrans } from '@/Hooks/useTrans';

export default function NavigationToggles({
  className = '',
  variant = 'default', // 'default', 'compact', 'mobile'
  showLabels = true
}) {
  const { t } = useTrans();
  const { locale } = usePage().props;

  const getLanguageText = () => {
    return locale === 'en' ? t('arabic') : t('english');
  };

  // Base button classes
  const baseButtonClasses = " flex items-center gap-2 text-neutral-700 hover:text-neutral-900  transition-colors duration-200 ";

  // Variant-specific classes
  const variantClasses = {
    default: " px-3 py-2 rounded-lg ",
    compact: " px-2 py-1 rounded-md ",
    mobile: "  px-5 py-3 text-left  "
  };

  // Container classes based on variant
  const containerClasses = {
    default: "flex items-center gap-3",
    compact: "flex items-center gap-2",
    mobile: "flex justify-around  border-b border-neutral-200 "
  };

  const buttonClass = `${baseButtonClasses} ${variantClasses[variant]}`;
  const containerClass = `${containerClasses[variant]} ${className}`;

  return (
    <div className={containerClass}>
      {/* Language Toggle Form */}
      <form
        action={route('locale.change')}
        method="POST"
        style={{ display: 'inline' }}
      >
        <input
          type="hidden"
          name="_token"
          value={document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
        />
        <input
          type="hidden"
          name="locale"
          value={locale === 'en' ? 'ar' : 'en'}
        />
        <button
          type="submit"
          className={buttonClass}
          aria-label={`Toggle to ${locale === 'en' ? 'Arabic' : 'English'} language`}
          title={`Switch to ${locale === 'en' ? 'Arabic' : 'English'}`}
        >
          <i className="fa-solid fa-language"></i>
          {showLabels && <span className="text-sm">{getLanguageText()}</span>}
        </button>
      </form>
    </div>
  );
}
