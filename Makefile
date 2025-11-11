## ---------------------------------------------------------
## Cargar variables del archivo .env si existe
## ---------------------------------------------------------

ifneq (,$(wildcard .env))
  include .env
  export
endif

PROJECT_PREFIX ?= $(PROJECT_NAME)

## ---------------------------------------------------------
## Comando base para docker-compose
## ---------------------------------------------------------

DOCKER_COMPOSE = docker compose -f ./.docker/docker-compose.yml

## ---------------------------------------------------------
## Inicialización de la Aplicación
## ---------------------------------------------------------

.PHONY: init-app
init-app: | copy-env set-permissions create-symlink up print-urls

.PHONY: copy-env
copy-env:
	@ [ ! -f .env ] && cp .env.example .env || true

.PHONY: set-permissions
set-permissions:
	@chmod -R 777 ./logger/.log
	@chmod g+s ./logger/.log

.PHONY: create-symlink
create-symlink:
	@ [ -L .docker/.env ] || ln -s ../.env .docker/.env

.PHONY: print-urls
print-urls:
	@echo "## Acceso a la Aplicación:   http://localhost:8081/"
	@echo "## Acceso a PhpMyAdmin:      http://localhost:8082/"

## ---------------------------------------------------------
## Gestión de Contenedores
## ---------------------------------------------------------

.PHONY: up
up:
	$(DOCKER_COMPOSE) up -d

.PHONY: down
down:
	$(DOCKER_COMPOSE) down

.PHONY: restart
restart:
	$(DOCKER_COMPOSE) restart

.PHONY: ps
ps:
	$(DOCKER_COMPOSE) ps

.PHONY: logs
logs:
	$(DOCKER_COMPOSE) logs

.PHONY: build
build:
	$(DOCKER_COMPOSE) build

.PHONY: stop
stop:
	$(DOCKER_COMPOSE) stop

.PHONY: install-dependencies
install-dependencies:
	$(DOCKER_COMPOSE) exec php_apache_$(PROJECT_PREFIX) git config --global --add safe.directory /var/www/html
	$(DOCKER_COMPOSE) exec php_apache_$(PROJECT_PREFIX) composer require monolog/monolog
	$(DOCKER_COMPOSE) exec php_apache_$(PROJECT_PREFIX) composer require --dev phpunit/phpunit ^11

.PHONY: prepare-tests
prepare-tests:
	$(DOCKER_COMPOSE) exec php_apache_$(PROJECT_PREFIX) mv /usr/local/bin/phpunit /var/www/html/tests/phpunit.phar
	$(DOCKER_COMPOSE) exec php_apache_$(PROJECT_PREFIX) chmod +x /var/www/html/tests/phpunit.phar
	$(DOCKER_COMPOSE) exec php_apache_$(PROJECT_PREFIX) chown -R 1000:1000 /var/www/html/tests

.PHONY: clean-docker
clean-docker:
	sudo docker rmi -f $$(sudo docker images -q) || true
	sudo docker volume rm $$(sudo docker volume ls -q) || true
	sudo docker network prune -f || true

.PHONY: clean-docker-$(PROJECT_PREFIX)
clean-docker-$(PROJECT_PREFIX):
	sudo docker rmi mysql:latest || true
	sudo docker volume rm docker_persistent-$(PROJECT_PREFIX) || true
	sudo docker network rm network_$(PROJECT_PREFIX) || true

.PHONY: init-tes
init-tes:
	$(DOCKER_COMPOSE) exec php_apache_$(PROJECT_PREFIX) git config --global --add safe.directory /var/www/html
	$(DOCKER_COMPOSE) exec php_apache_$(PROJECT_PREFIX) ./tests/phpunit.phar --configuration ./tests/phpunit.xml --testdox

.PHONY: shell
shell:
	$(DOCKER_COMPOSE) exec --user pablogarciajc php_apache_$(PROJECT_PREFIX) /bin/sh -c "cd /var/www/html/; exec bash -l"
