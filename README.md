# Laravel Wordpress CMS
- Version **Laravel** 7.1
- Version **Laravel Wordpress CMS** 1.0


## Welcome to GitHub Pages

- Laravel Admin same CMS Wordpress :)

- Demo link: [https://cms.tweb.com.vn](https://cms.tweb.com.vn)


# Install & setup

###OPTION 1:
  
  	php artisan install

###OPTION 2:

- **Step 1**:

+ for product
	

	COMPOSER_MEMORY_LIMIT=-1 composer install
	

+ for dev


	COMPOSER_MEMORY_LIMIT=-1 COMPOSER=composer-local.json composer update


- **Step 2**: Install from command

		php artisan install

- **Step 3**: add schedule crontab

    * * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1
	
	- todo update path "/var/www/html"

# Login Admin

- Demo link: [https://cms.tweb.com.vn/admin](https://cms.tweb.com.vn/admin)
    - **user**: admin@gmail.com
    - **password**: 123456789

	![](https://user-images.githubusercontent.com/6789649/101598079-32c8f400-3a2a-11eb-82e9-29b1c227ba81.png)

	![](https://user-images.githubusercontent.com/6789649/101597906-eb426800-3a29-11eb-931c-4a7e4c7e55a4.png)

# Theme

### 1. Create new theme

- **Step 1**: Download theme default example: [https://github.com/tinhnguyenvan/laravel-wordpress-cms-theme-default](https://github.com/tinhnguyenvan/laravel-wordpress-cms-theme-default)

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

- **Step 2**: cài đặt theme

		php artisan theme:install {--name=}

- Example:
  
		php artisan theme:install --name=default

### 2. Remove theme

	    	php artisan theme:remove {--name=}


# Plugin

1. **Laravel Package Woocommerce**

	- [https://github.com/tinhnguyenvan/laravel-wordpress-cms-package-woocommerce](https://github.com/tinhnguyenvan/laravel-wordpress-cms-package-woocommerce)

		[![Latest Version on Packagist](https://img.shields.io/packagist/v/tinhphp/woocommerce.svg?style=flat-square)](https://packagist.org/packages/tinhphp/woocommerce)
		
		[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
		
		![GitHub Workflow Status](https://img.shields.io/github/workflow/status/tinhphp/woocommerce/run-tests?label=tests)
		
		[![Total Downloads](https://img.shields.io/packagist/dt/tinhphp/woocommerce.svg?style=flat-square)](https://packagist.org/packages/tinhphp/woocommerce)


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

    	php artisan queue:work
    	php artisan queue:listen --timeout=0

- set queue name

    	php artisan queue:work --queue=admin

- ***Nếu không dùng rabbitmq thì config .env `QUEUE_CONNECTION=sync`***

# Integrate third-party
- generators: [https://github.com/laracademy/generators](https://github.com/laracademy/generators)

- cart: [https://github.com/darryldecode/laravelshoppingcart](https://github.com/darryldecode/laravelshoppingcart)

- permission: [https://github.com/spatie/laravel-permission](https://github.com/spatie/laravel-permission)

- generate code: [https://laravelarticle.com/laravel-custom-id-generator](https://laravelarticle.com/laravel-custom-id-generator)

- image: [http://image.intervention.io/getting_started/introduction](http://image.intervention.io/getting_started/introduction)

- autocomplete: [http://easyautocomplete.com/guide#sec-trigger-event](http://easyautocomplete.com/guide#sec-trigger-event)

- jquery cookie: [https://github.com/carhartl/jquery-cookie](https://github.com/carhartl/jquery-cookie)

- simple qrcode: [https://www.simplesoftware.io/simple-qrcode/](https://www.simplesoftware.io/simple-qrcode/)

- generator: [https://www.simplesoftware.io/simple-qrcode/](https://www.simplesoftware.io/simple-qrcode/)

- api genera doc: [https://github.com/mpociot/laravel-apidoc-generator](https://github.com/mpociot/laravel-apidoc-generator)

- excel: [https://docs.laravel-excel.com/3.1/getting-started/](https://docs.laravel-excel.com/3.1/getting-started/)

- datetime: [https://flatpickr.js.org/getting-started/](https://flatpickr.js.org/getting-started/)

- rating: [https://github.com/willvincent/laravel-rateable](https://github.com/willvincent/laravel-rateable)

- timeline: [https://bootsnipp.com/tags/timeline](https://bootsnipp.com/tags/timeline)

- development package: [https://laravelpackage.com/02-development-environment.html#installing-composer](https://laravelpackage.com/02-development-environment.html#installing-composer)

- multi language: [https://docs.astrotomic.info/laravel-translatable/](https://docs.astrotomic.info/laravel-translatable/)

- select2: [https://select2.org/getting-started/basic-usage](https://select2.org/getting-started/basic-usage)
- select2-bootstrap4-theme: [https://github.com/ttskch/select2-bootstrap4-theme](https://github.com/ttskch/select2-bootstrap4-theme)
