#!/bin/bash
echo "Clearing cache..."
rm -rf ./app/cache/*
php app/console cache:clear --no-warmup
