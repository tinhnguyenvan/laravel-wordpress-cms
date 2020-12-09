# Laravel Wordpress CMS
- Version 1.0.1


## Welcome to GitHub Pages

- Laravel Admin same CMS Wordpress :)

- Demo link: [https://cms.tweb.com.vn](https://cms.tweb.com.vn)


# Install & setup
    - Step 1:
		COMPOSER_MEMORY_LIMIT=-1 composer install

    - Step 2: migration
    	php artisan migrate
      	php artisan db:seed --class=UsersTableSeeder

    - Step 3: link media
		php artisan storage:link

# Login Admin

- Demo link: [https://cms.tweb.com.vn/admin](https://cms.tweb.com.vn/admin)
    - user: admin@gmail.com
    - password: 123456789


# Install theme
- Step 1: Download theme default: [https://github.com/tinhnguyenvan/laravel-wordpress-cms-theme-default](https://github.com/tinhnguyenvan/laravel-wordpress-cms-theme-default)

```
	default/
        ├── README.md
        ├── lang
        │   └── vi
        │   └── en
        ├── public
        │   ├── css
        │   ├── img
        │   ├── js
        │   ├── manifest.json
        │   ├── screen_shot.png
        │   └── vendor
        └── views
            ├── home
            ├── layouts
            ├── page
            ├── post
            ├── product
            ├── search
            └── tag
```

- Step 2: cài đặt theme
	- php artisan theme:install {--name=}

	- Example: php artisan theme:install --name=default

# Remove theme
    - php artisan theme:remove {--name=}

# Generate
    - create controller
        + php artisan make:controller Admin/SchoolCollegeTypeController --resource --model=Models/SchoolCollegeType
        + php artisan make:controller Site/SitemapController

    - create model:
        + php artisan generate:modelfromtable --table=master_plugins --folder=App/Models --singular

    - create mail
        + php artisan make:mail ShoppingCart

    - create job
        + php artisan make:job ShoppingCartJob



# PHP auto fix cs
    - preview
        + ./vendor/bin/php-cs-fixer fix --diff --dry-run -v

    - auto fixed
        + ./vendor/bin/php-cs-fixer fix

# Queue
    - default:
        + php artisan queue:work
        + php artisan queue:listen
    - set queue name
        + php artisan queue:work --queue=admin

    * Nếu không dùng rabbitmq thì config .env QUEUE_CONNECTION=sync

# Integrate third-party
    - generators: https://github.com/laracademy/generators
    - cart: https://github.com/darryldecode/laravelshoppingcart
    - permission: https://github.com/spatie/laravel-permission
    - generate code: https://laravelarticle.com/laravel-custom-id-generator
    - image: http://image.intervention.io/getting_started/introduction
    - autocomplete: http://easyautocomplete.com/guide#sec-trigger-event
    - jquery cookie: https://github.com/carhartl/jquery-cookie
    - simple qrcode: https://www.simplesoftware.io/simple-qrcode/
    - generator: https://www.simplesoftware.io/simple-qrcode/
    - api genera doc: https://github.com/mpociot/laravel-apidoc-generator
    - excel: https://docs.laravel-excel.com/3.1/getting-started/
    - datetime: https://flatpickr.js.org/getting-started/
    - rating: https://github.com/willvincent/laravel-rateable
    - timeline: https://bootsnipp.com/tags/timeline
    - development package: https://laravelpackage.com/02-development-environment.html#installing-composer
    - multi language: https://docs.astrotomic.info/laravel-translatable/

