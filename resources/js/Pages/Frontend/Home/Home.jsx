import SiteLayout from '@/Layouts/SiteLayout/SiteLayout';
import { Head, Link, usePage } from '@inertiajs/react';
import React from 'react';
import HeroSection from './Partials/HeroSection';
import FeaturesSection from './Partials/FeaturesSection';
import StoriesSection from './Partials/StoriesSection.jsx';
import AgeCategoriesSection from './Partials/AgeCategoriesSection.jsx';
import PricingSection from './Partials/PricingSection';
import FAQs from './Partials/FAQs';
import CustomerFeedbackSection from './Partials/CustomerFeedbackSection';
import { useTrans } from '@/Hooks/useTrans';

export default function Home({ stories, faqs, categories, settings, textFeedbacks, imageFeedbacks }) {
  const { t } = useTrans();
  const { locale } = usePage().props;

  return (
    <SiteLayout>
      <Head title={t('home')} />

      <HeroSection />
      <FeaturesSection />
      <StoriesSection stories={stories} />

      {locale === 'en' && (
        <div className="relative w-full">
          <img className="w-full h-auto object-cover" src="/assets/home/1.png" alt="" />
          <div className="absolute inset-x-0 bottom-12 flex items-center justify-center">
            <Link
              size="large"
              as={Link}
              href={route('stories')}
              className="px-6 w-fit py-4 mt-4 text-lg sm:text-xl font-bold bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-400 hover:to-orange-500 text-white shadow-2xl shadow-orange-900/50 hover:shadow-orange-800/60 transform hover:scale-105 transition-all duration-300 rounded-md border-2 border-orange-300/30 backdrop-blur-sm"
            >
              {t("try_now")}
            </Link>
          </div>
        </div>
      )}

      {locale === 'ar' && (
        <div className="relative w-full">
          <img className="w-full h-auto object-cover" src="/assets/home/2.png" alt="" />
          <div className="absolute inset-x-0 bottom-12 flex items-center justify-center">
            <Link
              size="large"
              as={Link}
              href={route('stories')}
              className="px-6 w-fit py-4 mt-4 text-lg sm:text-xl font-bold bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-400 hover:to-orange-500 text-white shadow-2xl shadow-orange-900/50 hover:shadow-orange-800/60 transform hover:scale-105 transition-all duration-300 rounded-md border-2 border-orange-300/30 backdrop-blur-sm"
            >
              {t("try_now")}
            </Link>
          </div>
        </div>
      )}

      <AgeCategoriesSection categories={categories} />
      <PricingSection settings={settings} />
      <CustomerFeedbackSection textFeedbacks={textFeedbacks} imageFeedbacks={imageFeedbacks} />
      <FAQs faqs={faqs} />
    </SiteLayout>
  );
}
