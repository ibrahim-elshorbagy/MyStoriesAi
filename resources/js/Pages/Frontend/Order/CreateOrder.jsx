import React, { useState, useEffect } from 'react';
import { useForm, router } from '@inertiajs/react';
import SiteLayout from '@/Layouts/SiteLayout/SiteLayout';
import { Head } from '@inertiajs/react';
import { useTrans } from '@/Hooks/useTrans';
import StepZero from './Steps/StepZero';
import StepOne from './Steps/StepOne';
import StepTwo from './Steps/StepTwo';
import StepThree from './Steps/StepThree';

export default function CreateOrder({ pricing, deliveryOptions, story = null }) {
  const { t } = useTrans();
  const [currentStep, setCurrentStep] = useState(story ? 0 : 1);
  const [imageFile, setImageFile] = useState(null);
  const [imagePreview, setImagePreview] = useState(null);
  const [clientErrors, setClientErrors] = useState({});
  const [cameFromStepZero, setCameFromStepZero] = useState(story ? true : false);

  const { data, setData, post, processing, errors } = useForm({
    story_id: story?.id || null,
    face_swap_result: null,
    child_name: '',
    child_age: '',
    language: story ? 'arabic' : '',
    child_gender: '',
    format: '',
    value: [],
    custom_value: '',
    hair_color: '',
    hair_style: '',
    eye_color: '',
    skin_tone: '',
    clothing_description: '',
    customer_note: '',
    child_image: null,
    story_price: 0,
    delivery_price: 0,
    total_price: 0,
    delivery_option_id: '',
    area: '',
    street: '',
    house_number: '',
    additional_info: '',
  });

  useEffect(() => {
    if (Object.keys(errors).length > 0) {
      const step0Fields = ['story_id', 'face_swap_result', 'child_image'];
      const step1Fields = ['child_name', 'child_age', 'language', 'child_gender', 'format', 'value', 'custom_value', 'hair_color', 'hair_style', 'eye_color', 'skin_tone', 'clothing_description', 'customer_note', 'story_price'];
      const step2Fields = ['delivery_option_id', 'area', 'street', 'house_number', 'additional_info', 'delivery_price'];

      const hasStep0Errors = Object.keys(errors).some(key => step0Fields.includes(key));
      const hasStep1Errors = Object.keys(errors).some(key => step1Fields.includes(key));
      const hasStep2Errors = Object.keys(errors).some(key => step2Fields.includes(key));

      if (hasStep0Errors && story) {
        setCurrentStep(0);
      } else if (hasStep1Errors) {
        setCurrentStep(1);
      } else if (hasStep2Errors) {
        setCurrentStep(2);
      }

      setTimeout(() => {
        const firstError = document.querySelector('.text-red-600');
        if (firstError) {
          firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      }, 200);
    }
  }, [errors]);

  const allErrors = { ...errors, ...clientErrors };

  const validateStep1 = () => {
    const newErrors = {};

    if (!data.child_name || data.child_name.trim() === '') {
      newErrors.child_name = t('required') || 'The child name field is required.';
    } else if (data.child_name.length > 255) {
      newErrors.child_name = t('validation_max_string');
    }

    if (!data.child_age || data.child_age === '') {
      newErrors.child_age = t('required');
    }

    if (!data.language) {
      newErrors.language = t('required');
    }

    if (!data.child_gender) {
      newErrors.child_gender = t('required');
    }

    if (!data.format) {
      newErrors.format = t('required');
    }

    // Only validate learning values if NOT coming from step 0 (not customizing a story)
    if (!cameFromStepZero && (!data.value || data.value.length === 0)) {
      newErrors.value = t('required');
    }

    // Only validate image if NOT coming from step 0
    if (!imageFile && !cameFromStepZero) {
      newErrors.child_image = t('required');
    } else if (imageFile) {
      const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
      if (!validTypes.includes(imageFile.type)) {
        newErrors.child_image = t('validation_mimes');
      }
      if (imageFile.size > 5120 * 1024) {
        newErrors.child_image = t('validation_max_file');
      }
    }

    setClientErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const validateStep2 = () => {
    if (data.format === 'first_plan') {
      setClientErrors({});
      return true;
    }

    const newErrors = {};

    if (!data.delivery_option_id || data.delivery_option_id === 'custom') {
      newErrors.delivery_option_id = t('required');
    }

    if (!data.area || data.area.trim() === '') {
      newErrors.area = t('required');
    } else if (data.area.length > 255) {
      newErrors.area = t('validation_max_string');
    }

    if (!data.street || data.street.trim() === '') {
      newErrors.street = t('required');
    } else if (data.street.length > 255) {
      newErrors.street = t('validation_max_string');
    }

    if (!data.house_number || data.house_number.trim() === '') {
      newErrors.house_number = t('required');
    } else if (data.house_number.length > 255) {
      newErrors.house_number = t('validation_max_string');
    }

    setClientErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const goToStep = (step) => {
    if (step === 1 && currentStep === 0) {
      setClientErrors({});
      setCameFromStepZero(true);
      setCurrentStep(step);
      return;
    }

    if (step === 2 && !validateStep1()) {
      setTimeout(() => {
        const firstError = document.querySelector('.text-red-600');
        if (firstError) {
          firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      }, 100);
      return;
    }

    if (step === 3) {
      if (!validateStep1()) {
        setCurrentStep(1);
        setTimeout(() => {
          const firstError = document.querySelector('.text-red-600');
          if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        }, 100);
        return;
      }
      if (!validateStep2()) {
        setCurrentStep(2);
        setTimeout(() => {
          const firstError = document.querySelector('.text-red-600');
          if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        }, 100);
        return;
      }
    }

    setClientErrors({});
    setCurrentStep(step);
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    if (!validateStep1() || !validateStep2()) {
      if (Object.keys(clientErrors).some(key =>
        ['child_name', 'child_age', 'language', 'child_gender', 'format', 'value', 'child_image'].includes(key)
      )) {
        setCurrentStep(1);
      } else {
        setCurrentStep(2);
      }

      setTimeout(() => {
        const firstError = document.querySelector('.text-red-600');
        if (firstError) {
          firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      }, 100);
      return;
    }

    const submitData = { ...data };
    submitData.child_image = imageFile;

    post(route('frontend.order.store'), submitData, {
      forceFormData: true,
      preserveScroll: true,
      onError: (errors) => {
        console.log('Validation errors:', errors);
      },
      onSuccess: () => {
        console.log('Order submitted successfully');
      }
    });
  };

  const getStepTitle = () => {
    if (currentStep === 0) return t('customize_story') || 'تخصيص القصة';
    if (currentStep === 1) return t('step_1') || 'الخطوة 1';
    if (currentStep === 2) return data.format === 'first_plan' ? t('step_3') || 'الخطوة 3' : t('step_2') || 'الخطوة 2';
    if (currentStep === 3) return t('step_3') || 'الخطوة 3';
  };

  return (
    <SiteLayout>
      <Head title={t('create_story_title') || 'إنشاء قصة'} />

      <div className="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 py-16">
        <div className="max-w-4xl mx-auto px-6">
          <div className="text-center mb-12">
            <div className="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-orange-400 to-pink-500 rounded-full mb-6 shadow-lg">
              <i className="fa-solid fa-book-open text-3xl text-white"></i>
            </div>
            <h1 className="text-5xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-4 py-4">
              {t('create_story_title') || 'إنشاء قصة مخصصة'}
            </h1>
            <p className="text-xl text-neutral-600 font-medium">
              {getStepTitle()}
            </p>

            {/* Progress Indicator */}
            <div className="mt-6 flex justify-center">
              <div className="flex items-center space-x-4 rtl:space-x-reverse">
                {story && (
                  <div className={`${currentStep === 0 ? 'w-12 h-2 bg-gradient-to-r from-orange-400 to-pink-500' : currentStep > 0 ? 'w-2 h-2 bg-green-500' : 'w-2 h-2 bg-neutral-300'} rounded-full transition-all duration-300`}></div>
                )}
                <div className={`${currentStep === 1 ? 'w-12 h-2 bg-gradient-to-r from-orange-400 to-pink-500' : currentStep > 1 ? 'w-2 h-2 bg-green-500' : 'w-2 h-2 bg-neutral-300'} rounded-full transition-all duration-300`}></div>
                <div className={`${currentStep === 2 ? 'w-12 h-2 bg-gradient-to-r from-orange-400 to-pink-500' : currentStep > 2 ? 'w-2 h-2 bg-green-500' : 'w-2 h-2 bg-neutral-300'} rounded-full transition-all duration-300`}></div>
                <div className={`${currentStep === 3 ? 'w-12 h-2 bg-gradient-to-r from-orange-400 to-pink-500' : 'w-2 h-2 bg-neutral-300'} rounded-full transition-all duration-300`}></div>
              </div>
            </div>
          </div>

          <form onSubmit={handleSubmit}>
            {currentStep === 0 && story && (
              <StepZero
                story={story}
                data={data}
                setData={setData}
                errors={allErrors}
                imageFile={imageFile}
                setImageFile={setImageFile}
                imagePreview={imagePreview}
                setImagePreview={setImagePreview}
                onNext={() => goToStep(1)}
                t={t}
              />
            )}

            {currentStep === 1 && (
              <StepOne
                data={data}
                setData={setData}
                errors={allErrors}
                pricing={pricing}
                imagePreview={imagePreview}
                setImagePreview={setImagePreview}
                imageFile={imageFile}
                setImageFile={setImageFile}
                onNext={() => goToStep(data.format === 'first_plan' ? 3 : 2)}
                onBack={cameFromStepZero ? () => setCurrentStep(0) : null}
                cameFromStepZero={cameFromStepZero}
                t={t}
              />
            )}

            {currentStep === 2 && data.format !== 'first_plan' && (
              <StepTwo
                data={data}
                setData={setData}
                errors={allErrors}
                deliveryOptions={deliveryOptions}
                onNext={() => goToStep(3)}
                onBack={() => setCurrentStep(1)}
                t={t}
              />
            )}

            {currentStep === 3 && (
              <StepThree
                data={data}
                imagePreview={imagePreview}
                onBack={() => setCurrentStep(data.format === 'first_plan' ? 1 : 2)}
                onEdit={(step) => setCurrentStep(step)}
                processing={processing}
                errors={allErrors}
                t={t}
              />
            )}
          </form>
        </div>
      </div>
    </SiteLayout>
  );
}
