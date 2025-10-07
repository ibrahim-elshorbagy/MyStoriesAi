import React from "react";
import { useTrans } from "@/Hooks/useTrans";
import { Link } from "@inertiajs/react";

const PRICING = [
  {
    key: "pdf",
    title: "pricing_pdf_title",
    price: "pricing_pdf_price",
    desc: "pricing_pdf_desc",
    btn: "pricing_pdf_btn",
    features: [
      "plan_1_feature_1",
      "plan_1_feature_2",
      "plan_1_feature_3",
    ],
    cardClass: "border border-gray-200 bg-white",
    btnClass: "bg-gray-400 hover:bg-gray-500 text-white",
  },
  {
    key: "softcover",
    title: "pricing_soft_title",
    price: "pricing_soft_price",
    desc: "pricing_soft_desc",
    btn: "pricing_soft_btn",
    features: [
      "plan_2_feature_1",
      "plan_2_feature_2",
      "plan_2_feature_3",
      "plan_2_feature_4",
    ],
    cardClass: "border-2 border-teal-300 bg-gradient-to-b from-blue-50 via-purple-50 to-white relative shadow-2xl scale-105 z-10",
    btnClass: "bg-gradient-to-r from-teal-400 to-purple-500 hover:from-teal-500 hover:to-purple-600 text-white font-bold shadow-lg",
    badge: true,
  },
  {
    key: "hardcover",
    title: "pricing_hard_title",
    price: "pricing_hard_price",
    desc: "pricing_hard_desc",
    btn: "pricing_hard_btn",
    features: [
      "plan_3_feature_1",
      "plan_3_feature_2",
      "plan_3_feature_3",
      "plan_3_feature_4",
    ],
    cardClass: "border border-yellow-200 bg-gradient-to-b from-yellow-50 to-white",
    btnClass: "bg-gradient-to-r from-yellow-400 to-blue-700 hover:from-yellow-500 hover:to-blue-800 text-white",
  },
];

export default function PricingSection() {
  const { t } = useTrans();

  return (
    <>
      <section
        id="pricing"
        className="relative flex flex-col md:flex-row flex-wrap items-center justify-between px-8 pt-20 pb-20 bg-gradient-to-r from-emerald-100 to-amber-50"
      >
        {/* Separator line horizontally rotated at the top of pricing */}
        <div className="absolute -top-8 left-0 w-full h-16 pointer-events-none z-40">
          <div
            className="w-full h-full bg-gradient-to-r from-emerald-100 to-amber-50"
            style={{
              WebkitMaskImage: "url('assets/h-light-green-diamond.svg')",
              maskImage: "url('assets/h-light-green-diamond.svg')",
              WebkitMaskRepeat: "repeat",
              maskRepeat: "repeat",
              WebkitMaskPosition: "center",
              maskPosition: "center",
              WebkitMaskSize: "contain",
              maskSize: "contain",
            }}
          />
        </div>

        <div className="max-w-lg flex flex-col space-y-8 flex-1 relative">
          {/* Floating particles */}
          <div className="absolute top-0 ltr:left-0 rtl:right-0 animate-float opacity-80">
            <i className="fa-solid fa-star text-yellow-300 text-3xl drop-shadow-lg"></i>
          </div>

          <div className="absolute -top-6 ltr:right-8 rtl:left-8 animate-float-delay-1 opacity-85">
            <i className="fa-solid fa-crown ltr:text-white rtl:text-green-500 text-2xl drop-shadow-lg"></i>
          </div>

          <div className="absolute top-16 ltr:left-10 rtl:right-10 animate-float-delay-2 opacity-90">
            <i className="fa-solid fa-gem text-blue-200 text-3xl drop-shadow-lg"></i>
          </div>

          <div className="absolute bottom-0 ltr:right-16 rtl:left-16 animate-float opacity-80">
            <i className="fa-solid fa-lightbulb text-yellow-200 text-2xl drop-shadow-lg"></i>
          </div>

          {/* Heading */}
          <h2 className="text-2xl sm:text-3xl md:text-6xl font-extrabold text-gray-900 leading-snug relative z-10 text-center rtl:text-right ltr:text-left">
            {t("personalize_your_story_now")} <br />
            <span className="text-emerald-600 text-base sm:text-lg md:text-3xl">
              {t("make_your_child_the_hero")}
            </span>
          </h2>

          <div className="flex max-md:items-center max-md:justify-center">
            <Link
              size="large"
              as={Link}
              className="px-6 w-fit py-4 mt-4 text-lg sm:text-xl font-bold bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-400 hover:to-orange-500 text-white shadow-2xl shadow-orange-900/50 hover:shadow-orange-800/60 transform hover:scale-105 transition-all duration-300 rounded-md border-2 border-orange-300/30 backdrop-blur-sm"
            >
              {t("explore_our_stories")}
            </Link>
          </div>
        </div>

        <div className="mt-10 md:mt-0">
          <img
            src="assets/auth/logo.png"
            alt="Storybook Preview"
            className="w-48 sm:w-64 lg:w-[400px] drop-shadow-2xl rounded-xl"
          />
        </div>
      </section>

      <section className="py-20 px-4 bg-white">
        <h2 className="text-2xl sm:text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900">
          {t("pricing_section_title")}
        </h2>
        <div className="grid lg:grid-cols-3 sm:p-8 gap-8 max-w-7xl mx-auto">
          {PRICING.map((pkg) => (
            <div
              key={pkg.key}
              className={`rounded-2xl shadow-lg hover:scale-105 transition flex flex-col ${pkg.cardClass} relative h-full`}
            >
              {pkg.badge && (
                <span className="absolute top-4 right-4 px-3 py-1 rounded-full bg-purple-500 text-white font-bold text-xs shadow-lg flex items-center">
                  <i className="fa-solid fa-star mr-2 text-yellow-300"></i>
                  {t("pricing_most_popular")}
                </span>
              )}
              <div className="flex flex-col flex-1 items-center p-8 text-center space-y-4">
                <div className="flex-1 flex flex-col justify-start w-full min-h-[280px] pt-8">
                  <h4 className="text-lg sm:text-xl font-bold text-emerald-600">{t(pkg.title)}</h4>
                  <p className="text-2xl sm:text-3xl font-extrabold text-gray-900">{t(pkg.price)}</p>
                  <p className="text-sm sm:text-base text-gray-600">{t(pkg.desc)}</p>
                  <ul className="mt-4 text-gray-700 list-disc list-inside space-y-1 ltr:text-left rtl:text-right text-xs sm:text-sm">
                    {pkg.features.map((featKey) => (
                      <li key={featKey}>{t(featKey)}</li>
                    ))}
                  </ul>
                </div>
                <Link
                  className={`rounded-full px-6 py-2 font-semibold transition ${pkg.btnClass} w-full mt-auto text-sm sm:text-base`}
                >
                  {t(pkg.btn)}
                </Link>
              </div>
            </div>
          ))}
        </div>
      </section>
    </>
  );
}
