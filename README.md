symfony-rss
=====

## Installation
``` 
composer install 
vagrant up
vagrant ssh
cd Code/
bin/console doctrine:schema:update --force
```

## Development
Dev environment is build with Vagrant, but I have enough skills to do it with docker. :)

For frontend I've used symfony's webpack, but I won't leave how-to instructions for creation of uglified/minified/versioned css/js.

## Prod
For production mode change in VM /etc/nginx/sites-available/waavo.app
```
index index.html index.htm index.php app_dev.php;
```
to
```
index index.html index.htm index.php app.php;
```

## Usage
Parse Rss feed.
``` 
bin/console rss:parse http://www.feedforall.com/sample.xml feedforall
```

List of feeds:
http://192.168.10.50

List by category:

http://192.168.10.50/category/{category}

Feed info:

http://192.168.10.50/{id}

## Testing
``` 
vendor/bin/simple-phpunit