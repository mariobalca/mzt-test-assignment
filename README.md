
# MyZenTeam code test assignment

## Description

Code challenge made for the [Laravel and Vue.js Developer](https://www.remotecompany.com/jobs/laravel-and-vuejs-developer) position of [TheRemoteCompany](https://remotecompany.com).


## Instructions to run locally (with Docker)
First clone the repo with the following command

```
git clone git@github.com:mariobalca/mzt-test-assignment.git
```

Then change directory into that folder and install some vendor dependencies (especially [Laravel Sail](https://laravel.com/docs/9.x/sail#introduction)), running the following command

```
cd mzt-test-assignment
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Now you can start the Postgres and Laravel containers with 

```
docker compose up
```

The app will be accessible at http://localhost:800

### To run migrations (or any other command inside the Laravel container)

```
docker compose exec laravel [command]
```

The `[command]` can be (for example):
- `php artisan migrate --seed` 
- `php artisan test`
- `npm run watch`

And that should be it 🎉
