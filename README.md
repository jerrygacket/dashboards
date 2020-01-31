Build dashboards from csv. Users and roles used. Chart and User management included. Based on Chart.js.

Install:
* git clone https://github.com/jerrygacket/dashboards.git
* cd dashboards
* composer update
* -- make config/db_local.php with your db config
* php yii migrate
* php yii migrate --migrationPath=@yii/rbac/migrations
* -- setup virtual host with server_root = project_dir/web
* -- go to http://virtualhostname/rbac/gen to generate and assign roles
there are must be a blank page.
* -- go to http://virtualhostname and you see a login form if everything is ok

demo users:
* admin 123456
* user 123456

 