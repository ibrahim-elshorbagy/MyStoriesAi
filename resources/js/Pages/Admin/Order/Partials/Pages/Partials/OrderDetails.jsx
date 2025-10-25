import { Link } from '@inertiajs/react'
import React from 'react'

export default function OrderDetails({ order, t, statusOptions, paymentMethodOptions }) {
  return (
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
        {order.story && (
          <div className="pt-4 border-t border-neutral-200 dark:border-neutral-600">
            <span className="font-medium text-neutral-700 dark:text-neutral-300 block mb-2">{t('story')}:</span>
            <div className="flex flex-col  gap-4">
              {order.face_swap_image_path && (
                <img
                  src={`/storage/${order.face_swap_image_path}`}
                  alt="Face Swap"
                  className="w-48 h-48 object-cover rounded-lg border border-neutral-300 dark:border-neutral-600"
                />
              )}
              <div>
                <a
                  href={`/storage/${order.face_swap_image_path}`}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800 transition-colors duration-200"
                >
                  <i className="fa fa-external-link-alt mx-2"></i>
                  {t('view_full_image')}
                </a>
              </div>
              <Link
                href={route('admin.stories.edit', order.story.id)}
                className="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium"
                target="_blank"
                rel="noopener noreferrer"
              >
                {order.story.title_value}
              </Link>
            </div>
          </div>
        )}
      </div>
    </div>
  )
}
