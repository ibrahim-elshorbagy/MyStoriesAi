import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import { useTrans } from '@/Hooks/useTrans';

export default function ViewOrder({ auth, order }) {
  const { t } = useTrans();

  const formatOptions = {
    first_plan: t('format_first_plan'),
    second_plan: t('format_second_plan'),
    third_plan: t('format_third_plan'),
  };

  const genderOptions = {
    boy: t('gender_boy'),
    girl: t('gender_girl'),
  };

  const languageOptions = {
    arabic: t('language_arabic'),
    english: t('language_english'),
  };

  const statusOptions = {
    pending: t('order_status_pending'),
    processing: t('order_status_processing'),
    completed: t('order_status_completed'),
    cancelled: t('order_status_cancelled'),
  };

  const paymentMethodOptions = {
    paymob: 'Paymob',
    cod: t('cash_on_delivery'),
  };

  return (
    <AppLayout user={auth.user}>
      <Head title={`${t('order')} #${order.id}`} />

      <div className="m-3 xl:m-5">
        <div className="mx-auto space-y-6">
          {/* Header */}
          <div className="flex justify-between items-center">
            <div className="flex items-center gap-4">
              <Link
                href={route('user.orders.index')}
                className="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800"
              >
                <i className="fa fa-arrow-left mr-2"></i>
                {t('back_to_orders')}
              </Link>
              <h1 className="text-3xl font-bold text-neutral-900 dark:text-neutral-100">
                {t('order')} #{order.id}
              </h1>
            </div>
            <span className={`inline-flex px-3 py-1 text-sm font-semibold rounded-full ${order.status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' :
                order.status === 'processing' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400' :
                  order.status === 'pending' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400' :
                    'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400'
              }`}>
              {statusOptions[order.status]}
            </span>
          </div>

          {/* PDF Download */}
          {order.pdf_path && (
            <div className="bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-700 rounded-lg p-6">
              <h3 className="text-lg font-semibold text-neutral-900 dark:text-neutral-100 mb-4">{t('story_pdf')}</h3>
              <div className="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg">
                <div className="flex items-center justify-between">
                  <div className="flex items-center">
                    <i className="fas fa-file-pdf text-green-600 dark:text-green-400 mx-2"></i>
                    <span className="text-green-800 dark:text-green-200">{t('pdf_ready')}</span>
                  </div>
                  <a
                    href={`/storage/${order.pdf_path}`}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:bg-green-900 dark:text-green-200 dark:hover:bg-green-800 transition-colors duration-200"
                  >
                    <i className="fa fa-external-link-alt mx-1"></i>
                    {t('view_pdf')}
                  </a>
                </div>
              </div>
            </div>
          )}
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {/* Order Details */}
            <div className="bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-700 rounded-lg p-6">
              <h3 className="text-lg font-semibold text-neutral-900 dark:text-neutral-100 mb-4">{t('order_details')}</h3>

              <div className="space-y-4">
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('order_id')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">#{order.id}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('created_at')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{new Date(order.created_at).toLocaleString()}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('updated_at')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{new Date(order.updated_at).toLocaleString()}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('payment_method')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{paymentMethodOptions[order.payment_method]}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('story_price')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{order.story_price} {t('currency')}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('delivery_price')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{order.delivery_price} {t('currency')}</span>
                </div>
                <div className="flex justify-between font-semibold text-lg">
                  <span className="text-neutral-700 dark:text-neutral-300">{t('total_price')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{order.total_price} {t('currency')}</span>
                </div>
                {order.customer_note && (
                  <div className="pt-4 border-t border-neutral-200 dark:border-neutral-600">
                    <span className="font-medium text-neutral-700 dark:text-neutral-300 block mb-2">{t('customer_note')}:</span>
                    <p className="text-neutral-900 dark:text-neutral-100 bg-neutral-50 dark:bg-neutral-700 p-3 rounded-lg">{order.customer_note}</p>
                  </div>
                )}
              </div>
            </div>

            {/* Child Information */}
            <div className="bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-700 rounded-lg p-6">
              <h3 className="text-lg font-semibold text-neutral-900 dark:text-neutral-100 mb-4">{t('child_information')}</h3>

              <div className="space-y-4">
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('child_name')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{order.child_name}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('child_age')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{order.child_age} {t('years')}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('language')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{languageOptions[order.language]}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('child_gender')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{genderOptions[order.child_gender]}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('format')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{formatOptions[order.format]}</span>
                </div>

                {/* Learning Values */}
                {(() => {
                  const values = order.value;
                  let valueArray = [];
                  if (Array.isArray(values)) {
                    valueArray = values;
                  } else if (typeof values === 'string') {
                    try {
                      valueArray = JSON.parse(values || '[]');
                    } catch (e) {
                      valueArray = [];
                    }
                  } else if (values && typeof values === 'object') {
                    valueArray = Object.values(values);
                  }
                  return valueArray && valueArray.length > 0 && (
                    <div>
                      <span className="font-medium text-neutral-700 dark:text-neutral-300 block mb-2">{t('learning_value')}:</span>
                      <div className="flex flex-wrap gap-2">
                        {valueArray.map((val, idx) => (
                          <span key={idx} className="inline-block bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-400 text-xs px-2 py-1 rounded-full">
                            {t(`learning_value_${val}`)}
                          </span>
                        ))}
                      </div>
                    </div>
                  );
                })()}

                {order.custom_value && (
                  <div>
                    <span className="font-medium text-neutral-700 dark:text-neutral-300 block mb-2">{t('custom_value')}:</span>
                    <span className="inline-block bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400 text-xs px-2 py-1 rounded-full">
                      {order.custom_value}
                    </span>
                  </div>
                )}

                {/* Child Image */}
                {order.child_image_path && (
                  <div className="pt-4 border-t">
                    <span className="font-medium text-neutral-700 dark:text-neutral-300 block mb-2">{t('child_image')}:</span>
                    <div className="flex items-center gap-4">
                      <img
                        src={`/storage/${order.child_image_path}`}
                        alt={order.child_name}
                        className="w-32 h-32 object-cover rounded-lg border border-neutral-300 dark:border-neutral-600"
                      />
                      <a
                        href={`/storage/${order.child_image_path}`}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800 transition-colors duration-200"
                      >
                        <i className="fa fa-external-link-alt mr-2"></i>
                        {t('view_full_image')}
                      </a>
                    </div>
                  </div>
                )}

                {/* Customization */}
                {(order.hair_color || order.hair_style || order.eye_color || order.skin_tone) && (
                  <div className="pt-4 border-t">
                    <span className="font-medium text-neutral-700 dark:text-neutral-300 block mb-2">{t('customization')}:</span>
                    <div className="space-y-2 text-sm text-neutral-900 dark:text-neutral-100">
                      {order.hair_color && <div><strong className="text-neutral-700 dark:text-neutral-300">{t('hair_color')}:</strong> {order.hair_color}</div>}
                      {order.hair_style && <div><strong className="text-neutral-700 dark:text-neutral-300">{t('hair_style')}:</strong> {order.hair_style}</div>}
                      {order.eye_color && <div><strong className="text-neutral-700 dark:text-neutral-300">{t('eye_color')}:</strong> {order.eye_color}</div>}
                      {order.skin_tone && <div><strong className="text-neutral-700 dark:text-neutral-300">{t('skin_tone')}:</strong> {order.skin_tone}</div>}
                    </div>
                  </div>
                )}

                {(order.clothing_description || order.accessory_description) && (
                  <div className="pt-4 border-t">
                    <span className="font-medium text-neutral-700 dark:text-neutral-300 block mb-2">{t('appearance')}:</span>
                    <div className="space-y-2 text-sm text-neutral-900 dark:text-neutral-100">
                      {order.clothing_description && <div><strong className="text-neutral-700 dark:text-neutral-300">{t('clothing_description')}:</strong> {order.clothing_description}</div>}
                      {order.accessory_description && <div><strong className="text-neutral-700 dark:text-neutral-300">{t('accessory_description')}:</strong> {order.accessory_description}</div>}
                    </div>
                  </div>
                )}

                {order.personality_traits && (
                  <div className="pt-4 border-t">
                    <span className="font-medium text-neutral-700 dark:text-neutral-300 block mb-2">{t('personality_traits')}:</span>
                    <p className="text-neutral-900 dark:text-neutral-100">{order.personality_traits}</p>
                  </div>
                )}

                {order.moral_value && (
                  <div className="pt-4 border-t">
                    <span className="font-medium text-neutral-700 dark:text-neutral-300 block mb-2">{t('moral_value')}:</span>
                    <p className="text-neutral-900 dark:text-neutral-100">{order.moral_value}</p>
                  </div>
                )}
              </div>
            </div>

            {/* Customer Information */}
            <div className="bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-700 rounded-lg p-6">
              <h3 className="text-lg font-semibold text-neutral-900 dark:text-neutral-100 mb-4">{t('customer_information')}</h3>
              <div className="space-y-4">
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('name')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{order.user.name}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('email')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{order.user.email}</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('phone')}:</span>
                  <span className="text-neutral-900 dark:text-neutral-100">{order.user.phone}</span>
                </div>
              </div>
            </div>            {/* Shipping Address */}
            {order.shipping_address && (
              <div className="bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-700 rounded-lg p-6">
                <h3 className="text-lg font-semibold text-neutral-900 dark:text-neutral-100 mb-4">{t('shipping_address')}</h3>

                <div className="space-y-4">
                  <div className="flex justify-between">
                    <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('area')}:</span>
                    <span className="text-neutral-900 dark:text-neutral-100">{order.shipping_address.area || 'N/A'}</span>
                  </div>
                  <div className="flex justify-between">
                    <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('street')}:</span>
                    <span className="text-neutral-900 dark:text-neutral-100">{order.shipping_address.street || 'N/A'}</span>
                  </div>
                  <div className="flex justify-between">
                    <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('house_number')}:</span>
                    <span className="text-neutral-900 dark:text-neutral-100">{order.shipping_address.house_number || 'N/A'}</span>
                  </div>
                  <div className="flex justify-between">
                    <span className="font-medium text-neutral-700 dark:text-neutral-300">{t('delivery_option')}:</span>
                    <span className="text-neutral-900 dark:text-neutral-100">{order?.shipping_address?.delivery_option?.city_value}</span>
                  </div>
                </div>
              </div>
            )}

            {/* Payments */}
            {order.payments && Array.isArray(order.payments) && order.payments.length > 0 && (
              <div className="bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-700 rounded-lg p-6 lg:col-span-2">
                <h3 className="text-lg font-semibold text-neutral-900 dark:text-neutral-100 mb-4">{t('payment_history')}</h3>

                <div className="space-y-4">
                  {order.payments.map((payment, index) => (
                    <div key={index} className="border border-neutral-200 dark:border-neutral-700 rounded-lg p-4">
                      <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                          <span className="font-medium text-neutral-700 dark:text-neutral-300 block">{t('amount')}:</span>
                          <span className="text-neutral-900 dark:text-neutral-100">{payment.amount} {payment.currency}</span>
                        </div>
                        <div>
                          <span className="font-medium text-neutral-700 dark:text-neutral-300 block">{t('payment_method')}:</span>
                          <span className="text-neutral-900 dark:text-neutral-100">{paymentMethodOptions[payment.payment_method]}</span>
                        </div>
                        <div>
                          <span className="font-medium text-neutral-700 dark:text-neutral-300 block">{t('status')}:</span>
                          <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${payment.status === 'paid' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' :
                              payment.status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400' :
                                payment.status === 'failed' ? 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400' :
                                  'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400'
                            }`}>
                            {t(`payment_status_${payment.status}`)}
                          </span>
                        </div>
                        <div>
                          <span className="font-medium text-neutral-700 dark:text-neutral-300 block">{t('created_at')}:</span>
                          <span className="text-neutral-900 dark:text-neutral-100 text-sm">{new Date(payment.created_at).toLocaleString()}</span>
                        </div>
                      </div>
                      {payment.transaction_id && (
                        <div className="mt-2">
                          <span className="font-medium text-neutral-700 dark:text-neutral-300 block">{t('transaction_id')}:</span>
                          <span className="text-neutral-900 dark:text-neutral-100 text-sm font-mono">{payment.transaction_id}</span>
                        </div>
                      )}
                      {payment.notes && (
                        <div className="mt-2">
                          <span className="font-medium text-neutral-700 dark:text-neutral-300 block">{t('notes')}:</span>
                          <p className="text-neutral-900 dark:text-neutral-100 text-sm">{payment.notes}</p>
                        </div>
                      )}
                    </div>
                  ))}
                </div>
              </div>
            )}
          </div>


        </div>
      </div>
    </AppLayout>
  );
}
