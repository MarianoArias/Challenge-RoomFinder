
# Challenge - Room Finder


## Requirements 
* Docker >= 19.0


## Installation 
* Clone repository:
```
git clone git@github.com:MarianoArias/Challenge-RoomFinder.git
```


## Build and start application
> The application runs on 2 Docker containers, one for the API and one for the Redis server.
* Run following command in the project's root folder to build and start them:
```
docker-compose up --detach
```

* Create **.env.local** and set it up with environment variables. Use **.dist** file as example.


## Enable cron
> In order to improve performance, a cron runs in the background to preprocess rooms and therefore reduce response time.
* Run following command in the project's root folder to enable and run it for the first time:
```
./docker/cron-setup.sh
```


## Test 
> The API include some functional test.
* Run following commands in the project's root folder to run them:
```
docker-compose exec api-server ./bin/phpunit
```
> The first time it will take some time since it will download PHPUnit.


## Assumptions and Extras
> In case an advertiser API is down, the application will continue working, but it will not show any room or deal from that advertiser.

> The application processes and caches the response in Redis every 1 minute with a cron, that is why there may be a delay of this time when an advertiser makes a change.

> If the cron is down or not config, the application will process and cache the response in Redis for a duration of 10 minutes until it is processed and cached again when a new client hits the application again, that is why there may be a delay of this time when an advertiser makes a change.


## API

> The application exposes the following endpoint (only GET method allowed).
```
http://localhost:8585/index.php/rooms/
```
> The endpoint returns a JSON response that contain a list of hotel rooms (ordered from cheapest to most expensive) with its lowest price in the **cheapestDeal** tag. In addition, each room includes the **otherDeals** tag with different provider prices for the same room (also ordered from cheapest to most expensive).

> Example:
```
[
    {
        "hotel": {
            "name": "Hotel Number One",
            "stars": 5
        },
        "code": "ROOM-1",
        "name": "Room Number One",
        "cheapestDeal": {
            "advertiser": "Advertiser Number One",
            "net_rate": 120,
            "taxes": [
                {
                    "amount": 12,
                    "currency": "EUR",
                    "type": "TAXESANDFEES"
                }
            ],
            "total": 132
        },
        "otherDeals": [
            {
                "advertiser": "Advertiser Number Two",
                "net_rate": 130,
                "taxes": [
                    {
                        "amount": 13,
                        "currency": "EUR",
                        "type": "TAXESANDFEES"
                    }
                ],
                "total": 143
            }
        ]
    }
]
```