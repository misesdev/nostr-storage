# nostr-storage
A simple blob storage for nostr use

## Use

use this service on [blob.nostroogle.org](http://blob.nostroogle.org)

## Donate 

To collaborate with the project, send sats to this lightning address:

*greatasphalt42@walletofsatoshi.com*

## Run

Build and run the app containers:

`docker-compose up -d`

Execute the migrations:

`docker exec -it my_container /bin/bash`

`php artisan migrate`

Note: Remember to configure the environment variables in the .env file 
