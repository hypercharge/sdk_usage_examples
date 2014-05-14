hypercharge examples
====================

Dummy command line example scripts using the hypercharge SDK.

Tested on OSX

General Setup
=============

Hypercharge support creates a test-account and sends you login, password and channel.

In the root folder copy the file `credentials.json.example` to `credentails.json`
```sh
$ cp credentials.json.example credentails.json
```

open `credentails.json` in your text editor and replace the example values with your login, password and channel.

Note: your `credentials.json` file is secret! never push it to git or any cvs.

PHP
===
all php stuff is in the `/php` directory.
so go there first
```sh
$ cd php
```

install dependencies
```sh
$ composer install
```

show installed packages
```sh
$ composer show -i
```

run an example
```sh
$ php src/wpf_create.php
```
this should open hypercharge WFP (Web Payment Form) in your webbrowser.



