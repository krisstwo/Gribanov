Installation:
```bash
composer install
```

```bash
php bin/console doctrine:schema:create
```

```bash
php bin/console doctrine:migrations:migrate
```

Run the app:
```bash
symfony server:start
```

Access the app:
```bash
https://localhost:8000/admin
```
Demo creds: `admin / admin`

Use the sample database:
```bash
mv sample.db var/data.db
```
TODO use fixtures