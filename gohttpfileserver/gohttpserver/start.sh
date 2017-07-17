#!/bin/bash 
./gohttpserver  --addr 8000 --root /home/dangjianfiles &
./gohttpserver  --addr 8001 --root /home/dangjianfiles --upload &