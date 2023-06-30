setup: env-prepare sqlite-prepare install key db-prepare ide-helper
	npm run build

env-prepare:
	cp -n .env.example .env || true

sqlite-prepare:
	touch database/database.sqlite

install: install-app install-frontend

install-app:
	composer install

install-frontend:
	npm ci

key:
	php artisan key:generate

db-prepare:
	php artisan migrate:refresh --seed --force

ide-helper:
	php artisan ide-helper:eloquent
	php artisan ide-helper:gen
	php artisan ide-helper:meta
	php artisan ide-helper:mod -n

start:
	php artisan serve --host=0.0.0.0 --port=$(PORT)

validate:
	composer validate

lint:
	composer exec phpcs -- --standard=PSR12 app routes tests

lint-fix:
	composer exec phpcbf -- --standard=PSR12 app routes tests

test:
	php artisan test

test-coverage:
	php artisan test --coverage-clover build/logs/clover.xml
