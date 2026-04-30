#!/bin/bash

# verify-recipes.sh <PHP_VERSION> <SYMFONY_VERSION>
# Example: ./verify-recipes.sh 8.1 6

PHP_VERSION=$1
SYMFONY_VERSION=$2

if [ -z "$PHP_VERSION" ] || [ -z "$SYMFONY_VERSION" ]; then
    echo "Usage: ./verify-recipes.sh <PHP_VERSION> <SYMFONY_VERSION>"
    echo "Example: ./verify-recipes.sh 8.1 6"
    exit 1
fi

IMAGE="php:${PHP_VERSION}-cli-alpine"
CONTAINER_NAME="fakturownia_verify_php${PHP_VERSION}_sf${SYMFONY_VERSION}"

echo "Starting verification for PHP ${PHP_VERSION} and Symfony ${SYMFONY_VERSION}..."

# Clean up any existing container
docker rm -f $CONTAINER_NAME >/dev/null 2>&1

# Run the verification in a docker container
docker run --rm \
    -v "$(pwd):/bundle" \
    -w /app \
    --name "$CONTAINER_NAME" \
    "$IMAGE" \
    sh -c '
        apk add --no-cache git unzip libzip-dev icu-dev zlib-dev && \
        docker-php-ext-install zip intl && \
        curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
        echo "Creating Symfony '"${SYMFONY_VERSION}"' project..." && \
        composer create-project symfony/skeleton:^'"${SYMFONY_VERSION}"' . --no-interaction --quiet && \
        echo "Configuring local bundle repository..." && \
        composer config repositories.local "{\"type\": \"path\", \"url\": \"/bundle\", \"options\": {\"symlink\": false}}" && \
        composer config minimum-stability dev && \
        composer config prefer-stable true && \
        echo "Requiring the bundle..." && \
        composer require codevenom/fakturownia-bundle:* --no-interaction
    '

RESULT=$?

if [ $RESULT -eq 0 ]; then
    echo "SUCCESS: Verification passed for PHP ${PHP_VERSION} and Symfony ${SYMFONY_VERSION}."
else
    echo "FAILURE: Verification failed for PHP ${PHP_VERSION} and Symfony ${SYMFONY_VERSION}."
fi

exit $RESULT
