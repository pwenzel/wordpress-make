ENVIRONMENT?=development
TITLE?=Example Project
ADMIN?=pwenzel
ADMIN_EMAIL?=paul@co-opmedia.org
URL?=http://localhost/example

.PHONY: install

install: composer-install $(ENVIRONMENT) 

composer-install:
	@composer install

development:
	vendor/bin/wp core config --dbname=example --dbuser=root --dbpass=root
	vendor/bin/wp core install --url="$(URL)" --title="$(TITLE) DEV" --admin_name=$(ADMIN) --admin_email=$(ADMIN_EMAIL) --admin_password=w00t

# staging:
#         ./wp core config --dbname=example --dbuser=changeme --dbpass=changeme
#         ./wp core install --url="http://stage.example.com" --title="$(TITLE)" --admin_name=$(ADMIN) --admin_email=$(ADMIN_EMAIL) --admin_password=changeme

# production:
#         ./wp core config --dbname=example --dbuser=changeme --dbpass=changeme
#         ./wp core install --url="http://example.com" --title="$(TITLE)" --admin_name=$(ADMIN) --admin_email=$(ADMIN_EMAIL) --admin_password=changeme

post-install: plugins .htaccess
	@vendor/bin/wp theme activate example 
	@vendor/bin/wp plugin delete hello
	@vendor/bin/wp plugin delete akismet
	
plugins:
	@vendor/bin/wp plugin install http://downloads.wordpress.org/plugin/wp-less.1.4.2.zip --activate	

.htaccess: 
	vendor/bin/wp rewrite structure "/%year%/%monthnum%/%postname%/"
	vendor/bin/wp eval-file tools/generate-htaccess.php
	cat vendor/h5bp/server-configs-apache/.htaccess >> .htaccess

test:
	vendor/bin/phpunit

clean-db:
	vendor/bin/wp db reset

clean: 
	@rm -rf wp-content/plugins/wp-less
	@rm -rf vendor;
	@rm -rf wp-admin wp-includes readme.html license.txt wp-config.php wp-activate.php wp-config-sample.php wp-login.php wp-trackback.php wp-blog-header.php wp-cron.php wp-mail.php wp-comments-post.php wp-links-opml.php wp-settings.php wp-load.php wp-signup.php xmlrpc.php index.php
	@rm composer.lock
	@echo Purged application files.
