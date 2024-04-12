# Ecommerce-Tenancy

## Installation
<p>Clone this Repository with</p>

```bash
git clone git@github.com:programmermunna/ecommerce-tenancy.git
```
Then.

```bash
    cp .env.example .env
```

Otherwise, Please copy the content of .env.example and place it in .env
file.

#### Regular Setup Without Docker

Replace the Values in .env file to your credentials

execute

install application dependencies.
```bash
    composer install
```
generate project key.
```bash
    php artisan artisan key:generate
```
migrate database and seed database with test data.
```bash
    php artisan migrate --seed
```
to run the application tests, use.
```bash
    php artisan test
```
bootup local server for development
```bash
    php artisan serve
```

#### Setup with docker
<p>On the Project root directory, run the commands</p>

```bash
    make setup-application
```
```bash
    make migrate-database
```
The above commands will install all dependency and perform all necessary
application setup processes.

to seed the database, simply use
```bash
    make artisan-command p=db:seed
```
<hr>

# Important Notes:
* PLEASE DO NOT MERGE ANY BRANCH WITH FAILED TESTS.

To check if test passes,
click on action tab, check that all test has passed before merging


after that, visit you can view the application on your local machine
with http://127.0.0.1:8000

# Deveoper Munna:
Address: Belkuchi,Sirajganj,Bangladesh
Portfolio: munna.twinklerain.com
Mail: programmermunna@gmail.com
Github: github.com/programmermunna
WhatsApp: +8801938031025

Thanks.
