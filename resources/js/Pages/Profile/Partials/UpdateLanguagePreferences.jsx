import { usePage } from "@inertiajs/react";
import { useEffect } from "react";
import { useTrans } from "@/Hooks/useTrans";
import SelectInput from "@/Components/SelectInput";

export default function UpdateLanguagePreferences() {
  const { locale } = usePage().props;
  const { t } = useTrans();

  const languages = {
    en: t('english'),
    ar: t('arabic'),
    de: t('german')
  };

  const handleLanguageChange = (e) => {
    const newLocale = e.target.value;

    // Create and submit a form dynamically
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = route("locale.change");

    const page = usePage()

    // Add CSRF token
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = page.props.csrf_token;
    form.appendChild(csrfInput);

    // Add locale input
    const localeInput = document.createElement('input');
    localeInput.type = 'hidden';
    localeInput.name = 'locale';
    localeInput.value = newLocale;
    form.appendChild(localeInput);

    // Submit the form
    document.body.appendChild(form);
    form.submit();
  };

  return (
    <section className="space-y-6">
      <header>
        <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">
          {t("language")}
        </h2>
        <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
          {t("change_language")}
        </p>
      </header>

      <div>
        <div className="mb-4">
          <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            {t("current_language")}:{" "}
            {languages[locale] || locale}
          </label>

          <SelectInput
            name="locale"
            value={locale}
            onChange={handleLanguageChange}
            options={[
              { value: "en", label: t("english") },
              { value: "ar", label: t("arabic") },
              { value: "de", label: t("german") },
            ]}
            icon="fa-language"
            required
          />
        </div>
      </div>
    </section>
  );
}
