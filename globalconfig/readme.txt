//主要用于生成全局的配置，移动app与pc使用相同的配置。
//主要配置点包括以下几点
//  1. 各服务器的url
//  2. 各api的url.
//  3. 各页中iframe中的url. (pcurl只用于移动端需要的地方)

//"url说明": "开发可以使用localhost，但移动端无法连接，需改成内网IP地址。",
//"api字段说明": "所有的api设置放在这里，如果改动，统一改动。",
//"pages字段说明": "所有页面设置。页面名应该读取相同名的的配置, wpurl用于页内wp使用，pcurl用于app需要使用页面时",


如果发生了配置的变化，调用config.bat，会
	1. 将configreader.php和globalconfig.json放到pc目录下。
	2. 将configreader.js和globalconfig.json放到app目录下。
	3. 将API中的数据，生成php中相应的变量。