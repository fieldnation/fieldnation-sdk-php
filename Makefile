.PHONY: test build

build: composer
	php composer.phar install

composer:
	./scripts/getComposer

test:
	php composer.phar test

lint:
	php composer.phar lint:check