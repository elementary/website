// Migrated from eslint-config-standard (deprecated)
// Now uses maintained packages with equivalent rules
import prettier from "eslint-config-prettier";
import importX from "eslint-plugin-import-x";
import n from "eslint-plugin-n";
import promise from "eslint-plugin-promise";
import globals from "globals";

export default [
  {
    languageOptions: {
      ecmaVersion: 2024,
      sourceType: "module",
      globals: {
        ...globals.browser,
        ...globals.node,
        ...globals.jquery,
      },
    },
    plugins: {
      "import-x": importX,
      n,
      promise,
    },
    rules: {
      // Import rules (standard's style)
      "import-x/order": [
        "error",
        {
          groups: ["builtin", "external", "internal", "parent", "sibling", "index"],
          alphabetize: { order: "asc" },
        },
      ],

      // Node rules
      "n/no-extraneous-require": "error",
      "n/hashbang": "off",

      // Promise rules
      "promise/catch-or-return": "error",
      "promise/no-nesting": "warn",
    },
  },
  prettier,
];
