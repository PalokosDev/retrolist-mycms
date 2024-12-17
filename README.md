
# RetroList MyCMS

![RetroList MyCMS Logo](https://habbofont.net/font/paradise/retroliste.gif) 
CURRENTLY IN DEVELOPMENT!

RetroList MyCMS is a modern Laravel-based content management system tailored for managing retro hotel projects. It provides a seamless admin interface, advanced features like maintenance mode, and a responsive frontend for showcasing retro hotels.

---

## Features

- **User-friendly Admin Panel**: Manage retro hotels effortlessly.
- **Maintenance Mode**: Temporarily disable hotel access with a single toggle.
- **Dynamic Frontend**: A beautifully designed frontend to showcase retro hotels.
- **Database-driven**: Supports MySQL for robust and scalable storage.
- **Material Design Integration**: Sleek and modern UI.

---

## Prerequisites

To run RetroList MyCMS, ensure your server meets the following requirements:

1. **System Requirements:**
   - Linux Server (Ubuntu 22.04 or later recommended)
   - PHP 8.1 or newer
   - MySQL 5.7 or newer
   - Composer
   - Node.js and npm

2. **Installed Software:**
   - Git
   - Nginx or Apache
   - PHP extensions:
     - `pdo_mysql`
     - `mbstring`
     - `xml`
     - `curl`
     - `gd`

---

## Installation

### Step 1: Clone the Repository

```bash
cd /var/www
sudo git clone https://github.com/PalokosDev/retrolist-mycms.git
cd retrolist-mycms
sudo chown -R $USER:$USER /var/www/retrolist-mycms
```

### Step 2: Install Dependencies

#### PHP Dependencies
```bash
composer install --optimize-autoloader --no-dev
```

#### JavaScript Dependencies
```bash
npm install
npm run build
```

### Step 3: Configure the Environment

Copy the example environment file and edit it:

```bash
cp .env.example .env
nano .env
```

Set the following variables:

```env
APP_NAME=RetroList MyCMS
APP_URL=http://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=retrolist_mycms
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

Generate an application key:
```bash
php artisan key:generate
```

### Step 4: Set Permissions

Set the correct permissions for `storage` and `bootstrap/cache`:

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Step 5: Configure the Database

Create a MySQL database and user:

```sql
CREATE DATABASE retrolist_mycms;
CREATE USER 'mycms_user'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON retrolist_mycms.* TO 'mycms_user'@'localhost';
FLUSH PRIVILEGES;
```

Run database migrations and seeders:

```bash
php artisan migrate --seed
```

### Step 6: Configure the Web Server

#### Nginx Example Configuration

```nginx
server {
    listen 80;
    server_name your-domain.com;

    root /var/www/retrolist-mycms/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

Restart Nginx:
```bash
sudo systemctl restart nginx
```

### Step 7: Test the Application

Visit the application in your browser:
```
http://your-domain.com
```

---

## Deployment

1. Set up a production environment by running:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   npm run build
   ```

2. Ensure file permissions are correct:
   ```bash
   sudo chown -R www-data:www-data storage bootstrap/cache
   ```

3. Set up SSL using Let’s Encrypt:
   ```bash
   sudo apt install certbot python3-certbot-nginx
   sudo certbot --nginx -d your-domain.com
   ```

---

## Contributing

1. Fork the repository.
2. Create a feature branch:
   ```bash
   git checkout -b feature-name
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add feature-name"
   ```
4. Push to the branch:
   ```bash
   git push origin feature-name
   ```
5. Open a Pull Request.

---

## License

RetroList MyCMS is open-source software licensed under the [MIT License](LICENSE).

---

## Contact

For questions or support, contact [PalokosDev](https://github.com/PalokosDev).
