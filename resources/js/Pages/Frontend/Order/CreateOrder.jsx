import React, { useState, useEffect } from 'react';
import { useForm, router } from '@inertiajs/react';
import SiteLayout from '@/Layouts/SiteLayout/SiteLayout';
import { Head } from '@inertiajs/react';
import { useTrans } from '@/Hooks/useTrans';
import StepOne from './Steps/StepOne';
import StepTwo from './Steps/StepTwo';
import StepThree from './Steps/StepThree';

export default function CreateOrder({ pricing, deliveryOptions }) {
  const { t } = useTrans();
  const [currentStep, setCurrentStep] = useState(1);
  const [imageFile, setImageFile] = useState(null);
  const [imagePreview, setImagePreview] = useState(null);
  const [clientErrors, setClientErrors] = useState({});

  const { data, setData, post, processing, errors } = useForm({
    // Step 1 - Order Data
    child_name: '',
    child_age: '',
    language: '',
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

    // Step 2 - Address Data
    delivery_option_id: '',
    area: '',
    street: '',
    house_number: '',
    additional_info: '',
  });

  // Handle server errors and navigation
  useEffect(() => {
    if (Object.keys(errors).length > 0) {
      // Determine which step has errors
      const step1Fields = ['child_name', 'child_age', 'language', 'child_gender', 'format', 'value', 'child_image', 'custom_value', 'hair_color', 'hair_style', 'eye_color', 'skin_tone', 'clothing_description', 'customer_note', 'story_price'];
      const step2Fields = ['delivery_option_id', 'area', 'street', 'house_number', 'additional_info', 'delivery_price'];

      const hasStep1Errors = Object.keys(errors).some(key => step1Fields.includes(key));
      const hasStep2Errors = Object.keys(errors).some(key => step2Fields.includes(key));

      if (hasStep1Errors) {
        setCurrentStep(1);
      } else if (hasStep2Errors) {
        setCurrentStep(2);
      }

      // Scroll to first error after re-render
      setTimeout(() => {
        const firstError = document.querySelector('.text-red-600');
        if (firstError) {
          firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      }, 200);
    }
  }, [errors]);

  // Merge server errors and client errors
  const allErrors = { ...errors, ...clientErrors };

  // Client-side validation for step 1
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

    if (!data.value || data.value.length === 0) {
      newErrors.value = t('required');
    }

    if (!imageFile) {
      newErrors.child_image = t('required');
    } else {
      // Validate file type
      const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
      if (!validTypes.includes(imageFile.type)) {
        newErrors.child_image = t('validation_mimes');
      }
      // Validate file size (max 5MB)
      if (imageFile.size > 5120 * 1024) {
        newErrors.child_image = t('validation_max_file');
      }
    }

    setClientErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  // Client-side validation for step 2
  const validateStep2 = () => {
    // PDF format doesn't need address
    if (data.format === 'pdf') {
      setClientErrors({});
      return true;
    }

    const newErrors = {};

    if (!data.delivery_option_id) {
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
      newErrors.street = t('validation_max_string') ;
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
    if (step === 2 && !validateStep1()) {
      // Scroll to first error
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

    // Clear errors when moving to next step
    setClientErrors({});
    setCurrentStep(step);
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    // Final validation
    if (!validateStep1() || !validateStep2()) {
      // Navigate to step with errors
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

    // Prepare data for submission
    const submitData = { ...data };
    submitData.child_image = imageFile;

    // Submit using Inertia form
    post(route('frontend.order.store'), submitData, {
      forceFormData: true,
      preserveScroll: true,
      onError: (errors) => {
        console.log('Validation errors:', errors);
        // Navigation and scrolling handled by useEffect
      },
      onSuccess: () => {
        console.log('Order submitted successfully');
      }
    });
  };

  return (
    <SiteLayout>
      <Head title={t('create_story_title')} />

      <div className="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 py-16">
        <div className="max-w-4xl mx-auto px-6">
          {/* Header */}
          <div className="text-center mb-12">
            <div className="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-orange-400 to-pink-500 rounded-full mb-6 shadow-lg">
              <i className="fa-solid fa-book-open text-3xl text-white"></i>
            </div>
            <h1 className="text-5xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-4 py-4">
              {t('create_story_title')}
            </h1>
            <p className="text-xl text-neutral-600 font-medium">
              {currentStep === 1 && t('step_1')}
              {currentStep === 2 && (data.format === 'pdf' ? t('step_3') : t('step_2'))}
              {currentStep === 3 && t('step_3')}
            </p>

            {/* Progress Indicator */}
            <div className="mt-6 flex justify-center">
              <div className="flex items-center space-x-4 rtl:space-x-reverse">
                <div className={`${currentStep === 1 ? 'w-12 h-2 bg-gradient-to-r from-orange-400 to-pink-500' : 'w-2 h-2 bg-green-500'} rounded-full transition-all duration-300`}></div>
                <div className={`${currentStep === 2 ? 'w-12 h-2 bg-gradient-to-r from-orange-400 to-pink-500' : currentStep > 2 ? 'w-2 h-2 bg-green-500' : 'w-2 h-2 bg-neutral-300'} rounded-full transition-all duration-300`}></div>
                <div className={`${currentStep === 3 ? 'w-12 h-2 bg-gradient-to-r from-orange-400 to-pink-500' : 'w-2 h-2 bg-neutral-300'} rounded-full transition-all duration-300`}></div>
              </div>
            </div>
          </div>

          {/* Form Steps */}
          <form onSubmit={handleSubmit}>
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
                onNext={() => goToStep(data.format === 'pdf' ? 3 : 2)}
                t={t}
              />
            )}

            {currentStep === 2 && data.format !== 'pdf' && (
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
                onBack={() => setCurrentStep(data.format === 'pdf' ? 1 : 2)}
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
