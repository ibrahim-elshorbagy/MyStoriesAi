import React from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Autoplay } from 'swiper/modules';
import 'swiper/css';
import { useTrans } from '@/Hooks/useTrans';

export default function CustomerFeedbackSection({ textFeedbacks, imageFeedbacks }) {
  const { t } = useTrans();
  return (
    <section className="bg-neutral-50 py-14 px-5 sm:px-8 md:px-12 lg:px-20">
      <div className="max-w-7xl mx-auto space-y-12">
        {/* Text Feedbacks Swiper */}
        {textFeedbacks && textFeedbacks.length > 0 && (
          <div>
            <h3 className="text-2xl font-bold text-center mb-6 text-gray-800">{t('customer_testimonials')}</h3>
            <Swiper
              modules={[Autoplay]}
              slidesPerView={1}
              spaceBetween={24}
              loop
              autoplay={{ delay: 4000, disableOnInteraction: false }}
              breakpoints={{
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
              }}
            >
              {textFeedbacks.map((feedback, index) => (
                <SwiperSlide key={`text-feedback-${feedback.id || index}`}>
                  <div className="flex flex-col h-full bg-white border border-orange-100 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                    <div className="flex flex-col flex-grow justify-center p-6 text-center min-h-60">
                      <p className="text-gray-700 leading-relaxed text-base italic">
                        "{feedback.customer_feedback}"
                      </p>
                    </div>
                  </div>
                </SwiperSlide>
              ))}
            </Swiper>
          </div>
        )}

        {/* Image Feedbacks Swiper */}
        {imageFeedbacks && imageFeedbacks.length > 0 && (
          <div>
            <h3 className="text-2xl font-bold text-center mb-6 text-gray-800">{t('customer_images')}</h3>
            <Swiper
              modules={[Autoplay]}
              slidesPerView={1}
              spaceBetween={24}
              loop
              autoplay={{ delay: 4000, disableOnInteraction: false }}
              breakpoints={{
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
              }}
            >
              {imageFeedbacks.map((feedback, index) => (
                <SwiperSlide key={`image-feedback-${feedback.id || index}`}>
                  <div className="flex flex-col h-full bg-white border border-orange-100 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                    <div className="h-60 overflow-hidden">
                      <img
                        src={`/storage/${feedback.image}`}
                        alt="Customer feedback"
                        className="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                      />
                    </div>
                  </div>
                </SwiperSlide>
              ))}
            </Swiper>
          </div>
        )}
      </div>
    </section>
  );
}
