const { src, dest, parallel } = require( 'gulp' );
const autoprefixer = require( 'autoprefixer' );
const cssnano = require( 'cssnano' );
const postcss = require( 'gulp-postcss' );
const readme = require( 'gulp-readme-to-markdown' );

function css() {
	const plugins = [
		autoprefixer(),
		cssnano(),
	];
	return src( './src/*.css' )
		.pipe( postcss( plugins ) )
		.pipe( dest( './build' ) );
}

function readmeToMarkdown() {
	return src( [ 'readme.txt' ] )
		.pipe( readme( {
			details: false,
			screenshot_ext: [ 'jpg', 'jpg', 'png' ],
			extract: {
				changelog: 'CHANGELOG',
				'Frequently Asked Questions': 'FAQ',
			},
		} ) )
		.pipe( dest( '.' ) );
}

exports.css = css;
exports.readme = readmeToMarkdown;
exports.default = parallel( css );
