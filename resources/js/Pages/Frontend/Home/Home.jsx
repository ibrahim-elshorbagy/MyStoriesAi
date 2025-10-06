import SiteLayout from '@/Layouts/SiteLayout/SiteLayout';
import { Head } from '@inertiajs/react';
import React from 'react';
import HeroSection from './Partials/HeroSection';
import FeaturesSection from './Partials/FeaturesSection';
import ContactSection from './Partials/ContactSection';
import AboutSection from './Partials/AboutSection';
import StoriesSection from './Partials/StoriesSection.jsx';
import PricingSection from './Partials/PricingSection';
import FAQs from './Partials/FAQs';
import { useTrans } from '@/Hooks/useTrans';

export default function Home({ stories, faqs }) {
    const { t } = useTrans();

  return (
    <SiteLayout>
      <Head title={t('home')} />

      <HeroSection />
      <FeaturesSection />
      {/* <StoriesSection stories={stories} /> */}
      <PricingSection />
      <FAQs faqs={faqs} />
    </SiteLayout>
  );
}
