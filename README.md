# php7 all in one & sample

## include

- docker-compose
    - php7(+xdebug,composer)
    - mysql
- sample php

## install

```bash:
$ git clone https://github.com/albyte/php7-all-in-one.git
$ cd php7-all-in-one.git
$ docker-compose build
$ docker-compose up -d
$ docker-compose run php-cli composer install
```

## web access
```
http://localhost:10080
```