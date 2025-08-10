

WordPress boilerplate with Composer, easier configuration, and an improved folder structure

<p align="center">
  <a href="https://roots.io/bedrock/">Website</a> &nbsp;&nbsp; <a href="https://roots.io/bedrock/docs/installation/">Documentation</a> &nbsp;&nbsp; <a href="https://github.com/roots/bedrock/releases">Releases</a> &nbsp;&nbsp; <a href="https://discourse.roots.io/">Community</a>
</p>



## Overview

Bedrock is a WordPress boilerplate for developers that want to manage their projects with Git and Composer. Much of the philosophy behind Bedrock is inspired by the [Twelve-Factor App](http://12factor.net/) methodology, including the [WordPress specific version](https://roots.io/twelve-factor-wordpress/).

- Better folder structure
- Dependency management with [Composer](https://getcomposer.org)
- Easy WordPress configuration with environment specific files
- Environment variables with [Dotenv](https://github.com/vlucas/phpdotenv)
- Autoloader for mu-plugins (use regular plugins as mu-plugins)

## Getting Started

See the [Bedrock installation documentation](https://roots.io/bedrock/docs/installation/).


## Command to create Block
inside isiemini.com/www/web/app/themes/isiemini
`ddev wp acorn acf:block ThreeCardsSection`

## command to install php dependecies
`ddev composer require log1x/acf-composer` 

## command to lunch dev for theme 
`npm run dev`