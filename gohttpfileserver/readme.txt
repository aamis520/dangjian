
1. �������ļ�copy��@gopathĿ¼�£�����windows�ϵ�
	C:\GOPATH\src\github.com\codeskyblue\gohttpserver
   ����mklink /J���������ӡ�
2. ִ��
	go build
	gohttpserver --root c:/go --upload (�޸�Ҫ�ϴ��ļ���Ŀ¼)
3. ��   http://localhost:8000/
	���Բ鿴�����
	
	
��װǰ��Ҫ
1. ��װgit

2. ��װ���²��
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

����������������8000����ͨ�û���8001Ϊ����Ա��ˡ�
gohttpserver --addr 8000 --root c:/go
gohttpserver --addr 8001 --root c:/go --upload
	

C:\Users\yanglf\go\src\golang.org\codeskyblue\gohttpserver

