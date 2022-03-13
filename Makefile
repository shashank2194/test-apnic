.DEFAULT_GOAL := all

all: install lint build test

install:
	@npm install && composer install

lint:
	@npm run lint && composer run lint

format:
	@npm run format && composer run format

test:
	@composer run test

build:
	@npm run build

help_ide:
	@rm -rf ./wordpress/ && curl https://wordpress.org/latest.zip -O && unzip -q latest.zip && rm latest.zip

local:
	@docker compose down --volumes --rmi local \
		&& docker compose up --detach \
		&& timeout 20 \
		&& docker exec -it --user www-data "apnic_foundation_news_web" /app/docker-setup-wordpress.sh \
		&& echo "visit http://localhost:8080"
