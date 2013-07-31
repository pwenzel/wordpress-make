# wordpress-make

Generate a Wordpress installation without clicking. Its special sauce is a mixture of [Composer](http://getcomposer.org) and [WP-CLI](http://wp-cli.org).

## Requirements

* Composer should be [installed locally](http://getcomposer.org/doc/00-intro.md#system-requirements). This may be optional in the future.
* PHP 5.3 or greater is required for Composer. 

## Usage

First, clone this repository.

Assuming a local installation, run the following commands:

	echo "CREATE DATABASE IF NOT EXISTS example" | mysql -u root -p; 
	make
	make test

## How It Works

2. Composer installs WP-CLI, PHPUnit, and a few other dependencies in `vendor`.
3. Environment-specific tasks are run. By default it runs the *development* environment task, setting up a `wp-config.php` file and installing tables in your database. *Staging* and *production* are other optional targets.
4. Plugins are installed. In this example, WP-LESS 1.5.3 is downloaded and activated.
5. An `.htaccess` is automatically generated with the rewrite structure `/%year%/%monthnum%/%postname%/`.
6. Unnecesssary themes and plugins are deleted.
  
## Bonus

* The `.htaccess` file generated includes rules from H5BP. Customize to your liking.
* TGM Plugin Activator is bundled for automating plugin tasks from within your Wordpress theme.