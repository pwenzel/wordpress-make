# wordpress-make

Generate a Wordpress installation without clicking. Its special sauce is a mixture of [Composer](http://getcomposer.org) and [WP-CLI](http://wp-cli.org).

It also provides a necesssary bootstrap files for unit testing with PHPUnit.

## Requirements

* Composer should be [installed locally](http://getcomposer.org/doc/00-intro.md#system-requirements). This may be optional in the future.
* PHP 5.3 or greater is required for Composer. 
* This demo assumes an installation running at `http://localhost/example/`. You can customize this in the environment targets of the Makefile.

## Usage

First, clone this repository.

On your local machine, run the following commands:

	echo "CREATE DATABASE IF NOT EXISTS example" | mysql -u root -p; 
	make
	make post-install
	make test

Setting Other environments or options:

	make URL=http://localhost/myotherproject
	make ENVIRONMENT=staging
	make ENVIRONMENT=production

## How It Works

1. Composer installs WP-CLI, PHPUnit, and a few other dependencies in `vendor`.
2. Environment-specific tasks are run next. By default it runs the *development* environment task, setting up a `wp-config.php` file and installing tables in your database. *Staging* and *production* are other optional targets.
3. Plugins are installed. In this example, WP-LESS 1.4.2 is downloaded and activated.
4. An `.htaccess` is automatically generated with the rewrite structure `/%year%/%monthnum%/%postname%/`.
5. Unnecesssary themes and plugins are deleted.
  
## Bonus

* The `.htaccess` file generated includes rules from HTML5 Boilerplate. Customize to your liking.
* TGM Plugin Activator will soon be bundled for automating plugin tasks from within your Wordpress theme.
* You can also trigger unit tests via web browser at http://localhost/exmaple/tests/web-runner.php