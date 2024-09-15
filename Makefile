.PHONY: tests

default:
	@echo 'Enter command'

bash:
	docker compose run --rm php8.1-cli bash

tests:
	docker compose build
	docker compose run --rm php8.1-cli composer i
	docker compose run --rm php8.1-cli vendor/bin/phpunit --color=always tests/MainTest.php
	docker network prune -f
