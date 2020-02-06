# php-rest-api-crud-auto Version 1
Test In PHP5.6 And 7.1

## Install Rest API CRUD
Edit Config in File /application/config/config.php
```
$config['base_url'] = 'http://youdomain.com/';
...
$config['db_host'] = 'localhost';
$config['db_name'] = 'db_name';
$config['db_username'] = 'db_username';
$config['db_password'] = 'db_password';
```
## How To Use Rest API CRUD
```
http://youdomain.com/api/v1/tables/
http://youdomain.com/api/v1/tables/id/1
http://youdomain.com/api/v1/tables/username/name
http://youdomain.com/api/v1/tables/?where=id;eq;1
```
## Response Data
```
{
    "status": true,
    "data": [
        {
            "id": "4",
            "name": "Croco Oil Facia Foam",
            "cover": "803df0px1yko48k8so.jpg",
            "detail": "Test",
            "image1": "tuso3451fq8kg8ok04.jpg",
            "image2": "j2xierf5s74084kgco.jpg",
            "image3": "2ax2zkvxb39cwwowos.jpg",
            "image4": "fjicvup3gzcwwk4w8w.jpg",
            "image5": "2fohv5ob0tq88ksss4.jpg",
            "image6": "8l9ikp3u3yosskgccc.jpg",
            "image7": "ffyaucl5lfwo0cs4wg.jpg",
            "image8": "9xfa2tl04co4csg8k8.jpg",
            "image9": "57dph0t8ob4848w8s0.jpg",
            "image10": "",
            "price": "0.00"
        }
    ]
}
```
### Response No Data
```
{
    "status": false,
    "data": false
}
```
## Params GET
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

```
## Operator
```
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

```
## Order
```
?order=
"{id};asc" -> "Ascending"
ex: ?order=id;asc

"{id};desc" -> "Descending"
ex: ?order=id;desc

";rand" -> "Ramdom"
ex: ?order=;rand

```
## Get Params
```
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

```
## Post Params
```
POST Params
"action" -> "add Or update Or delete"

```
