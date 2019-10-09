# PCC Framework #


Utilities, blocks, custom post types, and taxonomies for the Platform Cooperativism Consortium website.

## Description ##

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
* Topics

## Installation ##

1. Upload the plugin zip file via the Plugins panel in WordPress.
2. Activate the plugin.
3. There is no step three.


## Upgrade Notice ##
### 1.0.0 ###
This is the plugin's first production release.

## Development ##

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
