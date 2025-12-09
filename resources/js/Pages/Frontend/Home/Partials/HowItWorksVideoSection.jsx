import React from 'react';
import { useTrans } from '@/Hooks/useTrans';

export default function HowItWorksVideoSection({ videoUrl }) {
  const { t } = useTrans();

  return (
    <section className="relative py-16 xl:min-h-[calc(100dvh-4rem)] bg-neutral-50">
      <div className="container mx-auto px-4">
        <div className="text-center mb-8">
          <h2 className="text-4xl xl:text-6xl pb-2 leading-normal font-bold bg-gradient-to-r from-green-500 to-orange-600 bg-clip-text text-transparent">
            {t('watch_how_it_works')}
          </h2>
        </div>
        <div className="flex justify-center">
          <video
            src={`/storage/${videoUrl}`}
            controls
            autoPlay  // camelCase in React
            muted     // Required for autoplay to work
            loop      // Optional: loop the video
            playsInline // Required for iOS devices
            className="w-full max-w-6xl rounded-2xl shadow-2xl border border-neutral-200"
            preload="metadata"
          />
        </div>
      </div>
    </section>
  );
}
