import React from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Autoplay, Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import { useTrans } from '@/Hooks/useTrans';

export default function CustomerFeedbackSection({ textFeedbacks, imageFeedbacks, videoFeedbacks }) {
  const { t } = useTrans();
  return (
    <section className="bg-neutral-50 py-14 px-5 sm:px-8 md:px-12 lg:px-20">
      <div className="max-w-7xl mx-auto space-y-12">
        {/* Text Feedbacks */}
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
                  <div key={`text-feedback-${feedback.id || index}`} className="bg-white border border-orange-100 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center">
                    <p className="text-gray-700 leading-relaxed text-base italic mb-4">
                      "{feedback.customer_feedback}"
                    </p>
                    <div className="flex justify-center">
                      {[...Array(5)].map((_, starIndex) => (
                        <i key={starIndex} className="fa-solid fa-star text-yellow-400 text-lg"></i>
                      ))}
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

        {/* Video Feedbacks Swiper */}
        {videoFeedbacks && videoFeedbacks.length > 0 && (
          <div >
            <h3 className="text-2xl font-bold text-center mb-6 text-gray-800">{t('customer_videos')}</h3>
            <div className="relative">
              <Swiper
                modules={[Navigation]}
                slidesPerView={1}
                spaceBetween={24}
                autoplay={false}
                loop
                navigation={{
                  nextEl: '.video-swiper-button-next',
                  prevEl: '.video-swiper-button-prev',
                }}
                breakpoints={{
                  640: { slidesPerView: 1 },
                  1024: { slidesPerView: 1 },
                }}
              >
                {videoFeedbacks.map((feedback, index) => (
                  <SwiperSlide key={`video-feedback-${feedback.id || index}`}>
                    <div className="flex flex-col h-full border border-orange-100 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                      <div className="h-auto overflow-hidden flex items-center justify-center">
                        <video
                          src={`/storage/${feedback.video}`}
                          controls
                          autoPlay  // camelCase in React
                          muted     // Required for autoplay to work
                          loop      // Optional: loop the video
                          playsInline // Required for iOS devices
                          className="w-full h-auto max-h-[600px] rounded-lg"
                          preload="metadata"
                        />
                      </div>
                    </div>
                  </SwiperSlide>
                ))}
              </Swiper>
              {/* Navigation buttons */}
              <button className="video-swiper-button-prev absolute left-2 md:left-4 top-1/2 -translate-y-1/2 z-10 bg-orange-500 hover:bg-orange-600 text-white rounded-full w-8 h-8 md:w-12 md:h-12 flex items-center justify-center shadow-lg transition-colors duration-200">
                <i className="fa-solid fa-chevron-left text-sm md:text-base"></i>
              </button>
              <button className="video-swiper-button-next absolute right-2 md:right-4 top-1/2 -translate-y-1/2 z-10 bg-orange-500 hover:bg-orange-600 text-white rounded-full w-8 h-8 md:w-12 md:h-12 flex items-center justify-center shadow-lg transition-colors duration-200">
                <i className="fa-solid fa-chevron-right text-sm md:text-base"></i>
              </button>
            </div>
          </div>
        )}
      </div>
    </section>
  );
}
