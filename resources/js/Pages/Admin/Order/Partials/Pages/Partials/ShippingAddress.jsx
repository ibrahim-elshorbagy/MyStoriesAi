import React from 'react'

export default function ShippingAddress({ order, t }) {
  if (!order.shipping_address) return null;

  return (
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
  )
}
