# laravel-wordpress-cms
    - version 1.0.1

# description
    - Laravel Admin same CMS Wordpress :)
    
    - Demo link: https://cms.tweb.com.vn
    
    - Admin: https://cms.tweb.com.vn/admin
        - user: admin@gmail.com
        - password: 123456789

    ├── README.md
    ├── etc
    │   └── cicd
    └── src
        ├── app
        ├── artisan
        ├── bootstrap
        ├── composer.json
        ├── composer.lock
        ├── config
        ├── database
        ├── package-lock.json
        ├── package.json
        ├── packages
        ├── phpunit.xml
        ├── public
        ├── resources
        ├── routes
        ├── server.php
        ├── storage
        ├── tests
        ├── themes
        ├──└── default
        ├── vendor
        ├── webpack.mix.js
        └── yarn.lock

# install & setup 
    - update vendor cmd: composer install
        COMPOSER_MEMORY_LIMIT=-1 composer update

    - migration database cmd: 

        + php artisan migrate
        + php artisan db:seed --class=RegionsTableSeeder
        + php artisan db:seed --class=UsersTableSeeder
        
    - link media
        + php artisan storage:link
        
    - sau khi config xong đăng nhập admin: https://cms.tweb.com.vn/admin/configs cấu hình thông tin gửi mail và các config cơ bản.

# Install theme
    - Step 1: Download theme default: https://github.com/tinhnguyenvan/laravel-wordpress-cms-theme-default
        default/
        ├── README.md
        ├── lang
        │   └── vi
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
    
    - Step 2: php artisan theme:install {--name=}
    
            - ex: php artisan theme:install --name=default

# Remove theme
    - php artisan theme:remove {--name=}

# generate
    - create controller
        + php artisan make:controller Admin/SchoolCollegeTypeController --resource --model=Models/SchoolCollegeType
        + php artisan make:controller Site/SitemapController
        
    - create model: 
        + php artisan generate:modelfromtable --table=master_plugins --folder=App/Models --singular
        
    - create mail
        + php artisan make:mail ShoppingCart
        
    - create job
        + php artisan make:job ShoppingCartJob


 
# php auto fix cs
    - preview
        + ./vendor/bin/php-cs-fixer fix --diff --dry-run -v
    
    - auto fixed
        + ./vendor/bin/php-cs-fixer fix
        
# queue
    - default:
        + php artisan queue:work
        + php artisan queue:listen
    - set queue name
        + php artisan queue:work --queue=admin
        
    * Nếu không dùng rabbitmq thì config .env QUEUE_CONNECTION=sync
        
# integrate third-party
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

# package install
    - develop laravel package: https://laravelpackage.com/02-development-environment.html#orchestra-testbench
    - composer require tinhphp/school
