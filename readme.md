# MailerLite subscriber management
Easy to use API with UI for managing your subscribers

### Features
1. HTTP JSON API
2. Proper requests
3. PHP7
4. Seeders/Factories for testing/local environment
5. VueJS front-end using the API
6. Rule for custom field validation
6. Rule to check if email domain is active

### Really Quick Installation
```bash
$ cp .env.example .env
$ npm install or (yarn)
$ npm run dev (or yarn run dev)
$ touch database/database.sqlite;
$ php artisan migrate --seed;
$ php artisan serve;
```

### Quick Installation (with MySQL)
Create a database before these commands

```bash
$ cp .env.example .env
$ npm install or (yarn)
$ npm run dev (or yarn run dev)
$ php artisan migrate --seed;
```

### API endpoints

*Subscribers*

    GET /subscribers # index of subscribers
    POST /subscribers # create a subscriber
    PUT/PATCH /subscribers/:id # update a subscriber
    DELETE /subscriber/:id # delete a subscriber

*Fields*

    GET /fields # index of fields
    POST /fields # create a field
    PUT/PATCH /fields/:id # update a field
    DELETE /fields/:id # delete a field
    GET /fields/:id/subscribers # index of field subscribers

### TODO
1. Refactor VueJS form fields and validation errors
2. API documentation
3. Even more tests!

### Testing

You can run the tests with:

```bash
$ vendor/bin/phpunit
```