#!/usr/bin/env bash

if [ ! -f .env ]; then
    echo -e >&2 "\e[41m\n\n .env is not available please run this script in the correct directory\n \e[0m\n"; exit 1;
fi

echo -e >&2 "------ Creating log folder ------";
docker-compose exec api-server mkdir -p var/log/
docker-compose exec api-server chmod -R 777 var/
echo -e >&2 "------ Log folder created ------";

echo -e >&2 "------ Starting cron ------";
docker-compose exec api-server echo "*/1 * * * * /usr/local/bin/php /var/www/html/bin/console room:preprocess >> /var/www/html/var/log/cron.log" >> jobs.txt
docker-compose exec api-server crontab jobs.txt
docker-compose exec api-server cron
docker-compose exec api-server rm jobs.txt
echo -e >&2 "------ Cron started ------";

echo -e >&2 "------ Executing room:preprocess command ------";
docker-compose exec api-server /usr/local/bin/php /var/www/html/bin/console room:preprocess
echo -e >&2 "------ room:preprocess command executed ------";

exit 0;