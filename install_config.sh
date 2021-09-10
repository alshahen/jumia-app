#!/usr/bin/env sh

cp .env.example .env
./vendor/bin/sail artisan storage:link
./vendor/bin/sail artisan key:generate
