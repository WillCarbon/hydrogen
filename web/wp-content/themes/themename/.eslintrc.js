module.exports = {
    env: {
        browser: true,
        es6: true,
    },
    root: true,
    parserOptions: {
        sourceType: 'module',
        allowImportExportEverywhere: true,
    },
    // https://github.com/feross/standard/blob/master/RULES.md#javascript-standard-style
    // extends: [
    //     'plugin:@wordpress/eslint-plugin/recommended-with-formatting',
    // ],
    // add your custom rules here
    rules: {
        'arrow-parens': 0,
        'generator-star-spacing': 0,
        'no-debugger': process.env.NODE_ENV === 'production' ? 2 : 0,
        'no-multi-spaces': 0,
        semi: 0,
        indent: [ 'error', 4 ],
        camelcase: 0,
        'no-unused-expressions': 0,
        'object-shorthand': 0,
        'no-unused-vars': 0,
    },
    globals: {
        $: true,
        jQuery: true,
    },
}
