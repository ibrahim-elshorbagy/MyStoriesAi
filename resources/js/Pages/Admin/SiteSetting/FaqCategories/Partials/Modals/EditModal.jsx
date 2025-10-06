import React, { useEffect } from 'react';
import { useForm } from '@inertiajs/react';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';
import { useTrans } from '@/Hooks/useTrans';
import AppModal from '@/Components/AppModal';

export default function EditModal({ isOpen, onClose, category }) {
  const { t } = useTrans();
  const { data, setData, post, errors, reset, processing } = useForm({
    name_ar: '',
    name_en: '',
    _method: 'PUT',
  });

  useEffect(() => {
    if (category && isOpen) {
      setData({
        name_ar: category.name?.ar || '',
        name_en: category.name?.en || '',
        _method: 'PUT',
      });
    } else if (!isOpen) {
      reset();
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [category, isOpen]);

  if (!category) return null;

  const handleSubmit = (e) => {
    e.preventDefault();

    post(route('admin.faq-categories.update', category.id), {
      onSuccess: () => {
        reset();
        onClose();
      },
    });
  };

  return (
    <AppModal
      isOpen={isOpen}
      onClose={onClose}
      title={t('edit_category')}
      icon="fa-pen-to-square"
      size="md"
    >
      <form onSubmit={handleSubmit}>
        <div className="mb-4">
          <InputLabel htmlFor="name_ar" value={t('category_name_ar')} required />
          <TextInput
            id="name_ar"
            name="name_ar"
            value={data.name_ar}
            className="mt-1 block w-full"
            onChange={(e) => setData('name_ar', e.target.value)}
            required
            icon="fa-folder"
            placeholder={t('enter_arabic_name')}
          />
          <InputError message={errors.name_ar} className="mt-2" />
        </div>

        <div className="mb-4">
          <InputLabel htmlFor="name_en" value={t('category_name_en')} required />
          <TextInput
            id="name_en"
            name="name_en"
            value={data.name_en}
            className="mt-1 block w-full"
            onChange={(e) => setData('name_en', e.target.value)}
            required
            icon="fa-folder"
            placeholder={t('enter_english_name')}
          />
          <InputError message={errors.name_en} className="mt-2" />
        </div>

        <div className="flex justify-end gap-2 mt-6">
          <SecondaryButton
            type="button"
            onClick={onClose}
            icon="fa-xmark"
            rounded="rounded-lg"
            disabled={processing}
          >
            {t('cancel')}
          </SecondaryButton>
          <PrimaryButton
            type="submit"
            icon="fa-floppy-disk"
            rounded="rounded-lg"
            withShadow={false}
            disabled={processing}
          >
            {processing ? t('updating') : t('save_changes')}
          </PrimaryButton>
        </div>
      </form>
    </AppModal>
  );
}
