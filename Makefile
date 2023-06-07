setup:
	migrate

install:
	composer install

validate:
	composer validate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src
	composer exec --verbose phpstan -- --level=8 --xdebug src

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src

test:
	composer exec --verbose phpunit tests

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

migrate:
	php artisan migrate --force