hypercharge examples
====================

Command line example scripts and Notification handler examples using the hypercharge SDK.

Tested on OSX

General Setup
=============

Hypercharge support creates a test-account and sends you login, password and channel.
channel is only needed for Transactions. channel is not needed for WPF or mobile.

In the root folder copy the file `credentials.json.example` to `credentails.json`
```sh
$ cp credentials.json.example credentails.json
```

`credentails.json` then looks like.
```json
{
	"login"   : "f8ea102f4f998dda3261e413baa912f3bc65a6fb",
	"password": "1891ad4891010903fea7d0349e3622072473c09b",
	"channel" : "a5f82d1f7eb0d4ff2ff76120462a51dd1039e1af",
	"myShopBaseUrl": "https://abcd1234.ngrok.com"
}
```
The 40 char hex strings are just dummies.
Replace them with your login, password and channel.
`channel` value can be left blank if you do WPF or mobile Payments only.
`myShopBaseUrl` see Notifications bellow.

Note: your `credentials.json` file is secret! Never push it to git, svn or any other version control system!

Notifications
-------------
notifications are a key part of async workflows (wpf, mobile, sale_3d, ...). Hypercharge server notifies your server when a payment was processed.
We recomment using [ngrok](https://ngrok.com/) to receive notifications from Hypercharge at your local dev maschine. ngrok even can replay the notifications so you don't have to click through frontend parts over and over when developing your notification handler.

Register at ngork. You will see install instructions - easy btw. Download the ngork binary for your platform. You might like to put the `ngork` executable into a directory in your `$PATH`  e.g. `/usr/local/bin` or `$HOME/local/bin`.

enable internet forwarding to 127.0.0.1:80
```sh
$ ngrok 80
```
ngork starts and says something like
```
ngrok

Tunnel Status                 online
Version                       1.7/1.6
Forwarding                    http://2bc69ef.ngrok.com -> 127.0.0.1:80
Forwarding                    https://2bc69ef.ngrok.com -> 127.0.0.1:80
Web Interface                 127.0.0.1:4040
# Conn                        55
Avg Conn Time                 113.49ms
```
Take the `https://....ngork.com` url an replace it into your `myShopBaseUrl` in `credentials.json`:
```json
{
	...
	"myShopBaseUrl": "https://2bc69ef.ngrok.com"
}
```

Your local webserver is now accessible from the internet via e.g. `http://2bc69ef.ngrok.com`


To replay notifications with ngork use the ngork Web Interface [http://127.0.0.1:4040](http://127.0.0.1:4040).

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
/php$ composer install
```

show installed packages
```sh
/php$ composer show -i
```

You should be able to run an example script now:
```sh
/php$ php src/wpf_create.php
```
The hypercharge WFP (Web Payment Form) should be shown in your webbrowser now.



To receive notifications, install and start ngork (s. [Notifications](#notifications)).
```sh
$ ngrok 8080
```
Start the built in php webserver from the `php/src` directory (php-cli >= 5.4 required)
```sh
php/src$ php -S 127.0.0.1:8080
```
now let's see if the notification forwarding works.
```sh
php/src$ php wpf_create.php
```
fill out the form and submit (test) payment.
You will see the notification in the 127.0.0.1:8080 console a few seconds later.

Note: If `php -S 127.0.0.1:8080` doesn't work for you, ngork can forward to your local apache as well. Simply start ngork with the port of your apache (80) and serve the `php/src` directory.
```sh
$ ngork 80
```

Node.js
=======
At first setup your `credentials.json` as described in [general setup](#general-setup).

All node.js stuff is in the `/nodejs` directory.
So go there
```sh
$ cd nodejs
```

install dependencies
```sh
/nodejs$ npm install
```

show installed packages
```sh
/nodejs$ npm list
```

You should be able to run the (simple) example script now.
```sh
/nodejs$ node lib/main.js
validate with sale schema...
{ instance: { transaction_type: 'sale', transaction_id: '23423423423' },
	schema:
	 { description: 'Hypercharge sale Transaction request',
		 type: 'object',
		 '$schema': 'http://json-schema.org/draft-03/schema',
		 additionalProperties: false,
		 properties: { payment_transaction: [Object] } },
	propertyPath: 'instance',
	errors:
	 [ { property: 'instance',
			 message: 'Property transaction_type does not exist in the schema',
			 schema: [Object],
			 instance: [Object],
			 stack: 'instance Property transaction_type does not exist in the schema' },
		 { property: 'instance',
			 message: 'Property transaction_id does not exist in the schema',
			 schema: [Object],
			 instance: [Object],
			 stack: 'instance Property transaction_id does not exist in the schema' },
		 { property: 'instance.payment_transaction',
			 message: 'is required',
			 schema: [Object],
			 stack: 'instance.payment_transaction is required' } ],
	throwError: undefined }
```

TODO: add more examples

