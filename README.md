Для Car добавлена защита advisory-lock + optimistic-lock, т.к авто редактируется чаще всего и связан с ценой, статусом продажи и обслуживанием, - потеря правок особенно критична + могут редактировать из разных разделов.
Dealership(Салон) - справочная сущность - изменения  редки.
Обслуживание - правки выполняются редко, чаще просто удаляют и создают новое.

```shell
sudo -u postgres psql

CREATE DATABASE battlepoint OWNER laravel_user;
CREATE DATABASE battlepoint_test OWNER laravel_user;

php artisan migrate:fresh --seed --env=testing
php artisan test

php artisan migrate:fresh --seed
php artisan serve
```