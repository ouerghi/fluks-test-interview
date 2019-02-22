

getQuestion
===========


Install
-------

Use `composer`

- https://getcomposer.org/download/

```
$ composer install
```


Usage
-----

Count number of questions about *pompe* topic:

```
$ php getQuestion.php count pompe
```

result:

```
count for 'pompe' = 300
```

Unit tests
----------

To run unit tests:

```
$ ./vendor/bin/phpunit QuestionTest.php
```

TODO
----
###PHP

Your mission : implement the 'list' feature (see below).

Feel free to improve the code quality and code coverage.

-- Uncle Bob ;-)



List titles of questions about *pompe* topic:

```
$ php getQuestion.php list pompe
```

expected result: 

- the list of question titles on the first page of result 
- with a count of item and the total count of results (ex : (30/300))


```
Titles for 'pompe' (30/300):
- Cherche pompe pour prélèvement d’eau dans piézomètre
- Pompe immergée de forage et variateur de vitesse
- ...
```

###VueJS

Implemnt the same behavior using a VueJS component.  

Feel free to have a good code quality.