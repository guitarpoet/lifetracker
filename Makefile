TEST_DIR := tests
SRC_DIR := src

test:
	cd tests && phpunit
c:
	mysql -u root wordpress
