module.exports = {
	globDirectory: 'public/',
	globPatterns: [
		'**/*.{css,js,json,webmanifest,ico,php,txt,config}'
	],
	swDest: 'public/sw.js',
	ignoreURLParametersMatching: [
		/^utm_/,
		/^fbclid$/
	]
};