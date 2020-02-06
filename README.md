# php-rest-api-crud-auto Version 1
Test In PHP5.6 And 7.1

## Install Rest API CRUD
Edit Config in File /application/config/config.php
```
$config['base_url'] = 'http://youdomain.com/';
...
$config['db_host'] = 'localhost';
$config['db_name'] = 'admin_krothco';
$config['db_username'] = 'admin_krothco';
$config['db_password'] = 'smFkLa7N';
```
## How To Use Rest API CRUD
```
http://youdomain.com/api/v1/tables/
http://youdomain.com/api/v1/tables/id/1
http://youdomain.com/api/v1/tables/username/name
http://youdomain.com/api/v1/tables/?where=id;eq;1
```

## Prarams
```
?where=
"{id};eq;{1}" -> "="
ex: ?where=id;eq;1 

"{id};neq;{1}" -> "!="
ex: ?where=id;neq;1

"{id};neq;{1};and;{id};neq;{5}" -> "AND &&"
ex: ?where=id;neq;1;and;id;neq;5

"{id};eq;{1};or;{id};eq;{5}" -> "OR ||"
ex: ?where=id;eq;1;or;id;eq;5

";0;" -> "null"
ex: ?where=id;eq;0;

";00;" -> ""
ex: ?where=id;eq;00;

";like;" -> "LIKE"
ex: ?where=name;like;Google

";ap;" -> "%"
ex: ?where=name;like;;ap;Goo;ap;

";moreeq;" -> ">="
ex: ?where=price;moreeq;100

";lesseq;" -> "<="
ex: ?where=price;lesseq;100

";more;" -> ">"
ex: ?where=price;more;100

";less;" -> "<"
ex: ?where=price;less;100

?order=
"{id};asc" -> "Ascending"
ex: ?order=id;asc

"{id};desc" -> "Descending"
ex: ?order=id;desc

";rand" -> "Ramdom"
ex: ?order=;rand

GET Prarams
"?limit=" -> "int Or all"
ex: ?limit=10 or ?limit=all

"?order=" -> ";rand Or {id};asc"
ex: ?order=;rand or ?order=id;asc

"?where=" -> "{id};neq;{1} Or {id};neq;{1};and;{id};neq;{5}"
ex: ?where=id;neq;1 or ?where=id;neq;1;and;id;neq;5

"?value=" -> "{id},{name},{price}"
ex: ?value=id,name,price

"?in=" -> "{1},{2},{3}"
ex: ?in=1,2,3

POST Prarams
"action" -> "add Or update Or delete"

```
