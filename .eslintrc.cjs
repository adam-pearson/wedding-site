module.exports = {
    env: {
        browser: true,
        es2021: true,
    },
    extends: [
        'airbnb-base',
        'plugin:vue/vue3-essential',
        'plugin:vue/vue3-strongly-recommended',
        'plugin:tailwindcss/recommended',
    ],
    overrides: [
        {
            env: {
                node: true,
            },
            files: [
                '.eslintrc.{js,cjs}',
            ],
            parserOptions: {
                sourceType: 'script',
            },
        },
    ],
    parserOptions: {
        ecmaVersion: 'latest',
        sourceType: 'module',
    },
    plugins: [
        'vue',
        '@stylistic/js',
    ],
    rules: {
        indent: ['error', 4],
        'vue/multi-word-component-names': 'off',
        'import/no-extraneous-dependencies': 'off',
        'import/no-unresolved': 'off',
        'vue/max-attributes-per-line': 1,
        'vue/first-attribute-linebreak': ['error', {
            singleline: 'ignore',
            multiline: 'below',
        }],
        'vue/block-tag-newline': ['error', {
            singleline: 'consistent',
            multiline: 'consistent',
            maxEmptyLines: 0,
            blocks: {
                template: {
                    singleline: 'always',
                    multiline: 'always',
                    maxEmptyLines: 0,
                },
            },
        }],
        'tailwindcss/no-custom-classname': 'off',
    },
};
