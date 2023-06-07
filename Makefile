setup: install-deps build-assets migrate

install-deps:
	composer install --ignore-platform-reqs

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

build-assets:
	npm ci
	npm run build