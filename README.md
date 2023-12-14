# Платформа E-COMMERCE на базе Laravel

## Инфраструктура

Для локального окружения рекомендуется использовать [Docker Desktop](https://www.docker.com/products/docker-desktop/) (для Windows и Mac OS) или Docker Compose (для Linux).

## Установка

> Команды задаются в консольном интерфейсе (терминале) вашей операционной системы.
> В Windows это Powershell или CMD, в Linux и Mac OS – Terminal.


1. Клонируем репозиторий:

```bash
git clone https://github.com/WPPWru/proxy-checker.git
```

3. Переходим в каталог с проектом:

```bash
cd proxy-checker
```

Далее инструкция в зависимости от вашей системы.

### Вариант для Windows

1. Копируем файл `.env.example` в `.env`:

```bash
copy .env.example .env
```

2. Установка контейнеров:

```bash
docker compose up -d
```

> В зависимости от того, какой вариант вы выбрали, вместо `docker compose` можете использовать `docker-compose` или `docker-compose.exe` (для Windows).

3. Выкачивание  `/vendor/` на локалку:

```bash
docker exec -i proxy-checker-laravel composer install --ignore-platform-reqs
```

4. Генерация ключа приложения laravel:

```bash
docker exec -i proxy-checker-laravel php artisan key:generate
```

4. Миграция БД:

```bash
docker exec -i proxy-checker-laravel php artisan migrate:fresh --seed
```


### Вариант для MacOS, Linux

1. Создание .env, выкачивание `vendor` на локалку, генерация ключа приложения laravel, миграция БД:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    cp .env.example .env && \
    docker exec -i proxy-checker-laravel composer install --ignore-platform-reqs && \
    docker exec -i proxy-checker-laravel php artisan key:generate && \
    docker exec -i proxy-checker-laravel php artisan migrate:fresh --seed
```

> Вы также можете сконфигурировать `.env` на своё усмотрение (скажем, прописать свои порты при возникновении конфликтов).

### Управление Docker

- Запуск и перезапуск контейнеров

> В зависимости от того, какой вариант вы выбрали, вместо `docker compose` можете использовать `docker-compose` или `docker-compose.exe` (для Windows).

```bash
docker compose up -d
```

- Остановка контейнеров

```bash 
docker compose down
```

### Управление приложением

Как пользоваться командами artisan, composer и т.д. в контейнере:

1. Выяснить имя контейнера с laravel:

```bash
docker ps
```

2.1. По имени контейнера (в данном случае, **proxy-checker-laravel**) можно авторизоваться в нём:

```bash
docker exec -it proxy-checker-laravel /bin/bash
```

И задавать команды в его консоли:

```bash
php artisan about
```

2.2. То же самое, что и в предыдущем пункте, но 1 командой:

```bash
docker exec -i proxy-checker-laravel php artisan about
```

### Debugging

По умолчанию, Xdebug отключен в docker-compose.yml. Чтобы его включить, нужно прописать в .env или раскомментировать строку:

```bash
XDEBUG_MODE="debug,develop"
```

При необходимости, можно настроить `XDEBUG_CLIENT_PORT` и другие параметры в `.env`,
и перезапустить контейнеры:

```bash
docker compose down && docker compose up -d
```

> Xdebug, как настроить: https://habr.com/ru/articles/712670/

### Тестирование

Сначала нужно установить тестовую БД:

```bash
docker exec -i proxy-checker-laravel php artisan ecom_test
```

Затем, можно запускать тесты:

```bash
docker exec -i proxy-checker-laravel php artisan test
```

## Использование

- https://localhost/ – адрес чекера прокси


