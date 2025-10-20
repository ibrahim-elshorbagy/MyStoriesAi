import React from 'react';
import TextInput from '@/Components/TextInput';
import TextArea from '@/Components/TextArea';
import SelectInput from '@/Components/SelectInput';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';

export default function StepTwo({
  data,
  setData,
  errors,
  deliveryOptions,
  onNext,
  onBack,
  t
}) {

  const handleDeliveryOptionChange = (optionId) => {
    const selectedOption = deliveryOptions.find(opt => opt.id == optionId);
    const deliveryPrice = selectedOption ? selectedOption.price : 0;

    setData(prevData => ({
      ...prevData,
      delivery_option_id: optionId,
      delivery_price: deliveryPrice,
      total_price: parseFloat(prevData.story_price) + parseFloat(deliveryPrice),
    }));
  };

  const deliveryOptionChoices = deliveryOptions.map(option => ({
    value: option.id,
    label: `${option.city_value} - ${option.price} ${t('currency')}`,
  }));

  const selectedOption = deliveryOptions.find(opt => opt.id == data.delivery_option_id);

  return (
    <div className="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-white/20">
      <div className="space-y-6">
        <h2 className="text-2xl font-semibold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-6 py-4">
          {t('shipping_address')}
        </h2>

        <div>
          <SelectInput
            name="delivery_option_id"
            value={data.delivery_option_id}
            onChange={(e) => handleDeliveryOptionChange(e.target.value)}
            options={deliveryOptionChoices}
            label={t('select_delivery_option')}
            required
          />
          <InputError message={errors.delivery_option_id} className="mt-2" />
        </div>

        <div>
          <InputLabel htmlFor="area" value={t('area')} required />
          <TextInput
            id="area"
            name="area"
            value={data.area}
            onChange={(e) => setData('area', e.target.value)}
            placeholder={t('area')}
            required
            className="mt-1 block w-full"
          />
          <InputError message={errors.area} className="mt-2" />
        </div>

        <div>
          <InputLabel htmlFor="street" value={t('street')} required />
          <TextInput
            id="street"
            name="street"
            value={data.street}
            onChange={(e) => setData('street', e.target.value)}
            placeholder={t('street')}
            required
            className="mt-1 block w-full"
          />
          <InputError message={errors.street} className="mt-2" />
        </div>

        <div>
          <InputLabel htmlFor="house_number" value={t('house_number')} required />
          <TextInput
            id="house_number"
            name="house_number"
            value={data.house_number}
            onChange={(e) => setData('house_number', e.target.value)}
            placeholder={t('house_number')}
            required
            className="mt-1 block w-full"
          />
          <InputError message={errors.house_number} className="mt-2" />
        </div>

        <div>
          <InputLabel htmlFor="additional_info" value={t('additional_info')} />
          <TextArea
            id="additional_info"
            name="additional_info"
            value={data.additional_info}
            onChange={(e) => setData('additional_info', e.target.value)}
            placeholder={t('additional_info')}
            rows={3}
            className="mt-1 block w-full"
          />
          <InputError message={errors.additional_info} className="mt-2" />
        </div>

        {/* Order Summary */}
        <div className="bg-gradient-to-r from-orange-50 to-pink-50 rounded-xl p-6 border border-orange-100">
          <h3 className="text-lg font-semibold text-neutral-900 mb-4">
            {t('order_summary')}
          </h3>
          <div className="space-y-2">
            <div className="flex justify-between">
              <span className="text-neutral-600">{t('story_price')}:</span>
              <span className="font-semibold">{data.story_price} {t('currency')}</span>
            </div>
            <div className="flex justify-between">
              <span className="text-neutral-600">{t('delivery_price')}:</span>
              <span className="font-semibold">
                {selectedOption ? selectedOption.price : data.delivery_price} {t('currency')}
              </span>
            </div>
            <div className="border-t pt-2 flex justify-between">
              <span className="text-lg font-semibold">{t('total_price')}:</span>
              <span className="text-lg font-bold text-orange-600">
                {data.total_price} {t('currency')}
              </span>
            </div>
          </div>
        </div>

        {/* Navigation */}
        <div className="flex justify-between pt-6 rtl:flex-row-reverse">
          <button
            type="button"
            onClick={onBack}
            className="px-6 py-3 border-2 border-neutral-300 text-neutral-700 font-semibold rounded-lg hover:bg-neutral-50 transition-colors flex items-center rtl:flex-row-reverse"
          >
            <i className="fa-solid fa-arrow-left rtl:fa-arrow-right mx-2"></i>
            {t('back')}
          </button>

          <button
            type="button"
            onClick={onNext}
            className="px-10 py-4 bg-gradient-to-r from-orange-500 via-pink-500 to-purple-600 text-white font-bold rounded-2xl hover:from-orange-600 hover:via-pink-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl"
          >
            <span className="flex items-center gap-3 rtl:flex-row-reverse">
              {t('next')}
              <i className="fa-solid fa-arrow-right rtl:fa-arrow-left"></i>
            </span>
          </button>
        </div>
      </div>
    </div>
  );
}
