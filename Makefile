setup: install-deps build-assets generate-app-key migrate run-fill-db
start: drop-migrate-seed serve

install-deps:
	composer install

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

drop-migrate-seed:
	php artisan migrate:refresh --seed --force

serve:
	php artisan serve --host=0.0.0.0 --port=$(PORT)

seed:
	php artisan db:seed --force