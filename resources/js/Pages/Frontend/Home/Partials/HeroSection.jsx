
import React from 'react';
import { Link } from '@inertiajs/react';
import PrimaryButton from '@/Components/PrimaryButton';
import ActionButton from '@/Components/ActionButton';
import { useTrans } from '@/Hooks/useTrans';
import HeroVideo from './HeroVideo';

export default function HeroSection() {
  const { t } = useTrans();

  return (
    <section id="home" className=" relative overflow-hidden flex items-center bg-gradient-to-br from-orange-50 via-neutral-50 to-orange-100 dark:from-orange-900 dark:via-neutral-900 dark:to-orange-800 pt-20">
      {/* Animated Background SVG */}
      <div className="absolute inset-0 -bottom-6 -z-20 pointer-events-none">
        <svg
          className="w-full h-full"
          viewBox="0 0 1440 800"
          preserveAspectRatio="xMidYMid slice"
          xmlns="http://www.w3.org/2000/svg"
          aria-hidden="true"
        >
          <defs>
            <linearGradient id="seaGrad" x1="0" x2="0" y1="0" y2="1">
              <stop offset="0%" stopColor="#90dfd5" stopOpacity="0.95" />
              <stop offset="60%" stopColor="#0284c7" stopOpacity="0.9" />
              <stop offset="100%" stopColor="#0369a1" stopOpacity="0.9" />
            </linearGradient>

            <filter id="soft" x="-10%" y="-10%" width="120%" height="120%">
              <feGaussianBlur stdDeviation="6" result="b" />
              <feBlend in="SourceGraphic" in2="b" />
            </filter>
          </defs>

          <rect width="100%" height="100%" fill="#ffffff" />

          {/* Wave animations */}
          <g className="wave wave--1" style={{ filter: "url(#soft)" }}>
            <path
              d="M0 500 C 220 420 360 580 720 520 C 1020 470 1120 560 1440 500 L1440 800 L0 800 Z"
              fill="#ff6800"
              opacity="0.2"
            />
          </g>

          <g className="wave wave--2">
            <path
              d="M0 520 C 240 460 420 600 720 540 C 980 480 1180 610 1440 540 L1440 800 L0 800 Z"
              fill="#ff6800"
              opacity="0.17"
            />
          </g>

          <g className="wave wave--3">
            <path
              d="M0 540 C 260 500 480 650 760 580 C 980 520 1240 660 1440 580 L1440 800 L0 800 Z"
              fill="#ff6800"
              opacity="0.15"
            />
          </g>

          <g className="wave wave--shine">
            <path
              d="M0 560 C 280 520 520 680 820 600 C 1060 540 1280 700 1440 620 L1440 800 L0 800 Z"
              fill="#ff6800"
              opacity="0.12"
            />
          </g>
        </svg>
      </div>

      {/* Decorative Icons */}
      <i className="fa-solid fa-star absolute top-0 ltr:left-[5%] rtl:right-[5%] w-8 h-8 text-orange-400 text-3xl"></i>
      <i className="fa-solid fa-star absolute top-[5%] ltr:left-[13%] rtl:right-[13%] w-7 h-7 text-orange-400 text-2xl"></i>
      <i className="fa-solid fa-moon absolute top-[8%] ltr:left-[3%] rtl:right-[3%] w-10 h-10 text-orange-500 text-4xl"></i>
      <i className="fa-solid fa-heart absolute top-[5%] ltr:right-[5%] rtl:left-[5%] w-8 h-8 -z-10 text-pink-400 text-3xl"></i>
      <i className="fa-solid fa-cloud absolute bottom-[5%] ltr:right-[2%] rtl:left-[2%] w-20 h-12 text-blue-300 text-5xl"></i>
      <i className="fa-solid fa-cloud absolute bottom-[1%] ltr:right-[15%] rtl:left-[15%] w-24 h-16 text-blue-300 text-6xl"></i>
      <i className="fa-solid fa-cloud absolute bottom-0 ltr:right-[5%] rtl:left-[5%] w-20 h-14 text-blue-300 text-5xl"></i>

      <div className="flex flex-col lg:flex-row items-center gap-4 lg:gap-16 h-fit lg:h-[480px] xl:h-[540px] 2xl:h-[580px] mx-auto lg:mx-0 py-6 lg:py-0">
        <div className="flex-[3] order-2 lg:order-1 relative h-full p-4 lg:p-0 flex items-center">
          <HeroVideo />
        </div>

        <div className="flex-[2] lg:py-10 text-center lg:text-start order-1 lg:order-2 gap-4 lg:gap-6 flex flex-col items-center lg:items-start justify-center">
          <div className="flex flex-col gap-3">
            <h1 className="text-3xl xl:text-5xl sm:rtl:text-5xl font-bold text-primary-foreground relative w-fit mx-auto md:mx-0 text-orange-800 dark:text-orange-200">
              <span className="shadow-child text-3xl xl:text-5xl sm:rtl:text-5xl">
                {t('hero_subtitle')}
              </span>{" "}
              <span className="text-2xl xl:text-4xl sm:rtl:text-4xl">
                {t('hero_title')}
              </span>
            </h1>
            <p className="text-lg sm:text-xl text-neutral-700 dark:text-neutral-300 max-w-lg">
              {t('hero_description')}
            </p>
          </div>

          <div className="flex items-center gap-2 sm:gap-4 justify-center md:justify-start">
            <PrimaryButton
              as={Link}
              // href={route('stories.create')}
              className="px-10 text-base font-semibold shadow-md hover:scale-105"
            >
              {t('hero_cta_primary')}
            </PrimaryButton>
            <ActionButton
              as={Link}
              href="#features"
              variant="primary"
              size="md"
              className="border border-orange-500 hover:bg-orange-500 hover:text-white"
            >
              {t('hero_cta_secondary')}
            </ActionButton>
          </div>
        </div>
      </div>
    </section>
  );
}
