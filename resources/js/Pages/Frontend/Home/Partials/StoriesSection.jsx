import React from 'react';
import { Link, usePage } from '@inertiajs/react';
import { useTrans } from '@/Hooks/useTrans';
import PrimaryButton from '@/Components/PrimaryButton';
import StoryCard from '@/Components/StoryCard';

const StoriesSection = ({ stories = [] }) => {
  const { t } = useTrans();
  const { locale } = usePage().props;

  const formatStoryData = () => {
    const result = [];

    stories.forEach(story => {
      if (locale === 'ar') {
        result.push({
          id: story.id,
          title: story.titleAr,
          miniDesc: story.miniDescAr,
          desc: story.descAr,
          pdf: story.pdfArUrl,
          images: story.imageArUrl,
          cover: story.coverArUrl,
        });
      } else {
        result.push({
          id: story.id,
          title: story.titleEn,
          miniDesc: story.miniDescEn,
          cover: story.coverArUrl,
        });
      }
    });

    return result;
  };

  return (
    <section
      className="relative overflow-hidden py-16 min-h-[calc(100dvh-4rem)] bg-white dark:bg-neutral-900"
      id="stories"
    >
      <div className="container mx-auto flex flex-col gap-10">
        <h2 className="text-4xl xl:text-6xl leading-normal font-bold bg-gradient-to-r from-neutral-700 to-orange-600 dark:from-neutral-300 dark:to-orange-400 bg-clip-text text-transparent w-fit mx-auto">
          {t('stories_title')}
        </h2>
        <div className="flex flex-col gap-6">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-8">
            {formatStoryData().map(({ id, title, miniDesc, cover }) => (
              <StoryCard key={id} story={{ id, cover, miniDesc, title }} />
            ))}
          </div>
          <PrimaryButton
            as={Link}
            // href={route('stories.index')}
            className="w-fit mx-auto bg-orange-100 text-orange-700 hover:bg-orange-200 dark:bg-orange-900 dark:text-orange-300 dark:hover:bg-orange-800"
          >
            {t('stories_more_stories')}
          </PrimaryButton>
        </div>
      </div>
    </section>
  );
};

export default StoriesSection;
