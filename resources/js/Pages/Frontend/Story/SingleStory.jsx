import React from 'react';
import { Head, Link } from '@inertiajs/react';
import SiteLayout from '@/Layouts/SiteLayout/SiteLayout';
import { useTrans } from '@/Hooks/useTrans';

export default function SingleStory({ story }) {
  const { t } = useTrans();

  return (
    <SiteLayout>
      <Head title={story.title_value} />

      <div className="min-h-screen bg-neutral-50 py-12">
        <div className="container mx-auto px-4">
          {/* Back Button */}
          <Link
            href={route('stories')}
            className="inline-flex items-center gap-2 text-orange-600 hover:text-orange-700 font-semibold mb-6"
          >
            <i className="fa-solid fa-arrow-left rtl:rotate-180"></i>
            {t('back_to_stories')}
          </Link>

          <div className="bg-white rounded-xl shadow-lg overflow-hidden">
            {/* Hero Section with Cover */}
            <div className="relative bg-gradient-to-br from-orange-200 to-green-200">
              <img
                src={story.cover_image_value || 'https://placehold.co/1200x600.png'}
                alt={story.title_value}
                className="w-full h-full object-cover"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

              {/* Title Overlay */}
              <div className="absolute bottom-0 left-0 right-0 p-8 text-white">
                <h1 className="text-4xl md:text-5xl font-bold mb-2">
                  {story.title_value}
                </h1>

                {/* Metadata */}
                <div className="flex flex-wrap items-center gap-4 text-sm">
                  {story.category && (
                    <span className="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                      <i className="fa-solid fa-tag"></i>
                      {story.category.name_value}
                    </span>
                  )}
                  {story.gender !== null && (
                    <span className="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                      <i className="fa-solid fa-venus-mars"></i>
                      {story.gender_text}
                    </span>
                  )}
                </div>
              </div>
            </div>

            {/* Content Section */}
            <div className="p-8 md:p-12">
              {/* Story Content */}
              <div className="prose prose-lg max-w-none mb-8">
                <div className="text-neutral-700 leading-relaxed whitespace-pre-wrap">
                  {story.content_value}
                </div>
              </div>

              {/* Download PDF Buttons */}
              {(story.pdf_ar || story.pdf_en) && (
                <div className="border-t border-neutral-200 pt-8 mb-8">
                  <h3 className="text-2xl font-bold text-neutral-800 mb-4">
                    {t('download_pdf')}
                  </h3>
                  <div className="flex flex-wrap gap-4">
                    {story.pdf_ar && (
                      <a
                        href={story.pdf_ar}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="inline-flex items-center gap-2 px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg transition-colors"
                      >
                        <i className="fa-solid fa-file-pdf"></i>
                        PDF (العربية)
                      </a>
                    )}
                    {story.pdf_en && (
                      <a
                        href={story.pdf_en}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="inline-flex items-center gap-2 px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition-colors"
                      >
                        <i className="fa-solid fa-file-pdf"></i>
                        PDF (English)
                      </a>
                    )}
                  </div>
                </div>
              )}

              {/* Gallery Section */}
              {story.gallery_images_value && story.gallery_images_value.length > 0 && (
                <div className="border-t border-neutral-200 pt-8">
                  <h3 className="text-2xl font-bold text-neutral-800 mb-6">
                    {t('gallery')}
                  </h3>
                  <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    {story.gallery_images_value.map((image, index) => (
                      <div
                        key={index}
                        className="aspect-square rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow no-tailwindcss-support-display"
                      >
                        <img
                          src={image}
                          alt={`${story.title_value} - ${index + 1}`}
                          className="w-full h-full object-cover hover:scale-110 transition-transform duration-300"
                        />
                      </div>
                    ))}
                  </div>
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </SiteLayout>
  );
}
