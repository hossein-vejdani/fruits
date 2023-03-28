# Build stage for the frontend
FROM node:16-alpine AS frontend-build
WORKDIR /app

COPY frontend/package*.json ./
RUN npm install
COPY frontend/ .
RUN npm run build

# Build stage for the backend
FROM php:8.1-fpm AS backend-build
WORKDIR /app

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY backend/composer.* ./
RUN composer install --no-dev --prefer-dist --no-scripts --no-progress --no-suggest
COPY backend/ .

# Production stage
FROM php:8.1-fpm-alpine
WORKDIR /var/www/html

# Copy the Nuxt3 build from the frontend build stage
COPY --from=frontend-build /app/dist /var/www/html/

# Copy the Symfony6 files from the backend build stage
COPY --from=backend-build /app /var/www/html/

# Expose port 9000 for PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
