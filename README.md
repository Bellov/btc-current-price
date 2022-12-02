<a href="https://ibb.co/BwbBgtJ"><img src="https://i.ibb.co/BwbBgtJ/Screenshot-2022-12-02-214917.jpg" alt="Screenshot-2022-12-02-214917" border="0"></a>


<a href="https://ibb.co/xMCDPSm"><img src="https://i.ibb.co/xMCDPSm/Screenshot-2022-12-02-215038.jpg" alt="Screenshot-2022-12-02-215038" border="0"></a>


<a href="https://ibb.co/q781GsH"><img src="https://i.ibb.co/q781GsH/Screenshot-2022-12-02-215524.jpg" alt="Screenshot-2022-12-02-215524" border="0"></a>


## Laravel WebApp for show BTC price today
Setup:
**1. Clone the repository**

 ```bash
git clone https://github.com/Bellov/btc-current-price
```

**2. Configure MariaDB database**

```bash
CREATE DATABASE btc_tracker
```
```bash
GRANT ALL PRIVILEGES ON DATABASE parking TO your 'user name';
```

```bash
\q
```

**3.  Run the application**

#### Mac Os, Ubuntu and windows users continue here:

* Open the console and cd your project root directory

```bash
composer install
```

```bash
php artisan key:generate
```

```bash
npm install
```

```bash
npm run dev
```

* Then open `.env` and change username and password  as per
MariaDB installation.

```bash
DB_CONNECTION=pgsql
DB_HOST=hostname
DB_PORT=5432
DB_DATABASE=Your database name
DB_USERNAME=Your database username
DB_PASSWORD=Your database password
```

```bash
php artisan migrate
```

```bash
php atisan get-btc-price
```

```bash
php artisan serve
```

```bash
php artisan queue:work
```
### You can now access the project at localhost:8000/login

[Login Page](http://127.0.0.1:8000/login)

* The project have queues for
1. Fetch data from Bitfinex to get btc price (every one minute)
2. Each time the price goes above the limit set by the user, he will  be notified via email: ( every one minute)

## Tool:
 [Mailtrap](https://mailtrap.io/)

* To setup mailtrap just write your user_name / password from the website in `.env`

```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=username
MAIL_PASSWORD=password
MAIL_ENCRYPTION=tls
```
