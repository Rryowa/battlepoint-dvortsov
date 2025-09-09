Для Car добавлена защита advisory-lock + optimistic-lock, т.к авто редактируется чаще всего и связан с ценой, статусом продажи и обслуживанием, - потеря правок особенно критична + могут редактировать из разных разделов.
Dealership(Салон) - справочная сущность - изменения  редки.
Обслуживание - правки выполняются редко, чаще просто удаляют и создают новое.

```sql
CREATE DATABASE battlepoint OWNER laravel_user;
CREATE DATABASE battlepoint_test OWNER laravel_user;
```