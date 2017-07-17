1.  安装sails
	npm install sails -g
	
2.  安装model
	sails generate api XXXXX
	
3. 运行
	sails lift

API说明(完全的restful风格)
	创建一个pin
	http://www.zgzyfy.com:1337/pin/create?userID=id&pindate=date&pintime=time&onoff=on
	查找
	http://www.zgzyfy.com:1337/pin?userID=id
	更新
	http://www.zgzyfy.com:1337/pin/update/1?username=111


注：所有的id都不要进行更改和做为引用，这是数据库自增键。

administor：管理员
		字段：username, password, hospitalID

hospital：医院
		字段：hospitalID, name, lat, lon。

user：用户
		字段：userID, name, password, hospitalID. 

pin：打卡记录
		字段：userID, pindate, pintime, onoff

timetable：作息时间表
		字段：暂空

示例性数据


		
detail info:
	https://segmentfault.com/a/1190000002898071

RESTful API 设计最佳实践 【已翻译100%】
	http://www.oschina.net/translate/best-practices-for-a-pragmatic-restful-api

