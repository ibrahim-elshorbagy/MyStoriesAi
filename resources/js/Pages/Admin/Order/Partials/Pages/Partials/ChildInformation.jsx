import React from 'react'

export default function ChildInformation({ order, t, genderOptions, languageOptions, formatOptions }) {
  return (
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
  )
}
