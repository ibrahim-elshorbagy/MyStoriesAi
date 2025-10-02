import React, { useState, useRef, useEffect } from 'react';

const HeroVideo = () => {
  const [isLoaded, setIsLoaded] = useState(false);
  const [hasError, setHasError] = useState(false);
  const videoRef = useRef(null);

  useEffect(() => {
    const video = videoRef.current;
    if (video) {
      const attemptPlay = async () => {
        try {
          video.load();
          await video.play();
          setIsLoaded(true);
        } catch (error) {
          console.log("Autoplay prevented or video failed:", error);
          setIsLoaded(true);
        }
      };

      const timer = setTimeout(attemptPlay, 100);
      return () => clearTimeout(timer);
    }
  }, []);

  const handleVideoLoad = () => {
    setIsLoaded(true);
  };

  const handleVideoError = () => {
    console.log("Video failed to load");
    setHasError(true);
    setIsLoaded(true);
  };

  const handleCanPlay = () => {
    setIsLoaded(true);
    if (videoRef.current) {
      videoRef.current.play().catch(() => {
        console.log("Final play attempt failed");
      });
    }
  };

  return (
    <div className="relative group">
      {/* Loading Skeleton */}
      {!isLoaded && (
        <div className="absolute inset-0 bg-gradient-to-br from-neutral-100/50 to-neutral-200/30 dark:from-neutral-800/50 dark:to-neutral-700/30 rounded-xl lg:rounded-none animate-pulse flex items-center justify-center z-10">
          <div className="w-12 h-12 border-4 border-orange-500/30 border-t-orange-500 rounded-full animate-spin"></div>
        </div>
      )}

      {/* Decorative Elements */}
      <div className="absolute -inset-4 bg-gradient-to-r from-orange-500/20 via-orange-400/20 to-orange-500/20 rounded-2xl blur-lg opacity-60 group-hover:opacity-80 transition-opacity duration-500" />
      <div className="absolute -inset-2 bg-gradient-to-r from-orange-500/30 to-orange-400/30 rounded-xl blur-md opacity-40 transition-opacity duration-300" />

      {/* Main Video Container */}
      <div className="relative bg-white/95 lg:bg-transparent dark:bg-neutral-800/95 lg:dark:bg-transparent backdrop-blur-sm lg:backdrop-blur-none rounded-xl lg:rounded-none p-3 lg:p-0 border border-neutral-200/50 lg:border-0 dark:border-neutral-700/50 shadow-2xl">
        {!hasError ? (
          <video
            ref={videoRef}
            src="assets/home/intro.mp4"
            autoPlay
            loop
            muted
            playsInline
            disablePictureInPicture
            controlsList="nodownload nofullscreen noremoteplayback"
            preload="auto"
            className={`max-w-[500px] lg:max-w-full w-full h-auto lg:w-auto lg:!min-h-full rounded-lg lg:rounded-none object-cover shadow-lg
                       transition-all duration-500 ease-out
                       ${isLoaded
                         ? "opacity-100 hover:scale-[1.02]"
                         : "opacity-0"
                       }`}
            style={{
              pointerEvents: "none",
              userSelect: "none",
              WebkitUserSelect: "none",
              msUserSelect: "none",
            }}
            onLoadedData={handleVideoLoad}
            onCanPlay={handleCanPlay}
            onCanPlayThrough={handleVideoLoad}
            onError={handleVideoError}
            onContextMenu={(e) => e.preventDefault()}
            onDoubleClick={(e) => e.preventDefault()}
          />
        ) : (
          <div className="max-w-[400px] w-full h-[300px] rounded-lg lg:rounded-none bg-gradient-to-br from-orange-500/10 to-orange-400/10 flex items-center justify-center">
            <div className="text-center">
              <div className="w-20 h-20 mx-auto mb-4 rounded-2xl bg-orange-500/20 flex items-center justify-center">
                <i className="fa-solid fa-play text-4xl text-orange-500"></i>
              </div>
              <p className="text-neutral-700 dark:text-neutral-300 font-semibold">Hero Content</p>
              <p className="text-sm text-neutral-500 dark:text-neutral-400">Video placeholder</p>
            </div>
          </div>
        )}

        {/* Overlay to prevent interactions */}
        <div className="absolute inset-3 rounded-lg pointer-events-none select-none" />
      </div>
    </div>
  );
};

export default HeroVideo;
