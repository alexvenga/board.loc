docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d

test:
	docker-compose exec php-cli vendor/bin/phpunit

assets-install:
	docker-compose exec node yarn install

assets-rebuild:
	docker-compose exec node npm rebuild node-sass --force

assets-dev:
	docker-compose exec node yarn run dev

assets-prod:
	docker-compose exec node yarn run prod

assets-watch:
	docker-compose exec node yarn run watch

queue:
	docker-compose exec php-cli php artisan queue:work

perm:
#	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R 777 storage bootstrap/cache
	sudo chmod -R 777 storage node_modules
	sudo chmod -R 777 storage public/build