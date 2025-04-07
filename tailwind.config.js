  /** @type {import('tailwindcss').Config} */
  export default {
    content: [
      "./views/customer/**/*.{php,html,js}",
      "./views/admin/**/*.{php,html,js}",     
      "./partials/**/*.{php,html,js}",        
      "./*.{php,html,js}",                    
      'node_modules/preline/dist/*.js',
    ],
    
    theme: {
        extend: {
          keyframes: {
            blink: {
              '0%, 100%': { color: '#353535' }, 
              '50%': { color: '#F5F7EA' }, 
            },
            popin: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
            'pulse-scale': {
              '0%, 100%': { transform: 'scale(1)', opacity: '1' },
              '50%': { transform: 'scale(1.1)', opacity: '0.7' },
            },
          },
          animation: {
            popin: 'popin 1.5s linear infinite',
            blink: 'blink 1s infinite',
            'pulse-scale': 'pulse-scale 1.5s infinite',
          },
          fontFamily: {
            fredoka: ["Fredoka", "sans-serif"],
          },
          colors: {
            primary: {
              100: "#FFD19D",
              150: "#D6D7D2",
              200: "#947153",
              250: "#94938F",
              300: "#F15229",
              350: "#4A4743",
              400: "#C40817",
              500: "#8E1D22",
              550: "#710D0B",
              600: "#340307",
              950: "#191211",
            
            },
          }
        },
    },
    plugins: [
      require('@tailwindcss/forms'),
      require('preline/plugin'),
      require('tailwind-scrollbar-hide'),
    ],
}