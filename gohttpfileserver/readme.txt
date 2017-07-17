
1. 将所有文件copy到@gopath目录下，比如windows上的
	C:\GOPATH\src\github.com\codeskyblue\gohttpserver
   或用mklink /J来建立连接。
2. 执行
	go build
	gohttpserver --root c:/go --upload (修改要上传文件的目录)
3. 打开   http://localhost:8000/
	可以查看结果。
	
	
安装前需要
1. 安装git

2. 安装如下插件
	go get github.com/golang/net
	go get github.com/gorilla/mux
	go get github.com/mash/go-accesslog
	go get github.com/gorilla/sessions
	go get github.com/gorilla/handlers
	go get github.com/goji/httpauth
	go get github.com/go-yaml/yaml
	go get github.com/codeskyblue/dockerignore
	go get github.com/alecthomas/kingpin
	go get github.com/DHowett/go-plist
	go get github.com/codeskyblue/openid-go

可以启动两个服务：8000给普通用户，8001为管理员后端。
gohttpserver --addr 8000 --root c:/go
gohttpserver --addr 8001 --root c:/go --upload
	

C:\Users\yanglf\go\src\golang.org\codeskyblue\gohttpserver

