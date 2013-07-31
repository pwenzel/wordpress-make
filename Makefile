ENVIRONMENT?=development
TITLE?=Example Project
ADMIN=pwenzel
ADMIN_EMAIL=paul@co-opmedia.org

.PHONY: install

install: composer-install $(ENVIRONMENT) 

composer-install:
	@composer install

development:
	vendor/bin/wp core config --dbname=example --dbuser=root --dbpass=root
	vendor/bin/wp core install --url="http://example.dev" --title="$(TITLE) DEV" --admin_name=$(ADMIN) --admin_email=$(ADMIN_EMAIL) --admin_password=w00t

# staging:
#         ./wp core config --dbname=example --dbuser=changeme --dbpass=changeme
#         ./wp core install --url="http://stage.example.com" --title="$(TITLE)" --admin_name=$(ADMIN) --admin_email=$(ADMIN_EMAIL) --admin_password=changeme

# production:
#         ./wp core config --dbname=example --dbuser=changeme --dbpass=changeme
#         ./wp core install --url="http://example.com" --title="$(TITLE)" --admin_name=$(ADMIN) --admin_email=$(ADMIN_EMAIL) --admin_password=changeme

application:
	@vendor/bin/wp theme activate example
	@vendor/bin/wp theme delete twentytwelve
	@vendor/bin/wp theme delete twentyeleven
	@vendor/bin/wp plugin delete hello
	@vendor/bin/wp plugin delete akismet
	
clean-db:
	vendor/bin/wp db reset

clean: clean-db
	@rm -rf vendor;
	@rm -rf wp-admin wp-includes readme.html license.txt wp-config.php wp-activate.php wp-config-sample.php wp-login.php wp-trackback.php wp-blog-header.php wp-cron.php wp-mail.php wp-comments-post.php wp-links-opml.php wp-settings.php wp-load.php wp-signup.php xmlrpc.php index.php
	@rm -rf wp-content/plugins/*
	@rm -rf wp-content/themes/twenty*
	@echo Purged application files.
