.PHONY: default install start stop test clean

.DEFAULT_GOAL := help

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Install project's dependencies
	cp -n .env.dist .env.local
	docker-compose build
	docker-compose run --rm \
		php bash -ci '/usr/local/bin/composer install'
	docker-compose run --rm \
        php bash -ci '/usr/local/bin/composer update'

start: ## Start project
	@echo "Start the project"
	docker-compose up --build

stop: ## Stop the server
	docker-compose down

test: ## Launch the project's tests
	@echo "Launch the tests"
	docker-compose run --rm \
		php bash -ci './vendor/bin/simple-phpunit'

clean: ## Clean unused objects
	docker-compose rm -f
