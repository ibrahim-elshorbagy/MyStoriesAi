import React, { useState, useEffect } from 'react';
import Pagination from '@/Components/Pagination';
import TableControls from '@/Components/TableControls';
import { router } from '@inertiajs/react';
import { useTrans } from '@/Hooks/useTrans';

export default function SelectableTable({
  columns,
  data,
  onRowClick = null,
  routeName,
  queryParams = {},
  renderRow = null,
  idField = 'id',
  pagination = null,
  onSort = null,
  bulkActions = [],
  sortOptions = [],
  defaultSortField = null,
  defaultSortDirection = 'asc',
  perPageOptions = [10, 25, 50, 100],
  defaultPerPage = 15,
  getRowClassName = null,
  showSelection = true,
  pageParam = 'page',

}) {
  // Initialize translation
  const { t } = useTrans();

  // State
  const [selectedItems, setSelectedItems] = useState([]);
  const [selectAll, setSelectAll] = useState(false);
  const [sortField, setSortField] = useState(defaultSortField || '');
  const [sortDirection, setSortDirection] = useState(defaultSortDirection);
  const [perPage, setPerPage] = useState(queryParams.per_page || 15);

  // Reset selections when data changes
  useEffect(() => {
    setSelectedItems([]);
    setSelectAll(false);
  }, [data]);

  // Handle row selection
  const handleSelect = (item) => {
    setSelectedItems(prev => {
      const itemId = item[idField];
      if (prev.includes(itemId)) {
        return prev.filter(id => id !== itemId);
      } else {
        return [...prev, itemId];
      }
    });
  };

  // Handle select all
  const handleSelectAll = () => {
    if (selectAll || selectedItems.length === data.length) {
      setSelectedItems([]);
      setSelectAll(false);
    } else {
      setSelectedItems(data.map(item => item[idField]));
      setSelectAll(true);
    }
  };

  // Handle sorting
  const handleSort = (field, direction) => {
    setSortField(field);
    setSortDirection(direction);

    if (onSort) {
      onSort(field, direction);
    } else if (routeName) {
      // Get current URL query parameters instead of using props queryParams
      let queryString = { ...Object.fromEntries(new URLSearchParams(window.location.search)) };
      queryString.sort = field;
      queryString.direction = direction;

      // Reset page to 1 when sorting
      queryString[pageParam] = 1;

      router.get(route(routeName, route().params), queryString, {
        preserveState: true,
        replace: true
      });
    }
  };

  // Handle per page change
  const handlePerPageChange = (value) => {
    setPerPage(value);

    if (routeName) {
      // Get current URL query parameters instead of using props queryParams
      let queryString = { ...Object.fromEntries(new URLSearchParams(window.location.search)) };
      queryString.per_page = value;

      // Reset page to 1 when changing per page
      queryString[pageParam] = 1;

      router.get(route(routeName, route().params), queryString, {
        preserveState: true,
        replace: true
      });
    }
  };

  // Handle bulk actions
  const handleBulkAction = async (action, ids) => {
    if (action.handler) {
      await action.handler(ids);
      setSelectedItems([]);
    }
  };

  return (
    <>
      <TableControls
        onSort={handleSort}
        sortField={sortField}
        sortDirection={sortDirection}
        perPage={perPage}
        totalItems={pagination ? pagination.total : data.length}
        onPerPageChange={handlePerPageChange}
        selectedItems={selectedItems}
        onSelectAll={handleSelectAll}
        bulkActions={bulkActions}
        onBulkAction={handleBulkAction}
        sortOptions={sortOptions}
        queryParams={queryParams}
        routeName={routeName}
        pageParam={pageParam}

      />

      <div className="overflow-auto">
        <table className="w-full text-sm rtl:text-right ltr:text-left text-neutral-800 dark:text-neutral-200">
          <thead className="text-neutral-700 uppercase border-b-2 border-neutral-500 bg-neutral-100 dark:bg-neutral-800 dark:text-neutral-300">
            <tr>
              {showSelection && (
                <th className="py-2 px-3 w-10">
                  <div className="flex items-center">
                    <input
                      type="checkbox"
                      className="w-4 h-4 text-orange-600 bg-neutral-100 border-neutral-300 rounded focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-neutral-800 dark:focus:ring-offset-neutral-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600"
                      checked={data.length > 0 && selectedItems.length === data.length}
                      onChange={handleSelectAll}
                    />
                  </div>
                </th>
              )}
              {columns.map(column => (
                <th
                  key={column.field}
                  className={`py-2 px-3 font-semibold text-nowrap ${column.className || ''}`}
                >
                  <div className="flex items-center gap-1">
                    {column.icon && <i className={`fa-solid ${column.icon}`}></i>}
                    <span>{column.label}</span>
                    {sortOptions.find(opt => opt.field === column.field) && (
                      <button
                        className="ml-1"
                        onClick={() => handleSort(
                          column.field,
                          sortField === column.field && sortDirection === 'asc' ? 'desc' : 'asc'
                        )}
                      >
                        {sortField === column.field ? (
                          <i className={`fa-solid fa-sort-${sortDirection === 'asc' ? 'up' : 'down'} text-orange-500`}></i>
                        ) : (
                          <i className="fa-solid fa-sort text-neutral-400"></i>
                        )}
                      </button>
                    )}
                  </div>
                </th>
              ))}
            </tr>
          </thead>
          <tbody>
            {data.length > 0 ? (
              data.map((item, index) => {
                const isSelected = selectedItems.includes(item[idField]);
                const customRowClass = getRowClassName ? getRowClassName(item, index, isSelected) : '';
                const defaultRowClass = index % 2 === 0 ? 'bg-neutral-100 dark:bg-neutral-800' : 'bg-neutral-50 dark:bg-neutral-900';

                return (
                  <tr
                    key={item[idField]}
                    className={`transition-colors ${customRowClass || defaultRowClass} border-b border-neutral-300 dark:border-neutral-800 ${isSelected ? 'bg-orange-50 dark:bg-orange-950' : ''} ${onRowClick ? 'cursor-pointer' : ''}`}
                    onClick={onRowClick ? () => onRowClick(item) : undefined}
                  >
                    {showSelection && (
                      <td
                        className="px-3 py-2"
                        onClick={(e) => {
                          e.stopPropagation();
                          handleSelect(item);
                        }}
                      >
                        <div className="flex items-center">
                          <input
                            type="checkbox"
                            className="w-4 h-4 text-orange-600 bg-neutral-100 border-neutral-300 rounded focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-neutral-800 dark:focus:ring-offset-neutral-800 focus:ring-2 dark:bg-neutral-700 dark:border-neutral-600"
                            checked={isSelected}
                            onChange={() => { }}
                          />
                        </div>
                      </td>
                    )}
                    {renderRow
                      ? renderRow(item, isSelected, handleSelect)
                      : columns.map((column, i) => (
                        <td key={i} className="px-3 py-2">
                          {column.render
                            ? column.render(item)
                            : item[column.accessor] || '-'}
                        </td>
                      ))
                    }
                  </tr>
                );
              })
            ) : (
              <tr>
                <td colSpan={columns.length + 1} className="px-3 py-2 text-center text-neutral-500 dark:text-neutral-400">
                  <i className="fa-regular fa-face-frown"></i> {t('no_items_found')}
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>

      {pagination && <Pagination links={pagination.links} />}
    </>
  );
}
