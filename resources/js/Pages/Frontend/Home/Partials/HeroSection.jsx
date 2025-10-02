import React from 'react';
import { Link } from '@inertiajs/react';
import PrimaryButton from '@/Components/PrimaryButton';
import { useTrans } from '@/Hooks/useTrans';
import HeroVideo from './HeroVideo';

export default function HeroSection() {
  const { t } = useTrans();

  return (
    <section id="home" className="relative overflow-hidden flex items-center bg-gradient-to-br from-orange-50 via-white to-orange-100/50 dark:from-orange-950 dark:via-neutral-900 dark:to-orange-900/70 ">

      {/* Modern Background Elements */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        {/* Primary Gradient Orbs */}
        <div className="absolute top-20 -right-40 w-96 h-96 bg-gradient-to-br from-orange-400/20 to-orange-600/10 rounded-full blur-3xl animate-pulse"></div>
        <div className="absolute -bottom-32 -left-40 w-80 h-80 bg-gradient-to-tr from-orange-500/15 to-orange-300/10 rounded-full blur-3xl"></div>

        {/* Secondary Accent Orbs */}
        <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-r from-orange-200/15 to-orange-400/8 rounded-full blur-2xl"></div>
        <div className="absolute top-10 left-20 w-32 h-32 bg-orange-300/15 rounded-full blur-xl animate-bounce"></div>
        <div className="absolute bottom-20 right-20 w-24 h-24 bg-orange-400/20 rounded-full blur-lg"></div>
      </div>

      {/* Floating Decorative Icons - Modern Layout */}
      <div className="absolute inset-0 pointer-events-none z-20">
        {/* Left Side Icons (Around video area) */}
        <div className="absolute top-32 left-8 lg:left-4 animate-float opacity-80">
          <i className="fa-solid fa-rocket text-orange-500 text-4xl drop-shadow-lg"></i>
        </div>
        <div className="absolute top-48 left-20 lg:left-12 animate-float-delay-1 opacity-70">
          <i className="fa-solid fa-lightbulb text-amber-400 text-2xl drop-shadow-md"></i>
        </div>
        <div className="absolute bottom-32 left-12 lg:left-6 animate-float-delay-2 opacity-75">
          <i className="fa-solid fa-star text-orange-400 text-3xl drop-shadow-lg"></i>
        </div>

        {/* Right Side Icons (Around content area) */}
        <div className="absolute top-28 right-12 lg:right-20 animate-float-delay-1 opacity-80">
          <i className="fa-solid fa-crown text-orange-600 text-3xl drop-shadow-lg"></i>
        </div>
        <div className="absolute top-44 right-24 lg:right-32 animate-float opacity-70">
          <i className="fa-solid fa-gem text-orange-400 text-2xl drop-shadow-md"></i>
        </div>
        <div className="absolute top-60 right-8 lg:right-16 animate-float-delay-2 opacity-75">
          <i className="fa-solid fa-magic-wand-sparkles text-amber-500 text-2xl drop-shadow-md"></i>
        </div>

        {/* Bottom Floating Elements */}
        <div className="absolute bottom-40 left-1/4 animate-float-delay-1 opacity-60">
          <i className="fa-solid fa-fire text-orange-500 text-3xl drop-shadow-lg"></i>
        </div>
        <div className="absolute bottom-32 right-1/4 animate-float opacity-70">
          <i className="fa-solid fa-bolt text-orange-400 text-2xl drop-shadow-md"></i>
        </div>
        <div className="absolute bottom-48 right-1/3 animate-float-delay-2 opacity-65">
          <i className="fa-solid fa-heart text-orange-500 text-2xl drop-shadow-md"></i>
        </div>

        {/* Scattered Center Elements */}
        <div className="absolute top-1/3 left-1/3 animate-float-delay-1 opacity-50">
          <i className="fa-solid fa-sparkles text-amber-400 text-xl drop-shadow-sm"></i>
        </div>
        <div className="absolute bottom-1/3 right-2/5 animate-float opacity-55">
          <i className="fa-solid fa-certificate text-orange-500 text-xl drop-shadow-sm"></i>
        </div>
      </div>

      {/* Main Content Container - Full Width Layout */}
      <div className="flex flex-col lg:flex-row items-stretch gap-4 lg:gap-0 h-fit lg:h-[600px] xl:h-[700px] 2xl:h-[800px]  py-6 lg:py-0 relative z-30">

        {/* Video Section - Full Width on Desktop */}
        <div className="flex-[3] order-2 lg:order-1 relative h-full px-4 lg:px-0 flex items-center w-full">
          <HeroVideo />
        </div>

        {/* Content Section - With Container Padding */}
        <div className="flex-[2] lg:py-10 text-center lg:text-start order-1 lg:order-2 gap-4 lg:gap-6 flex flex-col items-center lg:items-start justify-center z-10 px-6 lg:px-12">

          {/* Main Heading */}
          <div className="flex flex-col gap-3 max-lg:pt-10">
            <h1 className="text-3xl xl:text-5xl font-bold relative w-fit mx-auto lg:mx-0">
              <span className="block  xl:text-5xl bg-gradient-to-r from-orange-600 to-orange-500 dark:from-orange-400 dark:to-orange-300 bg-clip-text text-transparent font-bold mb-2">
              <span className='shadow-child text-4xl'>{t('your_child')}</span> <span className='text-3xl'>{t('is_the_hero')}</span>
              </span>
              <span className="block text-2xl xl:text-4xl bg-gradient-to-r from-orange-800 via-orange-700 to-orange-600 dark:from-orange-300 dark:via-orange-200 dark:to-orange-400 bg-clip-text text-transparent">
                {t('hero_title')}
              </span>
            </h1>

            <p className="text-lg sm:text-xl text-neutral-700 dark:text-neutral-300 max-w-lg mx-auto lg:mx-0 leading-relaxed">
              {t('hero_description')}
            </p>
          </div>

          {/* Single CTA Button */}
          <div className="flex items-center justify-center lg:justify-start pt-4">
            <PrimaryButton
              as={Link}
              // href={route('stories.create')}
              className="px-12 py-4 text-lg font-bold bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white shadow-2xl shadow-orange-500/30 hover:shadow-orange-600/40 transform hover:scale-105 transition-all duration-300 rounded-full"
            >
              {t('explore_our_stories')}
            </PrimaryButton>
          </div>
        </div>
      </div>
    </section>
  );
}
