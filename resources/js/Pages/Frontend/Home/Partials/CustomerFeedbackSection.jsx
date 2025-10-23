import React from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Autoplay } from 'swiper/modules';
import 'swiper/css';

export default function CustomerFeedbackSection({ feedbacks }) {
  return (
    <section className="bg-neutral-50 py-14 px-5 sm:px-8 md:px-12 lg:px-20">
      <div className="max-w-7xl mx-auto">
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
          {feedbacks.map((feedback, index) => (
            <SwiperSlide key={`feedback-${feedback.id || index}`}>
              <div
                className={`flex flex-col h-full bg-white border border-orange-100 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden ${!feedback.image && !feedback.customer_feedback
                    ? 'opacity-70'
                    : ''
                  }`}
              >
                {/* Image Section */}
                {feedback.image && (
                  <div className="h-60 overflow-hidden">
                    <img
                      src={`/storage/${feedback.image}`}
                      alt="Customer feedback"
                      className="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                    />
                  </div>
                )}

                {/* Text Section */}
                {feedback.customer_feedback && (
                  <div className="flex flex-col flex-grow justify-center p-6 text-center min-h-60">

                    <p className="text-gray-700 leading-relaxed text-base italic">
                      “{feedback.customer_feedback}”
                    </p>
                  </div>
                )}

              </div>
            </SwiperSlide>
          ))}
        </Swiper>
      </div>
    </section>
  );
}
