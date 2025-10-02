import React from 'react';
import { Link } from '@inertiajs/react';
import { useTrans } from '@/Hooks/useTrans';
import ActionButton from '@/Components/ActionButton';

const StoryCard = ({ story }) => {
  const { t } = useTrans();
  const { cover, miniDesc, title, id } = story;

  return (
    <div className="flex flex-col border-2 border-orange-500 bg-white dark:bg-neutral-800 overflow-hidden shadow-sm hover:shadow-md duration-300 rounded-md min-h-[500px] max-w-[350px] h-full">
      <div className="flex !min-w-full min-h-fit overflow-hidden">
        <img
          src={cover || "https://placehold.co/595x842.png"}
          alt={title || 'Story cover'}
          className="w-full object-cover aspect-[297/421]"
          loading="lazy"
        />
      </div>
      <div className="flex flex-col gap-2 p-3 sm:p-4 !h-full">
        <p className="text-lg sm:text-xl font-medium text-neutral-800 dark:text-neutral-200">
          {title}
        </p>
        <p className="text-sm sm:text-base text-neutral-600 dark:text-neutral-400">
          {miniDesc?.replaceAll('"', "")}
        </p>
        <ActionButton
          as={Link}
          href={route('stories.show', id)}
          variant="outline"
          size="sm"
          className="self-end w-fit mt-auto border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white"
        >
          {t('general.stories_read_more')}
        </ActionButton>
      </div>
    </div>
  );
};

export default StoryCard;
