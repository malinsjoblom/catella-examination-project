const strip = require('postcss-strip-inline-comments');
const postcssPresetEnv = require('postcss-preset-env');
const nano = require('cssnano');
const tailwind = require('tailwindcss');
module.exports = ctx => ({
	// parser: '',
	plugins: [
		require('postcss-easy-import')({
			extensions: ['.scss', '.css'],
			prefix: '_',
		}),
		tailwind,
		strip,
		postcssPresetEnv({}),
		nano,
	],
});
