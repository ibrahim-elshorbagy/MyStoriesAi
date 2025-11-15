import ActionButton from '@/Components/ActionButton';
import SelectableTable from '@/Components/SelectableTable';
import React from 'react';
import { useTrans } from '@/Hooks/useTrans';
import { Link } from '@inertiajs/react';

export default function OrdersTable({ orders }) {
  const { t } = useTrans();

  // Table configuration
  const columns = [
    { field: 'row_number', label: t('serial'), icon: 'fa-hashtag' },
    { field: 'id', label: t('order_id'), icon: 'fa-shopping-cart' },
    { field: 'child_name', label: t('child_name'), icon: 'fa-child' },
    { field: 'user_name', label: t('customer'), icon: 'fa-user' },
    { field: 'status', label: t('status'), icon: 'fa-info-circle' },
    { field: 'total_price', label: t('total_price'), icon: 'fa-dollar-sign' },
    { field: 'created_at', label: t('created_at'), icon: 'fa-calendar' },
    { field: 'actions', label: t('actions'), icon: 'fa-gear', className: 'flex justify-center' }
  ];

  const sortOptions = [
    { field: 'id', label: t('order_id') },
    { field: 'child_name', label: t('child_name') },
    { field: 'created_at', label: t('created_at') },
    { field: 'status', label: t('status') }
  ];

  const renderRow = (order) => (
    <>
      <td className="px-3 py-4 whitespace-nowrap text-sm text-neutral-900 dark:text-neutral-100">
        {order.row_number}
      </td>
      <td className="px-3 py-4 whitespace-nowrap">
        <div className="flex items-center gap-2">
          <i className="fa-solid fa-shopping-cart text-blue-500"></i>
          <span className="text-sm font-medium text-neutral-900 dark:text-neutral-100">
            #{order.id}
          </span>
        </div>
      </td>
      <td className="px-3 py-4 whitespace-nowrap">
        <div className="flex items-center gap-2">
          <i className="fa-solid fa-child text-green-500"></i>
          <span className="text-sm font-medium text-neutral-900 dark:text-neutral-100">
            {order.child_name}
          </span>
        </div>
      </td>
      <td className="px-3 py-4 whitespace-nowrap">
        <div className="flex items-center gap-2">
          <i className="fa-solid fa-user text-purple-500"></i>
          <span className="text-sm font-medium text-neutral-900 dark:text-neutral-100">
            {order.user?.name || 'N/A'}
          </span>
        </div>
      </td>
      <td className="px-3 py-4 whitespace-nowrap">
        <div className="flex flex-col gap-1">
          <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${
            order.status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' :
            order.status === 'processing' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
            order.status === 'pending' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' :
            'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
          }`}>
            {t('order')}: {t(`order_status_${order.status}`)}
          </span>
          <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${
            (order.payments?.[0]?.status || 'pending') === 'paid' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' :
            (order.payments?.[0]?.status || 'pending') === 'pending' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' :
            (order.payments?.[0]?.status || 'pending') === 'failed' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' :
            'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200'
          }`}>
            {t('payment')}: {t(`payment_status_${order.payments?.[0]?.status || 'pending'}`)}
          </span>
        </div>
      </td>
      <td className="px-3 py-4 whitespace-nowrap text-sm text-neutral-900 dark:text-neutral-100">
        {order.total_price} {t('currency')}
      </td>
      <td className="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
        {new Date(order.created_at).toLocaleDateString()}
      </td>
      <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <div className="flex items-center justify-center gap-2">
          <ActionButton
            href={route('admin.orders.show', order.id)}
            variant='info'
            as="a"
          >
            <i className="fa fa-eye mr-1"></i>
            {t('view')}
          </ActionButton>
        </div>
      </td>
    </>
  );

  // Row styling function
  const getRowClassName = (order, index, isSelected) => {
    if (isSelected) return ''; // Let SelectableTable handle selected state

    // Alternate between neutral backgrounds
    return index % 2 === 0
      ? 'bg-neutral-100 dark:bg-neutral-800 hover:bg-neutral-200 dark:hover:bg-neutral-700'
      : 'bg-neutral-50 dark:bg-neutral-900 hover:bg-neutral-100 dark:hover:bg-neutral-800';
  };

  return (
    <SelectableTable
      columns={columns}
      data={orders ? orders.data : []}
      pagination={orders}
      routeName="admin.orders.index"
      queryParams={{}}
      sortOptions={sortOptions}
      defaultSortField={'created_at'}
      defaultSortDirection={'desc'}
      renderRow={renderRow}
      getRowClassName={getRowClassName}
    />
  );
}
