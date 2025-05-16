import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import lineClamp from '@tailwindcss/line-clamp';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                inter: ["Inter", "sans-serif"],
            },
            colors: {
                prussian: "#0A3B59",
                cornflower: "#0F8DBF",
                fluorescent: "#1DDDF2",
                orioles: "#F2490C",
                barn: "#730C02",
            },
            keyframes: {
                fadeInUp: {
                    "0%": { opacity: "0", transform: "translateY(20px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
                bounceModal: {
                    "0%, 100%": { transform: "translateY(0)" },
                    "50%": { transform: "translateY(-10px)" },
                },
            },
            animation: {
                fadeInUp: "fadeInUp 0.8s ease-out both",
                bounce: "bounceModal 0.4s ease",
            },
        },
    },

    plugins: [forms, lineClamp],
};
