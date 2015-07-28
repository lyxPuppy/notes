一, 大型网站
	1.1, pv值(page views),访问量大
		
		带来的问题:
			a.流量大  --解决的方案:
		 		1, 买带宽; 
				2, 优化程序

			b, 并发量大,同时访问网站的人多
				解决方案(对程序结构重新设计):
					1, 服务器集群

	1.2, 数据量大
		解决方法:
			a, 表的合理设计;
			b, 分表技术(垂直分割, 水平分割)
			c, 建立索引
			d, 读写分离
			e, mysql 配置优化(调整最大并发量,定时对数据库进行碎片整理,备份  [crontab])
			f, 硬件升级
			g, 页面静态化
			h, 缓存技术(memcached)

二, 几个重要概念
	1, 静态网址
		比如 http://www.baidu.com/index.html; 如果我们访问的页面是静态页面,我们把这个
		url 称为静态网址
		特点:
			a, 利于 SEO (search engine optimization) 搜索引擎优化
			b, 访问速度快
			c, 防止SQL注入

	2, 动态网址
		比如 http://www.github.com/index.php; 即访问的是一个如 php 页面的网址称为为动态网址
		特点:
			a, 不利于 SEO
			b, 访问速度慢
			c, 有SQL 注入的可能

	3, 伪静态网址
		伪静态仅仅是对动态网址的一个重写,伪静态网址不可以让动态网址 '静态化',
		搜索引擎不会认为伪静态是 html 文档.其次,伪静态可取,但应把重心放在除冗余参数,规范URL,尽可能的避免重复页上,
		如: news.php?a=1&id=2 从 SEO 的角度来看,最好重写为 news-1-id2.html

		特点:
			a, 利于 SEO
			b, 防止 SQL 注入
			c, 仍然要访问数据库,速度没有变快

三, 页面静态化分类
	1, 从静态化的方式来看
		a, 真静态化
		b, 伪静态化

	2, 从范围来看
		b, 全局静态化
		b, 局部静态化(ajax + jQ)

四, apache 自带的 压力测试工具: ab.exe(apache/bin/ab.exe)
	可以用来测试网站的并发量,和某个页面的执行时间

	用法:
	利用 cmd 进入到 ab.exe 的目录,
	ab.exe -n 访问量的次数 -c 并发量(一次模拟多少人访问)  访问的地址


	ab.exe -n 10000 -c 100 http://127.0.0.1/yii/test/index.php?r=test

五, 如何调整 apache 的最大并发量
	MPM(多路处理模块,即 apache 采用怎样的方式来处理并发)
	主要有有三种方式:
		1, prefork 预处理进程方式(进程方式 )
		2, worker 工作模式(在 prefork 的基础上, 由进程再来开线程)
		3, winnt 一般在 windows 下使用,类似于 worker

	修改 apache 的最大并发数:
	步骤:
		1, 在 http.conf 文件中,把 
			# Include conf/extra/httpd-mpm.conf 
			的注释去掉
		2, 确定当前的 apache 是什么 MPM 模式
			进入到 apache/bin:
			httpd.exe -l
			在显示的信息中主要看 mpm_xxx.c

		3, 修改 httpd-mpm.conf 文件
			在 httpd-mpm.conf 中找到winnt(在 windows 一般是 winnt )
			<IfModule mpm_winnt_module>
			    ThreadsPerChild        150 # 适当把这个数量调大
			    MaxConnectionsPerChild   0
			</IfModule>
		4, 重启 apache

	 建议的配置(中型网站):
		<IfModule mpm_perfork_module>
		 	StartServers 5 # 预先启动的进程数量
		 	MinSpareServers 5
		 	MaxSpareServers 10 # 最大空闲进程数
		 	ServerLimit 1500 # 用于修改 apaceh 编程参数
		 	MaxClients  1000 # 最大并发数
		 	MaxRequestsPerChild 0 # 设置为0,说明进程不会结束. 
		</IfModule>

	(大型点的网站)
	主要调整 
	ServerLimit 
	和 
	MaxClients 
	的值

	如果再大型的网站 ,则要用负载均衡来实现, 如 nginx

六, 页面静态化的技术实现有两种方式
	1, 使用 php 自带的缓存机制(ob_*)
	2, 使用模板替换技术

七, ob_*
	在 php 5.2 以下的版本, php.ini 中的 output_buffering 默认是 关闭的.

	1, 打开 ob 缓存
		a, 在 php.ini 中配置: output_buffering=字节数 或 On
		b, 在程序中使用 ob_start();

	2, 常用 ob_* 函数
		a, ob_start() 开启缓存

		b, ob_get_contents();
			获取 ob 缓存的内容

		c, ob_clean();
			清空当前 ob 缓存中的数据

		d, ob_end_clean();
			清空当前 ob 缓存中的数据,并关闭 ob 缓存

		e, ob_end_flush();
			把 ob 缓存直接转移到程序缓存,当前的 ob 缓存中已经没有内容了,并关闭 ob 缓存


		f, ob_flush();
			把 ob 缓存的内容直接转移到程序缓存, 当前的 ob 缓存中已经没有内容了,此时 ob 缓存还是打开的

		g, flush();
			因为浏览会在内容达到一定长度时才会显示内容,所以在 flush 之前,要先输出一些空的内容
			echo str_repeat(' ',1024);
			把 ob 缓存的内容强制返回给客户端,

	3, 原则
		a, 如果 ob 缓存打开,则 输出的数据首先放在 ob 缓存中
		b, 如果是 header 信息, 就直接放在 程序缓存中
		c, 当程序执行的最后,会把 ob 缓存的数据放到程序缓存的后面,然后一次返回给客户端

八, 实现静态化
	1,方案:
		在用户第一次访问的时候生成静态页面.
		a, 在页面的开始,用 file_exists() 判断静态化文件是否存在,如果存在,则使用静态化的文件,
			如果不存在,则从数据库中读取数据,然后使用 ob_start();
		b, 在页面的结束使用 file_put_contents('路径',ob_get_contents());

		以上方法存在 bug:
			a, 就是如果数据库的数据更新了,而页面总是显示更新前的数据;
			解决方法: 在判断文件是否存在的时候,使用 filemtime() 函数判断文件内容的修改时间,
			如果大于指定的时间,则更新文件的内容;否则,还是直接访问静态化文件的内容.

			b, 在删除新闻的时候,没有删除对应的新闻文件
	
	2, 真静态的特点
		a, 优点:
			1, 有利于 SEO
			2, 访问速度快(不用 php 模块解释; 不用访问数据库)
			3, 防止 SQL 注入





九, 实现伪静态
	1, 直接使用正则来实现
	2, 使用 apache 自带的 rewrite 机制来实现

