/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      keyframes: {
        fancyText: {
          '0%, 100%': { transform: 'scale(1) rotate(0deg)', opacity: '1' },
          '25%': { transform: 'scale(1.2) rotate(5deg)', opacity: '0.8' },
          '50%': { transform: 'scale(1.4) rotate(-5deg)', opacity: '0.6' },
          '75%': { transform: 'scale(1.2) rotate(5deg)', opacity: '0.8' },
        },
        slideIn: {
          '0%': { transform: 'translateX(-100%)', opacity: '0' },
          '100%': { transform: 'translateX(0)', opacity: '1' },
        },
        slideInOut: {
          '0%': { transform: 'translateX(-100%)', opacity: '0' },
          '50%': { transform: 'translateX(0)', opacity: '1' },
          '100%': { transform: 'translateX(100%)', opacity: '0' },
        },
      },
      animation: {
        fancyText: 'fancyText 3s ease-in-out infinite',
        slideIn: 'slideIn 0.5s ease-out forwards',
        slideInOut: 'slideInOut 3s ease-in-out infinite',
      },
    },
  },
  plugins: [],
}