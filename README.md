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

`credentails.json` then looks like.
```json
{
	"login"   : "f8ea102f4f998dda3261e413baa912f3bc65a6fb",
	"password": "1891ad4891010903fea7d0349e3622072473c09b",
	"channel" : "a5f82d1f7eb0d4ff2ff76120462a51dd1039e1af"
}
```
Theese 40 char hex strings are just dummies.
Replace them with your login, password and channel.

Note: your `credentials.json` file is secret! Never push it to git or any other cvs!

PHP
===
At first setup your `credentials.json` as described in [general setup](#general-setup).

All php stuff is in the `/php` directory.
So go there
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

You should be able to run an example script now:
```sh
$ php src/wpf_create.php
```
The hypercharge WFP (Web Payment Form) should be shown in your webbrowser now.



