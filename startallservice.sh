#!/bin/bash

sleep 1s
forever stopall
sleep 1s

ps -ef | grep gohttpserver | grep -v grep | cut -c 9-15 | xargs kill -s 9
ps -ef | grep sails | grep -v grep | cut -c 9-15 | xargs kill -s 9
echo "========================="
echo "========================="
echo "========================="
echo "will start rewrite the confilg file, if you change the 'localhost' or database config to others, please do it manually again...."

sleep 2s

sed -i 's/localhost/www.zgzyfy.com/' ./pc/index.php
sed -i 's/localhost/www.zgzyfy.com/' ./pc/configreader.php
sed -i 's/localhost/www.zgzyfy.com/' ./wp/wp-content/themes/Unite/header.php
sed -i 's/localhost/www.zgzyfy.com/' ./gohttpfileserver/gohttpserver/res/index.tmpl.html


sed -i "s/('DB_USER', 'root')/('DB_USER', 'demo_user')/" ./wp/wp-config.php
sed -i "s/('DB_PASSWORD', '')/('DB_PASSWORD', 'demo_user@luobo')/" ./wp/wp-config.php
sed -i "s/('DB_HOST', 'localhost')/('DB_HOST', '192.168.6.10:6000')/" ./wp/wp-config.php

chmod -R +x pc/

forever start -e ./resterr.log 	./rest/service/app.js
cd ./gohttpfileserver/gohttpserver && ./gohttpserver  --addr 8000 --root /home/dangjianfiles &
cd ./gohttpfileserver/gohttpserver && ./gohttpserver  --addr 8001 --root /home/dangjianfiles --upload &
