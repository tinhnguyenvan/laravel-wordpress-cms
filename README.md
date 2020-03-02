# description
    - Laravel Admin same CMS Wordpress :)
    - Admin template: https://coreui.io/

# laravel-cms
    - version 6.0
  
![Page Login](https://tweb.com.vn/wp-content/uploads/2020/02/cms-admin-login-1536x855.png)
![Page Config](https://tweb.com.vn/wp-content/uploads/2020/02/cms-admin-cau-hinh-1536x855.png)
![Page Product](https://tweb.com.vn/wp-content/uploads/2020/01/laravel-cms.png)
![Page Category](https://tweb.com.vn/wp-content/uploads/2020/02/cms-admin-danh-muc-sp-1536x855.png)

# install & setup 
    - update vendor cmd: composer install
    
    - migration database cmd: php artisan migrate
    
    - login admin: http://localhost:8000/admin
        + u: admin@gmail.com
        + p: 12345678
        
    - sau khi config xong đăng nhập admin: http://localhost:8000/admin/configs cấu hình thông tin gửi mail và các config cơ bản.

# generate
    - create controller
        + php artisan make:controller Admin/MediaController --resource --model=Media
        + php artisan make:controller Site/SitemapController
    - create model: 
        + php artisan generate:modelfromtable --table=configs --folder=App/Models --singular
    - create mail
        + php artisan make:mail ShoppingCart
    - create job
        + php artisan make:job ShoppingCartJob

# link media
    - php artisan storage:link
 
# php auto fix cs
    - preview
        + ./vendor/bin/php-cs-fixer fix --diff --dry-run -v
    
    - auto fixed
        + ./vendor/bin/php-cs-fixer fix
        
# queue
    - default:
        + php artisan queue:work
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

