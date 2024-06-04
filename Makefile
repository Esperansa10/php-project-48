install:
	composer install

gendiff: 
	./bin/gendiff

validate:
	composer validate	

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src bin

test:
	composer exec --verbose phpunit tests

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

test-coverage-text:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-text

test-coverage-html:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-html build/coverage

gendiff-json: 
	bin/gendiff tests/fixtures/file1.json tests/fixtures/file2.json

gendiff-yaml: 
	bin/gendiff tests/fixtures/file1.yml tests/fixtures/file2.yml

gendiff-jsonrec: 
	bin/gendiff tests/fixtures/file1rec.yml tests/fixtures/file2rec.yml
	

