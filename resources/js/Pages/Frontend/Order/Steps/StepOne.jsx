import React from 'react';
import TextInput from '@/Components/TextInput';
import TextArea from '@/Components/TextArea';
import SelectInput from '@/Components/SelectInput';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';

export default function StepOne({
  data,
  setData,
  errors,
  pricing,
  imagePreview,
  setImagePreview,
  imageFile,
  setImageFile,
  onNext,
  t
}) {

  const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      setImageFile(file);
      setData('child_image', file);
      const reader = new FileReader();
      reader.onloadend = () => {
        setImagePreview(reader.result);
      };
      reader.readAsDataURL(file);
    }
  };

  const handleLearningValueChange = (valueKey) => {
    const currentValues = data.value || [];
    if (currentValues.includes(valueKey)) {
      setData('value', currentValues.filter(v => v !== valueKey));
    } else {
      setData('value', [...currentValues, valueKey]);
    }
  };

  const handleFormatChange = (format) => {
    let storyPrice = 0;
    let deliveryPrice = 0;

    switch (format) {
      case 'pdf':
        storyPrice = pricing.pdf_price || 0;
        deliveryPrice = 0;
        break;
      case 'soft':
        storyPrice = pricing.softcover_price || 0;
        deliveryPrice = 0;
        break;
      case 'hard':
        storyPrice = pricing.hardcover_price || 0;
        deliveryPrice = 0;
        break;
    }

    setData(prevData => ({
      ...prevData,
      format,
      story_price: storyPrice,
      delivery_price: deliveryPrice,
      total_price: storyPrice + deliveryPrice,
    }));
  };

  const languageOptions = [
    { value: 'arabic', label: t('language_arabic') },
    { value: 'english', label: t('language_english') },
  ];

  const genderOptions = [
    { value: 'boy', label: t('gender_boy') },
    { value: 'girl', label: t('gender_girl') },
  ];

  const formatOptions = [
    { value: 'first_plan', label: t('format_first_plan') },
    { value: 'second_plan', label: t('format_second_plan') },
    { value: 'third_plan', label: t('format_third_plan') },
  ];

  const learningValues = [
    { key: 'honesty', label: t('learning_value_honesty') },
    { key: 'kindness', label: t('learning_value_kindness') },
    { key: 'courage', label: t('learning_value_courage') },
    { key: 'respect', label: t('learning_value_respect') },
    { key: 'responsibility', label: t('learning_value_responsibility') },
    { key: 'friendship', label: t('learning_value_friendship') },
    { key: 'perseverance', label: t('learning_value_perseverance') },
    { key: 'creativity', label: t('learning_value_creativity') },
  ];

  return (
    <div className="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-white/20">
      {/* Child Information */}
      <div className="mb-8">
        <h2 className="text-2xl font-semibold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-6 py-4">
          {t('step_1')}
        </h2>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <InputLabel htmlFor="child_name" value={t('child_name')} required />
            <TextInput
              id="child_name"
              name="child_name"
              value={data.child_name}
              onChange={(e) => setData('child_name', e.target.value)}
              placeholder={t('child_name')}
              required
              className="mt-1 block w-full"
            />
            <InputError message={errors.child_name} className="mt-2" />
          </div>

          <div>
            <InputLabel htmlFor="child_age" value={t('child_age')} required />
            <TextInput
              id="child_age"
              name="child_age"
              type="number"
              value={data.child_age}
              onChange={(e) => setData('child_age', e.target.value)}
              placeholder={t('child_age')}
              required
              className="mt-1 block w-full"
            />
            <InputError message={errors.child_age} className="mt-2" />
          </div>

          <div>
            <SelectInput
              id="language"
              name="language"
              value={data.language}
              onChange={(e) => setData('language', e.target.value)}
              options={languageOptions}
              label={t('language')}
              required
            />
            <InputError message={errors.language} className="mt-2" />
          </div>

          <div>
            <SelectInput
              id="child_gender"
              name="child_gender"
              value={data.child_gender}
              onChange={(e) => setData('child_gender', e.target.value)}
              options={genderOptions}
              label={t('child_gender')}
              required
            />
            <InputError message={errors.child_gender} className="mt-2" />
          </div>

          <div>
            <SelectInput
              id="format"
              name="format"
              value={data.format}
              onChange={(e) => handleFormatChange(e.target.value)}
              options={formatOptions}
              label={t('format')}
              required
            />
            <InputError message={errors.format} className="mt-2" />
          </div>

          <div className="md:col-span-2">
            <label className="block text-sm font-medium text-neutral-700 mb-4">
              {t('learning_value')} *
            </label>
            <div className="space-y-4">
              <div className="bg-gradient-to-r from-blue-50 to-purple-50 p-6 rounded-xl border border-blue-100">
                <p className="text-sm text-neutral-600 mb-4 font-medium">{t('choose_learning_value')}</p>
                <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
                  {learningValues.map((value) => (
                    <label
                      key={value.key}
                      className="group relative cursor-pointer"
                    >
                      <input
                        type="checkbox"
                        checked={(data.value || []).includes(value.key)}
                        onChange={() => handleLearningValueChange(value.key)}
                        className="sr-only peer"
                      />
                      <div className="p-3 rounded-lg border-2 border-neutral-200 bg-white hover:border-orange-300 hover:bg-orange-50 transition-all duration-200 peer-checked:border-orange-500 peer-checked:bg-gradient-to-r peer-checked:from-orange-500 peer-checked:to-pink-500 peer-checked:text-white group-hover:shadow-md">
                        <div className="text-center">
                          <div className="text-sm font-medium">{value.label}</div>
                          <div className="mt-1 opacity-60 peer-checked:opacity-90">
                            <i className="fa-solid fa-heart text-xs"></i>
                          </div>
                        </div>
                      </div>
                    </label>
                  ))}
                </div>
              </div>
              <div className="bg-gradient-to-r from-green-50 to-teal-50 p-4 rounded-lg border border-green-100">
                <TextArea
                  name="custom_value"
                  value={data.custom_value}
                  onChange={(e) => setData('custom_value', e.target.value)}
                  label={t('custom_learning_value')}
                  placeholder={t('custom_learning_value')}
                />
                <InputError message={errors.custom_value} className="mt-2" />
              </div>
            </div>
            <InputError message={errors.value} className="mt-2" />
          </div>

          {/* Child Image */}
          <div className="md:col-span-2">
            <label className="block text-sm font-medium text-neutral-700 mb-2">
              {t('child_image')} *
            </label>
            <div className="border-2 border-dashed border-neutral-300 rounded-lg p-6 text-center">
              {imagePreview ? (
                <div className="space-y-4">
                  <img
                    src={imagePreview}
                    alt="Child preview"
                    className="max-w-full h-48 object-cover rounded-lg mx-auto"
                  />
                  <button
                    type="button"
                    onClick={() => {
                      setImagePreview(null);
                      setImageFile(null);
                    }}
                    className="text-red-600 hover:text-red-800 text-sm"
                  >
                    {t('remove')}
                  </button>
                </div>
              ) : (
                <div>
                  <div className="text-neutral-500 mb-4">
                    <i className="fa-solid fa-cloud-arrow-up text-4xl"></i>
                  </div>
                  <p className="text-neutral-600 mb-2">{t('upload_child_image')}</p>
                  <input
                    type="file"
                    accept="image/*"
                    onChange={handleImageChange}
                    className="hidden"
                    id="child_image"
                  />
                  <label
                    htmlFor="child_image"
                    className="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 cursor-pointer transition-colors"
                  >
                    <i className="fa-solid fa-plus mx-2"></i>
                    {t('choose_file')}
                  </label>
                </div>
              )}
            </div>
            <InputError message={errors.child_image} className="mt-2" />
          </div>
        </div>
      </div>

      {/* Additional Customizations */}
      <div className="mb-8">
        <h3 className="text-xl font-semibold text-neutral-900 mb-4">
          {t('additional_customizations')}
        </h3>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <InputLabel htmlFor="hair_color" value={t('hair_color')} />
            <TextInput
              id="hair_color"
              name="hair_color"
              value={data.hair_color}
              className="mt-1 block w-full"
              onChange={(e) => setData('hair_color', e.target.value)}
              icon="fa-palette"
              placeholder={t('hair_color')}
            />
            <InputError message={errors.hair_color} className="mt-2" />
          </div>

          <div>
            <InputLabel htmlFor="hair_style" value={t('hair_style')} />
            <TextInput
              id="hair_style"
              name="hair_style"
              value={data.hair_style}
              className="mt-1 block w-full"
              onChange={(e) => setData('hair_style', e.target.value)}
              icon="fa-scissors"
              placeholder={t('hair_style')}
            />
            <InputError message={errors.hair_style} className="mt-2" />
          </div>

          <div>
            <InputLabel htmlFor="eye_color" value={t('eye_color')} />
            <TextInput
              id="eye_color"
              name="eye_color"
              value={data.eye_color}
              className="mt-1 block w-full"
              onChange={(e) => setData('eye_color', e.target.value)}
              icon="fa-eye"
              placeholder={t('eye_color')}
            />
            <InputError message={errors.eye_color} className="mt-2" />
          </div>

          <div>
            <InputLabel htmlFor="skin_tone" value={t('skin_tone')} />
            <TextInput
              id="skin_tone"
              name="skin_tone"
              value={data.skin_tone}
              className="mt-1 block w-full"
              onChange={(e) => setData('skin_tone', e.target.value)}
              icon="fa-user"
              placeholder={t('skin_tone')}
            />
            <InputError message={errors.skin_tone} className="mt-2" />
          </div>

          <div className="md:col-span-2">
            <InputLabel htmlFor="clothing_description" value={t('clothing_description')} />
            <TextArea
              id="clothing_description"
              name="clothing_description"
              value={data.clothing_description}
              className="mt-1 block w-full"
              onChange={(e) => setData('clothing_description', e.target.value)}
              placeholder={t('clothing_description')}
              rows={4}
            />
            <InputError message={errors.clothing_description} className="mt-2" />
          </div>
        </div>
      </div>

      {/* Customer Note */}
      <div className="mb-8">
        <TextArea
          name="customer_note"
          value={data.customer_note}
          onChange={(e) => setData('customer_note', e.target.value)}
          label={t('customer_note')}
          placeholder={t('customer_note')}
        />
      </div>

      {/* Next Button */}
      <div className="flex justify-end">
        <button
          type="button"
          onClick={onNext}
          className="px-10 py-4 bg-gradient-to-r from-orange-500 via-pink-500 to-purple-600 text-white font-bold rounded-2xl hover:from-orange-600 hover:via-pink-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
        >
          <span className="flex items-center gap-3 rtl:flex-row-reverse">
            {t('next')}
            <i className="fa-solid fa-arrow-right rtl:fa-arrow-left"></i>
          </span>
        </button>
      </div>
    </div>
  );
}
