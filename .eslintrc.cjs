module.exports = {
    env: {
        browser: true,
        es2021: true,
    },
    extends: [
        'airbnb-base',
        'plugin:vue/vue3-essential',
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
    },
};
