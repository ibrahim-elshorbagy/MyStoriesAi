import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import { useTrans } from '@/Hooks/useTrans';
import OrderDetails from './Partials/OrderDetails';
import ChildInformation from './Partials/ChildInformation';
import CustomerInformation from './Partials/CustomerInformation';
import ShippingAddress from './Partials/ShippingAddress';
import PaymentHistory from './Partials/PaymentHistory';
import UpdatePaymentStatus from './Partials/UpdatePaymentStatus';
import UpdateOrderStatus from './Partials/UpdateOrderStatus';
import UploadPDF from './Partials/UploadPDF';

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
    german: t('language_german'),
  };

  const statusOptions = {
    pending: t('order_status_pending'),
    processing: t('order_status_processing'),
    completed: t('order_status_completed'),
    cancelled: t('order_status_cancelled'),
  };

  const paymentMethodOptions = {
    stripe: 'Stripe',
    pending: t('pending_payment'),
  };

  return (
    <AppLayout user={auth.user}>
      <Head title={`${t('order')} #${order.id}`} />

      <div className="m-3 xl:m-5">
        <div className=" mx-auto space-y-6">
          {/* Header */}
          <div className="flex justify-between items-center">
            <div className="flex items-center rtl:flex-row-reverse gap-4">
              <Link
                href={route('admin.orders.index')}
                className="inline-flex  items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800"
              >
                <i className="fa fa-arrow-left mx-2 rtl:rotate-180"></i>
                <span>{t('back_to_orders')}</span>
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

          <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <OrderDetails order={order} t={t} statusOptions={statusOptions} paymentMethodOptions={paymentMethodOptions} />
            <ChildInformation order={order} t={t} genderOptions={genderOptions} languageOptions={languageOptions} formatOptions={formatOptions} />
            <CustomerInformation order={order} t={t} />
            <ShippingAddress order={order} t={t} />
            <PaymentHistory order={order} t={t} paymentMethodOptions={paymentMethodOptions} />
          </div>

          {/* Admin Actions */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <UpdatePaymentStatus order={order} t={t} />
            <UpdateOrderStatus order={order} t={t} />
            <UploadPDF order={order} t={t} />
          </div>
        </div>
      </div>
    </AppLayout>
  );
}
