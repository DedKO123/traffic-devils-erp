# Taffic Devils ERP

- [Install](#install)

Prerequisites:
- Docker
## Install

1. Clone the repository:
```
git clone https://github.com/DedKO123/traffic-devils-erp.git
```
2. Navigate into the project directory:
```
cd traffic-devils-erp
```
3. Copy the .env.example file to .env:
```
cp .env.example .env
```
4. Set up your database credentials in the .env file.
5. Install the composer dependencies:
```
 composer install
```
6. Build the Docker containers:
```
./vendor/bin/sail up -d
```
7. Install the NPM dependencies:
```
./vendor/bin/sail npm i
```
8. Build the assets:
```
./vendor/bin/sail npm run dev
```

10. Generate the application key:
```
./vendor/bin/sail artisan key:generate
```
11. Run the database migrations:
```
./vendor/bin/sail artisan migrate --seed
```

12. If you want to test the password reset, don't forget to set up a test mailbox(mailtrap.io or similar)

13. Visit the application in your browser:
```
http://localhost
```
