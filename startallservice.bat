call forever stopall
call taskkill /f /im gohttpserver.exe
call forever start -e ./resterr.log 	./rest/service/app.js
call cd .\gohttpfileserver\gohttpserver\
start gohttpserver.exe  --addr 8000 --root ..\..\docs
start gohttpserver.exe  --addr 8001 --root ..\..\docs --upload
cd ..\..\