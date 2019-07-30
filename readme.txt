=== PCC Framework ===
Contributors: greatislander
Tags: blocks, custom post types, taxonomies
License: BSD 3-Clause "New" License
License URI: https://opensource.org/licenses/BSD-3-Clause
Requires at least: 5.2.2
Tested up to: 5.2.2
Stable tag: 1.1.0

[![License](https://badgen.net/github/license/platform-coop-toolkit/pcc-framework)](https://github.com/platform-coop-toolkit/pcc-framework/blob/master/LICENSE.md) [![Status](https://badgen.net/github/status/platform-coop-toolkit/pcc-framework)](https://circleci.com/gh/platform-coop-toolkit/pcc-framework/tree/master) [![GitHub Release](https://badgen.net/github/release/platform-coop-toolkit/pcc-framework)](https://github.com/platform-coop-toolkit/pcc-framework/releases/latest)

Utilities, blocks, custom post types, and taxonomies for the Platform Cooperativism Consortium website.

== Description ==

This plugin adds the following custom components for the Platform Cooperativism Consortium:

Blocks:

* Child Pages
* Social Links

Custom Post Types:

* Events
* People

Custom Taxonomies:

* Roles
* Topics

== Installation ==

1. Upload the plugin zip file via the Plugins panel in WordPress.
2. Activate the plugin.
3. There is no step three.

== Frequently Asked Questions ==
None yet.

== Changelog ==
= 1.1.0 =
* Add support for animated event banners: #49

= 1.0.0 =
* Bump autoprefixer from 9.6.0 to 9.6.1: #46
* Bump lodash from 4.17.11 to 4.17.14: #47
* Add placeholder image for child pages: #48

= 0.9.0 =
* Bump @wordpress/eslint-plugin from 2.2.0 to 2.3.0: #36
* Bump @wordpress/scripts from 3.2.1 to 3.3.0: #37
* Bump johnbillion/extended-cpts from 4.2.3 to 4.2.5: #38, #44
* Bump commerceguys/addressing from 1.0.4 to 1.0.5: #43
* Update package scope: 6ac1d91
* Add participants button and program button (fix #39, fix #40): #45

= 0.8.0 =
* Add fields for venue address components: #35

= 0.7.0 =
* Add fields for image and video attribution (#32): #33
* Add Gulp tasks for CSS build and readme to Markdown (#31): #34

= 0.6.0 =
* Rename plugin: #16
* Add configuration for automatic deployment: #18
* Update dependencies: #21, #22, #23, #25, #26
* Add metadata fields and taxonomies to people (#27): #28
* Unregister unnecessary blocks: #29
* Add descriptions to event fields (#14): #30

= 0.5.0 =
* Add thumbnail support to events and people: #13

= 0.4.0 =
* Configure CI (resolve #10)
* Change event slug

= 0.3.2 =
* Update license

= 0.3.1 =
* Normalize composer.json
* Clean up package.json

= 0.3.0 =
* Remove unused post types
* Make events hierarchical
* Refine event metadata, add experimental event meta block (unused)

= 0.2.0 =
* Rebuild dynamic blocks in JavaScript
* Register custom fields using CMB2 instead of ACF

= 0.1.0 =
* Add dynamic blocks using ACF Blocks utility
* Scaffold initial post types

== Upgrade Notice ==
= 1.0.0 =
This is the plugin's first production release.

== Development ==

Commands for development:

- `yarn`: Install CSS and JavaScript dependencies
- `yarn build`: Build front-end assets
- `yarn build:production`: Build front-end assets for production
- `yarn lint`: Check CSS and JavaScript coding standards
- `composer install`: Install PHP dependencies
- `composer test`: Run PHP unit tests and check PHP coding standards ([WordPress PHPUnit environment](https://make.wordpress.org/cli/handbook/plugin-unit-tests/) must be set up first)

This plugin uses [CSS with PostCSS](https://postcss.org/) for admin stylesheets and includes the following PHP libraries:

- [johnbillion/extended-cpts](https://github.com/johnbillion/extended-cpts) for registering custom post types and taxonomies
- [davidgorges/human-name-parser](https://github.com/davidgorges/HumanNameParser.php) for parsing human names (not used yet)
- [commerceguys/addressing](https://github.com/commerceguys/addressing) for formatting addresses
