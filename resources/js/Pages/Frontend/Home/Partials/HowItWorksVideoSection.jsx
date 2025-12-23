// HowItWorksVideoSection.jsx
import React, { useRef, useState } from 'react';
import { useTrans } from '@/Hooks/useTrans';

export default function HowItWorksVideoSection({ videoUrl }) {
  const { t } = useTrans();
  const videoRef = useRef(null);
  const [isPlaying, setIsPlaying] = useState(true);

  // Detect RTL from document
  const isRtl = document.documentElement.dir === 'rtl';

  const togglePlayPause = (e) => {
    e.stopPropagation();
    if (videoRef.current) {
      if (isPlaying) {
        videoRef.current.pause();
      } else {
        videoRef.current.play();
      }
      setIsPlaying(!isPlaying);
    }
  };

  return (
    <section
      className="relative w-screen bg-neutral-900 cursor-pointer"
      style={{
        marginLeft: 'calc(-50vw + 50%)',
      }}
      onClick={togglePlayPause}
    >
      <video
        ref={videoRef}
        src={`/storage/${videoUrl}`}
        autoPlay
        muted
        loop
        playsInline
        preload="metadata"
        className="w-full h-auto max-h-screen object-contain"
      />

      {/* Custom Play/Pause Control */}
      <button
        onClick={togglePlayPause}
        className={`absolute bottom-8 z-20 bg-orange-500/20 hover:bg-orange-500/40 backdrop-blur-md border border-orange-400/50 hover:border-orange-400/80 text-white rounded-full w-14 h-14 md:w-16 md:h-16 flex items-center justify-center shadow-lg shadow-orange-500/20 transition-all duration-200 hover:scale-110 ${
          isRtl ? 'left-8' : 'right-8'
        }`}
        aria-label={isPlaying ? 'Pause video' : 'Play video'}
      >
        {isPlaying ? (
          <i className="fa-solid fa-pause text-xl md:text-2xl"></i>
        ) : (
          <i className="fa-solid fa-play text-xl md:text-2xl ms-1"></i>
        )}
      </button>
    </section>
  );
}
