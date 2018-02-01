waavo
=====
Job offer task. 

I used some existing bundles, I don't like reinventing bicycles. 
If it's needed I can parse rss xml by myself (or JMS Serializer).
In real time I would check if such feed exists, and update only needed items, but in weekend I'm too lazy, so app will stupidly insert feed's as new ones.

## Installation
``` 
composer install 
vagrant up
vagrant ssh
cd Code/
bin/console doctrine:schema:update --force
```

## Development
Dev environment is made with Vagrant, but I have enough skills to do it with docker. :)

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
http://waavo.app || http://waavo || http://192.168.10.50

List by category:
http://waavo.app/category/{category}

Feed info:
http://waavo.app/{id}

## Testing
``` 
vendor/bin/simple-phpunit
```

## P.S.
Remember, I qualify myself as professional Laravel developer. I don't know all tweaks and perks of Symfony framework, but it's only a matter of time when I'll have that knowledge if it's going to be main framework in company.