user:
	ddev php bin/console make:user
entity:
	ddev php bin/console make:entity
crud:
	ddev php bin/console make:crud
login:
	ddev php bin/console make:security:form-login
register:
	ddev php bin/console make:registration-form
cache:
	ddev php bin/console cache:clear
validator:
	ddev php bin/console make:validator
controller:
	ddev php bin/console make:controller
migration:
	ddev php bin/console make:migration
migrate:
	ddev php bin/console doctrine:migrations:migrate
delete-migration:
	ddev php bin/console doctrine:migrations:delete
db-create:
	ddev php bin/console doctrine:database:create
db-drop:
	ddev php bin/console doctrine:database:drop --force
fixtures:
	ddev php bin/console doctrine:fixtures:load

# CS-Fixer
cs-fix:
	ddev php vendor/bin/php-cs-fixer fix
cs-check:
	ddev php vendor/bin/php-cs-fixer check

# PHPStan
phpstan:
	ddev php vendor/bin/phpstan analyse src --level=8
