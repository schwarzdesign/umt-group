/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "selector",
  content: [
    "site/plugins/nxttool-theme-tailwind/templates/**/*.php",
    "site/plugins/nxttool-theme-tailwind/snippets/**/*.php",
    "site/plugins/nxttool-theme-tailwind/controllers/**/*.php",
    "site/templates/**/*.php",
    "site/snippets/**/*.php",
    "site/controllers/**/*.php",
  ],
  safelist: [
    "basis-1/1",
    "basis-1/2",
    "basis-1/3",
    "basis-2/3",
    "basis-1/4",
    "btn-primary",
    "btn-secondary",
    {
      pattern: /col-span-(1|3|4|6|8|12)/,
      variants: ["md", "sm"],
    },
    {
      pattern: /grid-cols-(1|3|4|6|8|12)/,
      variants: ["md", "sm"],
    },
    {
      pattern: /columns-(1|3|4|6|8|12)/,
      variants: ["md", "sm"],
    },
    "lg:aspect-[16/9]",
    "lg:aspect-[16/7]",
    "lg:aspect-[16/5]",
    "lg:h-screen",
  ],
  theme: {
    extend: {
      colors: {
        primary: "rgb(var(--primary) / <alpha-value>)",
        primary_inverse: "rgb(var(--primary-inverse) / <alpha-value>)",
        text: "rgb(var(--text) / <alpha-value>)",
        text_inverse: "rgb(var(--text-inverse) / <alpha-value>)",
        muted: "rgb(var(--muted) / <alpha-value>)",
        muted_inverse: "rgb(var(--muted-inverse) / <alpha-value>)",
        borders: "rgb(var(--borders) / <alpha-value>)",
        borders_inverse: "rgb(var(--borders-inverse) / <alpha-value>)",
        footer: "rgb(var(--footer) / <alpha-value>)",
        background: "rgb(var(--background) / <alpha-value>)",
        background_inverse: "rgb(var(--background-inverse) / <alpha-value>)",
        background_muted: "rgb(var(--background-muted) / <alpha-value>)",
        background_muted_inverse: "rgb(var(--background-muted-inverse) / <alpha-value>)",
        success: "rgb(var(--success) / <alpha-value>)",
        info: "rgb(var(--info) / <alpha-value>)",
        warning: "rgb(var(--warning) / <alpha-value>)",
        error: "rgb(var(--error) / <alpha-value>)",
      },
      fontVariationSettings: {
        italic: '"slnt" -10',
      },
    },
  },
  plugins: [
    function ({ addUtilities }) {
      addUtilities(
        {
          ".italic": {
            "font-style": "normal",
            "font-variation-settings": '"slnt" -10',
          },
        },
        ["responsive", "hover"],
      );
    },
    require('@tailwindcss/forms'),
  ],
  corePlugins: {
    italic: false,
  },
};
