import React from 'react';
import { Link } from '@inertiajs/react';
import { useTrans } from '@/Hooks/useTrans';

export default function HowItWorks() {
  const { t } = useTrans();

  const options = [
    {
      key: 'create-story',
      image: '/assets/home/HowItWorks1.png',
      title: t('how_it_works_option1_title'),
      features: [
        { icon: 'fa-magic', text: t('how_it_works_option1_feature1') },
        { icon: 'fa-wrench', text: t('how_it_works_option1_feature2') },
      ],
      button: {
        text: t('how_it_works_option1_button'),
        href: route('frontend.order.create'),
        className:
          'px-6 py-4 text-lg font-bold bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-400 hover:to-orange-500 text-white shadow-2xl shadow-orange-900/50 hover:shadow-orange-800/60 transform hover:scale-105 transition-all duration-300 rounded-md border-2 border-orange-300/30 backdrop-blur-sm',
      },
    },
    {
      key: 'browse-stories',
      image: '/assets/home/HowItWorks2.png',
      title: t('how_it_works_option2_title'),
      features: [
        { icon: 'fa-book', text: t('how_it_works_option2_feature1') },
        { icon: 'fa-eye', text: t('how_it_works_option2_feature2') },
      ],
      button: {
        text: t('how_it_works_option2_button'),
        href: route('stories'),
        className:
          'px-6 py-4 text-lg font-bold bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white shadow-2xl shadow-orange-900/40 hover:shadow-orange-800/50 transform hover:scale-105 transition-all duration-300 rounded-md border-2 border-orange-300/30',
      },
    },
  ];

  return (
    <section
      className="relative py-16  bg-neutral-50"
      id="how-it-works"
    >
      <div className="container mx-auto flex flex-col gap-14 md:gap-16">
        <div className="text-center mx-auto flex flex-col gap-4 max-w-3xl">
          <div className="flex items-center justify-center flex-col gap-1">
            <h2 className="text-4xl pb-2 xl:text-6xl leading-normal font-bold bg-gradient-to-r from-green-500 to-orange-600 bg-clip-text text-transparent">
              {t('how_it_works_title')}
            </h2>
            <h3 className="text-2xl xl:text-3xl font-semibold text-orange-700 mt-4">
              {t('how_it_works_subtitle')}
            </h3>
          </div>
          <p className="text-lg text-neutral-600 leading-relaxed">
            {t('how_it_works_description')}
          </p>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-10">
          {options.map((option) => (
            <div
              key={option.key}
              className="group bg-white border border-neutral-200 rounded-md p-8 flex flex-col items-center text-center hover:shadow-2xl hover:scale-105 transition-all duration-300"
            >
              <img
                src={option.image}
                alt={option.title}
                className="w-full h-[300px] sm:h-[450px] xl:h-[500px] object-cover rounded-md shadow-lg mb-6"
              />
              <h3 className="text-2xl font-semibold text-neutral-800 mb-4 group-hover:text-orange-600 transition-colors">
                {option.title}
              </h3>
              <ul className="w-full text-left rtl:text-right space-y-3 mb-6">
                {option.features.map((feature) => (
                  <li
                    key={`${option.key}-${feature.icon}`}
                    className="flex items-start gap-3 rtl:flex-row-reverse"
                  >
                    <span className="mt-1 text-orange-500 flex-shrink-0">
                      <i className={`fa-solid ${feature.icon} text-xl`}></i>
                    </span>
                    <span className="text-neutral-600 leading-relaxed">
                      {feature.text}
                    </span>
                  </li>
                ))}
              </ul>
              <Link
                href={option.button.href}
                className={`${option.button.className} w-full sm:w-auto`}
              >
                {option.button.text}
              </Link>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
