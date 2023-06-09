setup: install-deps build-assets generate-app-key migrate run-fill-db
start: migrate seed serve

install-deps:
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

build-assets:
	npm ci
	npm run build

generate-app-key:
	php artisan key:generate

run-fill-db:
	php artisan db:seed --force

serve:
	php artisan serve --host=0.0.0.0 --port=$(PORT)

seed:
	php artisan db:seed --force