import { useForm } from '@inertiajs/react';
import { useTrans } from '@/Hooks/useTrans';
import PrimaryButton from '@/Components/PrimaryButton';
import { Transition } from '@headlessui/react';

export default function PricingSettings({ settings }) {
  const { t } = useTrans();
  const { data, setData, post, processing, errors, recentlySuccessful } = useForm({
    settings: {
      first_plan_price: settings.first_plan_price || '',
      second_plan_price: settings.second_plan_price || '',
      third_plan_price: settings.third_plan_price || '',
    }
  });

  const submit = (e) => {
    e.preventDefault();
    post(route('admin.site-settings.update'), {
      onSuccess: () => {
        // success
      }
    });
  };

  return (
    <div className="bg-neutral-100 dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6">
      <div className="mb-6">
        <h2 className="text-xl font-semibold text-neutral-900 dark:text-neutral-100">
          {t('pricing_settings')}
        </h2>
      </div>

      <form onSubmit={submit} className="space-y-6">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div>
            <label className="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
              {t('first_plan_price')}
            </label>
            <input
              type="number"
              value={data.settings.first_plan_price}
              onChange={(e) => setData('settings', { ...data.settings, first_plan_price: e.target.value })}
              className="w-full px-3 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg bg-neutral-50 dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100"
              placeholder="339"
            />
            {errors['settings.first_plan_price'] && <p className="text-red-500 text-sm mt-1">{errors['settings.first_plan_price']}</p>}
          </div>

          <div>
            <label className="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
              {t('second_plan_price')}
            </label>
            <input
              type="number"
              value={data.settings.second_plan_price}
              onChange={(e) => setData('settings', { ...data.settings, second_plan_price: e.target.value })}
              className="w-full px-3 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg bg-neutral-50 dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100"
              placeholder="439"
            />
            {errors['settings.second_plan_price'] && <p className="text-red-500 text-sm mt-1">{errors['settings.second_plan_price']}</p>}
          </div>

          <div>
            <label className="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
              {t('third_plan_price')}
            </label>
            <input
              type="number"
              value={data.settings.third_plan_price}
              onChange={(e) => setData('settings', { ...data.settings, third_plan_price: e.target.value })}
              className="w-full px-3 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg bg-neutral-50 dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100"
              placeholder="549"
            />
            {errors['settings.third_plan_price'] && <p className="text-red-500 text-sm mt-1">{errors['settings.third_plan_price']}</p>}
          </div>
        </div>

        <div className="pt-4 border-t border-neutral-200 dark:border-neutral-800 flex items-center gap-4">
          <PrimaryButton
            type="submit"
            disabled={processing}
            icon="fa-floppy-disk"
            rounded="rounded-lg"
            withShadow={false}
          >
            {t('save_changes')}
          </PrimaryButton>

          <Transition
            show={recentlySuccessful}
            enter="transition ease-in-out"
            enterFrom="opacity-0"
            leave="transition ease-in-out"
            leaveTo="opacity-0"
          >
            <p className="text-sm text-orange-600 dark:text-orange-400 flex items-center gap-1">
              <i className="fa-solid fa-check"></i> {t('saved_successfully')}
            </p>
          </Transition>
        </div>
      </form>
    </div>
  );
}
