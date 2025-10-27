import React, { useState } from 'react';
import SiteLayout from '@/Layouts/SiteLayout/SiteLayout';
import { Head } from '@inertiajs/react';
import { useTrans } from '@/Hooks/useTrans';

export default function PaymentMethod({ order }) {
  const { t } = useTrans();
  const [paymentMethod, setPaymentMethod] = useState('cod');

  return (
    <SiteLayout>
      <Head title={t('payment_method')} />

      <div className="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 py-16">
        <div className="max-w-3xl mx-auto px-6">
          {/* Header */}
          <div className="text-center mb-12">
            <div className="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-orange-400 to-pink-500 rounded-full mb-6 shadow-lg">
              <i className="fa-solid fa-credit-card text-3xl text-white"></i>
            </div>
            <h1 className="text-5xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-4 py-4">
              {t('payment_method')}
            </h1>
            <p className="text-xl text-neutral-600 font-medium">
              {t('select_payment_method')}
            </p>
            <div className="mt-6 flex justify-center">
              <div className="flex items-center space-x-4 rtl:space-x-reverse">
                <div className="w-2 h-2 bg-green-500 rounded-full"></div>
                <div className="w-2 h-2 bg-green-500 rounded-full"></div>
                <div className="w-2 h-2 bg-green-500 rounded-full"></div>
                <div className="w-12 h-2 bg-gradient-to-r from-orange-400 to-pink-500 rounded-full"></div>
              </div>
            </div>
          </div>

          {/* Form */}
          <form method="post" action={route('frontend.order.processPayment', order.id)} className="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-white/20">
            <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]').getAttribute('content')} />
            <div className="space-y-6">
              <h2 className="text-2xl font-semibold text-center text-neutral-900 mb-6">
                {t('choose_payment_method')}
              </h2>

              {/* Payment Options */}
              <div className="space-y-4">
                <div
                  onClick={() => setPaymentMethod('cod')}
                  className={`border-2 rounded-xl p-6 cursor-pointer transition-all duration-200 ${paymentMethod === 'cod'
                      ? 'border-orange-500 bg-orange-50 shadow-lg scale-105'
                      : 'border-neutral-200 hover:border-orange-300 hover:shadow-md'
                    }`}
                >
                  <div className="flex items-start">
                    <input
                      type="radio"
                      name="payment_method"
                      value="cod"
                      checked={paymentMethod === 'cod'}
                      onChange={() => setPaymentMethod('cod')}
                      className="mt-1 mx-3 w-5 h-5 text-orange-500"
                    />
                    <div className="flex-1">
                      <div className="flex items-center gap-3 mb-2">
                        <i className="fa-solid fa-money-bill-wave text-2xl text-green-600"></i>
                        <h3 className="text-lg font-bold text-neutral-900">
                          {t('payment_cod')}
                        </h3>
                      </div>
                      <p className="text-neutral-600">
                        {t('payment_cod_desc')}
                      </p>
                    </div>
                  </div>
                </div>

                <div
                  onClick={() => setPaymentMethod('paymob')}
                  className={`border-2 rounded-xl p-6 cursor-pointer transition-all duration-200 ${paymentMethod === 'paymob'
                      ? 'border-orange-500 bg-orange-50 shadow-lg scale-105'
                      : 'border-neutral-200 hover:border-orange-300 hover:shadow-md'
                    }`}
                >
                  <div className="flex items-start">
                    <input
                      type="radio"
                      name="payment_method"
                      value="paymob"
                      checked={paymentMethod === 'paymob'}
                      onChange={() => setPaymentMethod('paymob')}
                      className="mt-1 mx-3 w-5 h-5 text-orange-500"
                    />
                    <div className="flex-1">
                      <div className="flex items-center gap-3 mb-2">
                        <i className="fa-solid fa-credit-card text-2xl text-blue-600"></i>
                        <h3 className="text-lg font-bold text-neutral-900">
                          {t('payment_online')}
                        </h3>
                      </div>
                      <p className="text-neutral-600">
                        {t('payment_online_desc')}
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              {/* Order Summary */}
              <div className="bg-gradient-to-r from-orange-50 to-pink-50 rounded-xl p-6 border border-orange-100 mt-8">
                <h3 className="text-lg font-semibold text-neutral-900 mb-4">
                  {t('order_summary')}
                </h3>
                <div className="space-y-3">
                  <div className="flex justify-between">
                    <span className="text-neutral-600">{t('story_price')}:</span>
                    <span className="font-semibold">{order.story_price} {t('currency')}</span>
                  </div>
                  {order.delivery_price > 0 && (
                    <div className="flex justify-between">
                      <span className="text-neutral-600">{t('delivery_price')}:</span>
                      <span className="font-semibold">{order.delivery_price} {t('currency')}</span>
                    </div>
                  )}
                  <div className="border-t-2 border-orange-200 pt-3 flex justify-between">
                    <span className="text-lg font-bold">{t('total_price')}:</span>
                    <span className="text-xl font-bold text-orange-600">{order.total_price} {t('currency')}</span>
                  </div>
                </div>
              </div>

              {/* Submit Button */}
              <div className="flex justify-center pt-6">
                <button
                  type="submit"
                  className="px-12 py-4 bg-gradient-to-r from-orange-500 via-pink-500 to-purple-600 text-white font-bold text-lg rounded-2xl hover:from-orange-600 hover:via-pink-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                >
                  <span className="flex rtl:flex-row-reverse items-center gap-3">
                    <span>{t('complete_payment')}</span>
                    <i className="fa-solid fa-arrow-right "></i>
                  </span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </SiteLayout>
  );
}
