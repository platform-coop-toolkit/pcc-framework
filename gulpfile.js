const { src, dest, parallel } = require( 'gulp' );
const readme = require( 'gulp-readme-to-markdown' );

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

exports.readme = readmeToMarkdown;
exports.default = parallel( readmeToMarkdown );
