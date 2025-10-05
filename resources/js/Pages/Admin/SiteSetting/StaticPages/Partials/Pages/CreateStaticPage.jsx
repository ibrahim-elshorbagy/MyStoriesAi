import React, { useState, useEffect, useRef } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import { useTrans } from '@/Hooks/useTrans';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import SelectInput from '@/Components/SelectInput';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function CreateStaticPage() {
  const { t } = useTrans();
  const { data, setData, post, errors, processing } = useForm({
    title_ar: '',
    title_en: '',
    content_ar: '',
    content_en: '',
    status: 'draft',
  });

  const editorArRef = useRef(null);
  const editorEnRef = useRef(null);

  useEffect(() => {
    // Load CKEditor
    const script = document.createElement('script');
    script.src = 'https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js';
    script.async = true;
    script.onload = () => initializeCKEditor();
    document.body.appendChild(script);

    return () => {
      if (editorArRef.current) {
        editorArRef.current.destroy();
      }
      if (editorEnRef.current) {
        editorEnRef.current.destroy();
      }
    };
  }, []);

  const initializeCKEditor = () => {
    if (!window.ClassicEditor) return;

    const commonConfig = {
      height: 600,
      toolbar: [
        'undo', 'redo', '|',
        'heading', '|',
        'bold', 'italic', '|',
        'link', 'bulletedList', 'numberedList', '|',
        'alignment:left', 'alignment:center', 'alignment:right', 'alignment:justify', '|',
        'indent', 'outdent', '|',
        'blockQuote', 'insertTable', 'mediaEmbed', 'imageUpload', '|',
        'removeFormat', 'horizontalLine', 'pageBreak', 'specialCharacters'
      ],
      language: 'en',
    };

    // Arabic editor
    const arConfig = { ...commonConfig, language: 'ar' };
    ClassicEditor.create(document.querySelector('#content_ar'), arConfig)
      .then(editor => {
        editorArRef.current = editor;
        editor.model.document.on('change:data', () => {
          setData('content_ar', editor.getData());
        });
      })
      .catch(error => console.error(error));

    // English editor
    const enConfig = { ...commonConfig, language: 'en' };
    ClassicEditor.create(document.querySelector('#content_en'), enConfig)
      .then(editor => {
        editorEnRef.current = editor;
        editor.model.document.on('change:data', () => {
          setData('content_en', editor.getData());
        });
      })
      .catch(error => console.error(error));
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    // Update content from editors before submit
    if (editorArRef.current) {
      setData('content_ar', editorArRef.current.getData());
    }
    if (editorEnRef.current) {
      setData('content_en', editorEnRef.current.getData());
    }

    post(route('admin.static-pages.store'));
  };

  const statusOptions = [
    { value: 'draft', label: t('draft') },
    { value: 'published', label: t('published') },
    { value: 'archived', label: t('archived') }
  ];

  return (
    <AppLayout>
      <Head title={t('create_static_page')} />
      <div className="m-3 xl:m-5">
        <div className="overflow-hidden rounded-2xl shadow-lg dark:bg-neutral-900 border border-neutral-300 dark:border-neutral-700">
          <div className="p-6 text-neutral-900 dark:text-neutral-100">
            {/* Header */}
            <div className="flex items-center justify-between mb-6">
              <div className="flex items-center gap-3">
                <Link
                  href={route('admin.static-pages.index')}
                  className="flex items-center text-neutral-600 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-neutral-100 transition-colors"
                >
                  <i className="fa-solid fa-arrow-left rtl:rotate-180 mx-2"></i>
                  {t('static_pages')}
                </Link>
                <span className="text-neutral-400 dark:text-neutral-600">/</span>
                <h1 className="text-2xl font-bold leading-tight text-neutral-900 dark:text-neutral-100">
                  <i className="fa-solid fa-plus text-green-500 mx-2"></i>
                  {t('create_page')}
                </h1>
              </div>
            </div>

            {/* Form */}
            <form onSubmit={handleSubmit} className="space-y-6">
              {/* Basic Info */}
              <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {/* Arabic Title */}
                <div>
                  <InputLabel htmlFor="title_ar" value={t('title_ar')} required />
                  <TextInput
                    id="title_ar"
                    type="text"
                    name="title_ar"
                    value={data.title_ar}
                    className="mt-1 block w-full"
                    onChange={(e) => setData('title_ar', e.target.value)}
                    required
                  />
                  <InputError message={errors.title_ar} className="mt-2" />
                </div>

                {/* English Title */}
                <div>
                  <InputLabel htmlFor="title_en" value={t('title_en')} required />
                  <TextInput
                    id="title_en"
                    type="text"
                    name="title_en"
                    value={data.title_en}
                    className="mt-1 block w-full"
                    onChange={(e) => setData('title_en', e.target.value)}
                    required
                  />
                  <InputError message={errors.title_en} className="mt-2" />
                </div>

                {/* Status */}
                <div>
                  <SelectInput
                    name="status"
                    label={t('status')}
                    value={data.status}
                    onChange={(e) => setData('status', e.target.value)}
                    options={statusOptions}
                    icon="fa-circle-check"
                    required
                  />
                  <InputError message={errors.status} className="mt-2" />
                </div>
              </div>

              {/* Content Editors */}
              <div className="space-y-6">
                {/* Arabic Content */}
                <div>
                  <InputLabel htmlFor="content_ar" value={t('content_ar')} required />
                  <div className='no-tailwindcss-support-display'>
                    <textarea
                      id="content_ar"
                      name="content_ar"
                      className="mt-1 block w-full"
                    ></textarea>
                  </div>
                  <InputError message={errors.content_ar} className="mt-2" />
                </div>

                {/* English Content */}
                <div className=''>
                  <InputLabel htmlFor="content_en" value={t('content_en')} required />
                  <div className='no-tailwindcss-support-display'>
                    <textarea
                      id="content_en"
                      name="content_en"
                      className="mt-1 block w-full "
                    ></textarea>
                  </div>
                  <InputError message={errors.content_en} className="mt-2" />
                </div>
              </div>

              {/* Action Buttons */}
              <div className="flex items-center justify-end gap-4 pt-6 border-t border-neutral-200 dark:border-neutral-700">
                <SecondaryButton icon={'fa-times'} as={Link} href={route('admin.static-pages.index')}>
                  {t('cancel')}
                </SecondaryButton>
                <PrimaryButton icon={"fa-save"} type="submit" disabled={processing}>
                  {processing ? t('creating') : t('create_page')}
                </PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>
    </AppLayout>
  );
}
