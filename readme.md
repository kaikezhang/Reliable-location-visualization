server {
  listen 80 default_server;

  root /home/kaike/Sites/location-visualization/public/;
  index index.php index.html index.htm;

  server_name kaike.space;

  error_log /var/log/nginx/kaike.space-error.log;
  access_log /var/log/nginx/kaike.space-access.log;

  location / {
    try_files $uri $uri/ /index.php$is_args$args;
  }

  location ~ \.php$ {
    try_files $uri =404;
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_pass unix:/var/run/php7.0-fpm.sock;
    fastcgi_index index.php;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    fastcgi_param DOCUMENT_ROOT $realpath_root;
  }
}


APP_ENV=production
APP_KEY=base64:5mhYORNcqsAczqzoFG2ZC1SvXMFbXQ9L+CHDmk3WYXE=
APP_DEBUG=false
APP_LOG_LEVEL=debug
APP_URL=http://kaike.space

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=location
DB_USERNAME=kaike
DB_PASSWORD=zkk123

BROADCAST_DRIVER=pusher
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

PUSHER_APP_ID=293067
PUSHER_KEY=6a4043788c762cfe9306
PUSHER_SECRET=b7599d3cb16f5f5c7dd7