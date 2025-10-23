import SiteLayout from '@/Layouts/SiteLayout/SiteLayout';
import { Head, usePage } from '@inertiajs/react';
import React from 'react';
import HeroSection from './Partials/HeroSection';
import FeaturesSection from './Partials/FeaturesSection';
import StoriesSection from './Partials/StoriesSection.jsx';
import AgeCategoriesSection from './Partials/AgeCategoriesSection.jsx';
import PricingSection from './Partials/PricingSection';
import FAQs from './Partials/FAQs';
import { useTrans } from '@/Hooks/useTrans';

export default function Home({ stories, faqs, categories, settings }) {
  const { t } = useTrans();
  const { locale } = usePage().props;

  return (
    <SiteLayout>
      <Head title={t('home')} />

      <HeroSection />
      <FeaturesSection />
      <StoriesSection stories={stories} />

      {locale === 'en' && <img className="object-contain " src="/assets/home/1.png" alt="" />}
      {locale === 'ar' && <img className="object-contain " src="/assets/home/2.png" alt="" />}

      <AgeCategoriesSection categories={categories} />
      <PricingSection settings={settings} />
      <FAQs faqs={faqs} />
    </SiteLayout>
  );
}
