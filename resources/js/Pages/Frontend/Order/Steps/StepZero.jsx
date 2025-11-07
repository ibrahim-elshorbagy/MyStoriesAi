import React, { useState } from 'react';
import { Client } from '@gradio/client';
import InputError from '@/Components/InputError';

export default function StepZero({
  story,
  data,
  setData,
  errors,
  imageFile,
  setImageFile,
  imagePreview,
  setImagePreview,
  onNext,
  t
}) {
  const [processing, setProcessing] = useState(false);
  const [swappedImageUrl, setSwappedImageUrl] = useState(null);
  const [swapError, setSwapError] = useState(null);
  const [imageError, setImageError] = useState(null);
  const [progress, setProgress] = useState(0);

  const getCoverImage = () => {
    if (!story) return null;
    return data.language === 'arabic' ? story.cover_image_ar : story.cover_image_en;
  };

  const coverImagePath = getCoverImage();
  const coverImageUrl = coverImagePath ? `/storage/${coverImagePath}` : null;

  const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      if (!['image/jpeg', 'image/png'].includes(file.type)) {
        setImageError(t('invalid_image_format') || 'Invalid format. Only JPG and PNG allowed.');
        return;
      }

      const img = new Image();
      img.onload = () => {
        if (img.naturalWidth < 400 || img.naturalHeight < 400) {
          setImageError(t('image_too_small') || 'Image too small. Minimum 400x400 pixels.');
          return;
        }
        if (img.naturalWidth > 6000 || img.naturalHeight > 6000) {
          setImageError(t('image_too_large') || 'Image too large. Maximum 6000x6000 pixels.');
          return;
        }

        setImageFile(file);
        setData('child_image', file);
        const reader = new FileReader();
        reader.onloadend = () => {
          setImagePreview(reader.result);
        };
        reader.readAsDataURL(file);
        setSwappedImageUrl(null);
        setImageError(null);
      };
      img.src = URL.createObjectURL(file);
    }
  };

  const handleFaceSwap = async () => {
    if (!imageFile) {
      setSwapError(t('please_upload_child_image') || 'Please upload child image first');
      return;
    }

    if (!coverImageUrl) {
      setSwapError(t('no_cover_image'));
      return;
    }

    setProcessing(true);
    setSwapError(null);
    setProgress(0);

    try {
      // Realistic progress simulation for ~3 minute (180 second) task
      const progressStages = [
        { progress: 5, duration: 3000 },    // Preparing: 0-5% in 3s
        { progress: 10, duration: 3000 },   // Uploading: 5-10% in 3s
        { progress: 20, duration: 10000 },  // Detecting faces: 10-20% in 10s
        { progress: 35, duration: 15000 },  // Face swapping: 20-35% in 15s
        { progress: 50, duration: 20000 },  // Processing: 35-50% in 20s
        { progress: 65, duration: 20000 },  // Enhancing (GFPGAN): 50-65% in 20s
        { progress: 80, duration: 20000 },  // Upscaling (RealESRGAN): 65-80% in 20s
        { progress: 95, duration: 15000 },  // Finalizing: 80-95% in 15s
      ];

      let currentStageIndex = 0;
      let progressInterval;

      const advanceProgress = () => {
        if (currentStageIndex >= progressStages.length) {
          clearInterval(progressInterval);
          return;
        }

        const stage = progressStages[currentStageIndex];
        const startProgress = currentStageIndex === 0 ? 0 : progressStages[currentStageIndex - 1].progress;
        const endProgress = stage.progress;
        const steps = Math.ceil(stage.duration / 200);
        const increment = (endProgress - startProgress) / steps;
        let stepCount = 0;

        progressInterval = setInterval(() => {
          stepCount++;
          setProgress(prev => {
            const newProgress = Math.min(startProgress + (increment * stepCount), endProgress);
            if (newProgress >= endProgress) {
              clearInterval(progressInterval);
              currentStageIndex++;
              if (currentStageIndex < progressStages.length) {
                setTimeout(advanceProgress, 100);
              }
            }
            return Math.round(newProgress);
          });
        }, 200);
      };

      advanceProgress();

      const coverResponse = await fetch(coverImageUrl);
      const coverBlob = await coverResponse.blob();
      const childImageBlob = imageFile instanceof Blob ? imageFile : await fetch(imagePreview).then(r => r.blob());

      const client = await Client.connect("yusiff/face-swap");
      const result = await client.predict("/predict", {
        source_img: childImageBlob,
        target_img: coverBlob,
      });

      // Complete progress
      if (progressInterval) clearInterval(progressInterval);
      setProgress(100);

      console.log('Full result:', result);

      if (result && result.data) {
        let imageUrl;
        if (Array.isArray(result.data)) {
          imageUrl = result.data[0]?.url || result.data[0];
        } else if (typeof result.data === 'object') {
          imageUrl = result.data.url || result.data;
        } else {
          imageUrl = result.data;
        }

        console.log('Extracted image URL:', imageUrl);
        setSwappedImageUrl(imageUrl);
        setData('face_swap_result', imageUrl);
      } else {
        throw new Error('No result from face swap API');
      }
    } catch (error) {
      console.error('Face swap error:', error);
      setSwapError(t('face_swap_failed'));
    } finally {
      setProcessing(false);
      setTimeout(() => setProgress(0), 1000);
    }
  };


  const handleConfirmAndNext = () => {
    if (!swappedImageUrl) {
      setSwapError(t('please_generate_preview'));
      return;
    }
    onNext();
  };

  return (
    <div className="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-white/20">
      <h2 className="text-2xl font-semibold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-6 py-4">
        {t('customize_story_cover')}
      </h2>

      <div className='flex justify-center items-center mb-6'>
        <div className='w-96'>
          <img className="object-contain w-full h-full" src="/assets/createOrder/conditions.png" alt="" />
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        {/* Upload Child Image */}
        <div>
          <label className="block text-sm font-medium text-neutral-700 mb-2">
            {t('child_image')} *
          </label>
          <div className="border-2 border-dashed border-neutral-300 rounded-lg p-6 text-center">
            {imagePreview ? (
              <div className="space-y-4">
                <img
                  src={imagePreview}
                  alt="Child preview"
                  className="max-w-full h-48 object-cover rounded-lg mx-auto"
                />
                <button
                  type="button"
                  onClick={() => {
                    setImagePreview(null);
                    setImageFile(null);
                    setSwappedImageUrl(null);
                    setImageError(null);
                  }}
                  className="text-red-600 hover:text-red-800 text-sm"
                >
                  {t('remove')}
                </button>
              </div>
            ) : (
              <div>
                <div className="text-neutral-500 mb-4">
                  <i className="fa-solid fa-cloud-arrow-up text-4xl"></i>
                </div>
                <p className="text-neutral-600 mb-2">{t('upload_child_image')}</p>
                <input
                  type="file"
                  accept="image/jpeg,image/png"
                  onChange={handleImageChange}
                  className="hidden"
                  id="child_image_step_zero"
                />
                <label
                  htmlFor="child_image_step_zero"
                  className="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 cursor-pointer transition-colors"
                >
                  <i className="fa-solid fa-plus mx-2"></i>
                  {t('choose_file')}
                </label>
              </div>
            )}
          </div>
          <InputError message={errors.child_image} className="mt-2" />
          <InputError message={imageError} className="mt-2" />
        </div>

        {/* Original Story Cover */}
        <div>
          <label className="block text-sm font-medium text-neutral-700 mb-2">
            {t('story_cover')}
          </label>
          <div className="border-2 border-neutral-300 rounded-lg p-4">
            {coverImageUrl ? (
              <img
                src={coverImageUrl}
                alt={story?.title_value || 'Story cover'}
                className="max-w-full h-64 object-cover rounded-lg mx-auto"
              />
            ) : (
              <div className="h-64 flex items-center justify-center text-neutral-400">
                <div className="text-center">
                  <i className="fa-solid fa-image text-6xl mb-2"></i>
                  <p>{t('no_cover_available')}</p>
                </div>
              </div>
            )}
          </div>
        </div>
      </div>

      {/* Generate Preview Button */}
      <div className="mb-8 text-center">
        <button
          type="button"
          onClick={handleFaceSwap}
          disabled={processing || !imageFile}
          className="px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold rounded-2xl hover:from-purple-600 hover:to-pink-600 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
        >
          {processing ? (
            <span className="flex items-center gap-3">
              <i className="fa-solid fa-spinner fa-spin"></i>
              {t('processing')}
            </span>
          ) : (
            <span className="flex items-center gap-3">
              <i className="fa-solid fa-wand-magic-sparkles"></i>
              {t('generate_preview')}
            </span>
          )}
        </button>

        {/* Progress Bar */}
        {processing && (
          <div className="mt-6">
            <div className="w-full bg-neutral-200 rounded-full h-4 overflow-hidden">
              <div
                className="h-full bg-gradient-to-r from-purple-500 to-pink-500 transition-all duration-300 ease-out flex items-center justify-center text-white text-xs font-bold"
                style={{ width: `${progress}%` }}
              >
                {progress}%
              </div>
            </div>
            <p className="text-sm text-neutral-600 mt-2">
              {progress < 15 && (t('uploading_images'))}
              {progress >= 15 && progress < 25 && (t('analyzing_images'))}
              {progress >= 25 && progress < 48 && (t('detecting_faces'))}
              {progress >= 48 && progress < 68 && (t('processing_swap'))}
              {progress >= 68 && progress < 85 && (t('blending_result'))}
              {progress >= 85 && progress < 95 && (t('finalizing'))}
              {progress >= 95 && (t('almost_done'))}
            </p>
          </div>
        )}

        {swapError && (
          <div className="mt-4 text-red-600 font-medium">
            {swapError}
          </div>
        )}
      </div>

      {/* Result Preview */}
      {swappedImageUrl && (
        <div className="mb-8">
          <h3 className="text-xl font-semibold text-neutral-900 mb-4 flex items-center">
            <i className="fa-solid fa-sparkles text-yellow-500 mx-2"></i>
            {t('preview_result')}
          </h3>
          <div className="border-4 border-green-200 rounded-2xl p-6 bg-gradient-to-br from-green-50 to-blue-50">
            <img
              src={swappedImageUrl}
              alt="Face swap result"
              className="max-w-full h-auto rounded-lg mx-auto shadow-xl"
            />
          </div>
          <div className="mt-4 text-center">
            <p className="text-neutral-600 mb-4">
              {t('satisfied_with_result')}
            </p>
            <div className="flex justify-center gap-4">
              <button
                type="button"
                onClick={() => {
                  setSwappedImageUrl(null);
                  setSwapError(null);
                }}
                className="px-6 py-2 border-2 border-orange-500 text-orange-600 font-semibold rounded-lg hover:bg-orange-50 transition-colors"
              >
                <i className="fa-solid fa-rotate-right mx-2"></i>
                {t('try_again')}
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Navigation Buttons */}
      <div className="flex justify-end">
        <button
          type="button"
          onClick={handleConfirmAndNext}
          disabled={!swappedImageUrl}
          className="px-10 py-4 bg-gradient-to-r from-orange-500 via-pink-500 to-purple-600 text-white font-bold rounded-2xl hover:from-orange-600 hover:via-pink-600 hover:to-purple-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
        >
          <span className="flex items-center gap-3 rtl:flex-row-reverse">
            {t('confirm_and_continue')}
            <i className="fa-solid fa-arrow-right rtl:fa-arrow-left"></i>
          </span>
        </button>
      </div>
    </div>
  );
}
