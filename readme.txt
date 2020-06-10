=== PCC Framework ===
Contributors: greatislander
Tags: blocks, custom post types, taxonomies
License: BSD 3-Clause "New" License
License URI: https://opensource.org/licenses/BSD-3-Clause
Requires at least: 5.3
Tested up to: 5.3
Stable tag: 2.2.2

[![License](https://badgen.net/github/license/platform-coop-toolkit/pcc-framework)](https://github.com/platform-coop-toolkit/pcc-framework/blob/master/LICENSE.md) [![Status](https://badgen.net/github/status/platform-coop-toolkit/pcc-framework)](https://circleci.com/gh/platform-coop-toolkit/pcc-framework/tree/master) [![GitHub Release](https://badgen.net/github/release/platform-coop-toolkit/pcc-framework)](https://github.com/platform-coop-toolkit/pcc-framework/releases/latest)

Utilities, blocks, custom post types, and taxonomies for the Platform Cooperativism Consortium website.

== Description ==

This plugin adds the following custom components for the Platform Cooperativism Consortium:

Blocks:

* Child Pages
* Participants Button
* Program Button
* Recent Content
* Social Links

Custom Post Types:

* Events
* People

Custom Taxonomies:

* Roles

The following plugins are required:

- Contact Form 7
- Disable Comments
- [Intervention](https://github.com/soberwp/intervention/)
- Simple Page Ordering

The following plugins are recommended:

- Koko Analytics
- The SEO Framework
- WP Toolbelt

== Installation ==

1. Upload the plugin zip file via the Plugins panel in WordPress.
2. Activate the plugin.
3. There is no step three.

== Frequently Asked Questions ==
None yet.

== Changelog ==
= 2.2.2 =
**Bug Fixes**

* Remove dependency installer ([40be36b](https://github.com/platform-coop-toolkit/pcc-framework/commit/40be36bcfaf2c613e44acbfee64becdfb870d0bc))

= 2.2.1 =

**Bug Fixes**

* Address mailing list bug in recent content block ([#113](https://github.com/platform-coop-toolkit/pcc-framework/issues/113)) ([f865839](https://github.com/platform-coop-toolkit/pcc-framework/commit/f8658394ae56b1f0c73f6e3b7f78b5fbe83b8783))
* Address linting errors ([26072cb](https://github.com/platform-coop-toolkit/pcc-framework/commit/26072cbe2ea5429f0a1ed406b4f8db9ffa38da16))

= 2.2.0 =

**Minor Changes**

* Switch to GitHub Actions: #96
* Use Sage 10 editor config: #98
* Bump @wordpress/eslint-plugin from 3.2.0 to 3.3.0: #100
* Bump @wordpress/scripts from 6.0.0 to 6.1.1: #101
* Add support for custom authors: #102

**Patches**

* Bump autoprefixer from 9.7.2 to 9.7.3: #97

= 2.1.0 =

**Minor Changes**

* Bump @wordpress/eslint-plugin from 3.1.0 to 3.2.0: #92
* Bump @wordpress/scripts from 5.1.0 to 6.0.0: #93
* Add support for People page: #94

**Patches**

* Bump autoprefixer from 9.7.1 to 9.7.2: #95

= 2.0.0 =

**Major Changes**

* Add WordPress 5.3 support (resolves #77): #79
* Switch to NPM: #80
* Add afragen/wp-dependency-installer and bundle CMB2: #81
* Move Intervention to plugin dependencies: #87

= 1.9.0 =

**Minor Changes**

* Add featured participants: #90

= 1.8.0 =

**Minor Changes**

* Support newlines in venue name: #86

= 1.7.0 =

**Minor Changes**

* Bump @wordpress/scripts from 4.1.0 to 5.0.0: #74
* Remove featured participants: #75

= 1.6.0 =

**Minor Changes**

* Add featured participants field (resolves #72): #73

= 1.5.0 =

**Minor Changes**

* Adjust participant fields: #68
* Add field to explicitly show people on people page: #69
* Add new short title field: #70
* Add locality and country to people profiles: #71

= 1.4.0 =

**Minor Changes**

* Add field for Twitter username: #67

= 1.3.1 =

**Patches**

* Fix broken newsletter signup link in Recent Content block: #66

= 1.3.0 =

**Minor Changes**

* Add LiveStream OEmbed support: #64
* Add Recent Content block: #65

= 1.2.1 =

**Patches**

* Update readme and version

= 1.2.0 =

**Minor Changes**

* Add development guidelines: #50
* Bump @wordpress/eslint-plugin from 2.3.0 to 2.4.0: #52
* Bump @wordpress/scripts from 3.3.0 to 3.4.0: #53
* Bump johnbillion/extended-cpts from 4.2.6 to 4.3.0: #54
* Bump eslint-utils from 1.3.1 to 1.4.2: #57
* Bump @wordpress/scripts from 3.4.0 to 4.1.0: #62
* Bump @wordpress/eslint-plugin from 2.4.0 to 3.0.0: #59

**Patches**

* Bump johnbillion/extended-cpts from 4.2.5 to 4.2.6: #51
* Bump johnbillion/extended-cpts from 4.3.0 to 4.3.1: #55
* Bump johnbillion/extended-cpts from 4.3.1 to 4.3.2: #56
* Bump mixin-deep from 1.3.1 to 1.3.2: #58
* Fix errors involving missing blocks: #63

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

- `npm install`: Install CSS and JavaScript dependencies
- `npm run build`: Build front-end assets
- `npm run build:production`: Build front-end assets for production
- `npm run lint`: Check CSS and JavaScript coding standards
- `composer install`: Install PHP dependencies
- `composer test`: Run PHP unit tests and check PHP coding standards ([WordPress PHPUnit environment](https://make.wordpress.org/cli/handbook/plugin-unit-tests/) must be set up first)

This plugin uses [CSS with PostCSS](https://postcss.org/) for admin stylesheets and includes the following PHP libraries:

- [johnbillion/extended-cpts](https://github.com/johnbillion/extended-cpts) for registering custom post types and taxonomies
- [davidgorges/human-name-parser](https://github.com/davidgorges/HumanNameParser.php) for parsing human names (not used yet)
- [commerceguys/addressing](https://github.com/commerceguys/addressing) for formatting addresses
