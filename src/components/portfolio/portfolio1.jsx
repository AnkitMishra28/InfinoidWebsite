import React from "react";
import { useNavigation } from '../../utils/navigation';

const Portfolio = () => {
  const { navigateToContact } = useNavigation();

  return (
    <div className="relative min-h-screen flex flex-col items-center justify-center px-4 py-20 text-white">
      {/* Portfolio Content */}
      <div className="relative z-10 text-center max-w-4xl">
        <h1 className="text-5xl font-bold mb-6 bg-gradient-to-r from-purple-400 via-blue-400 to-pink-400 bg-clip-text text-transparent">
          Our Portfolio
        </h1>
        <p className="text-xl mb-8 text-gray-300">
          Discover our successful projects and innovative solutions that have transformed businesses.
        </p>

        {/* Our Clients Section */}
        <div className="mb-12">
          <h2 className="text-3xl font-bold mb-6 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
            Our Clients
          </h2>
          <p className="text-lg mb-8 text-gray-300">
            We've helped numerous clients achieve their digital transformation goals.
          </p>
          
          {/* Connect with Experts Button */}
          <button 
            onClick={navigateToContact}
            className="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-full bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:shadow-pink-400/30"
          >
            <span className="relative z-10 flex items-center gap-3">
              <span className="text-shadow">Connect with Experts</span>
            </span>
            <div className="absolute inset-0 rounded-full border-2 border-pink-400/30 animate-border-glow" />
          </button>
        </div>
      </div>

      {/* Animation Styles */}
      <style jsx global>{`
        @keyframes border-glow {
          0%, 100% { box-shadow: 0 0 10px rgba(236,72,153,0.3); }
          50% { box-shadow: 0 0 20px rgba(236,72,153,0.6); }
        }

        .animate-border-glow {
          animation: border-glow 1.5s ease-in-out infinite;
        }

        .text-shadow {
          text-shadow: 0 2px 10px rgba(236,72,153,0.4);
        }
      `}</style>
    </div>
  );
};

export default Portfolio; 