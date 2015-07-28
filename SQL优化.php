
1, 当表的酆引擎是 myISAM 时,在删除的表的记录的时候,存储的文件大小不会发生变化;
所以要定时对 myISAM 类型的表进行碎片整理:
optimize table 表名;

2, mysql 备份的语句
	a,在 cmd: mysqldump -u用户名 -p密码 数据库名 [表名1 表名2 ....] > 保存路径

	使用备份文件恢复数据:
	在 mysql 控制台下: source 文件路径;


	b, 使用定时器来完成备份
		把备份数据库的指令写入到 bat 文件,然后通过任务管理器(windows) 或 crontab(Linux) 定时调用 bat 文件;

		*.bat:
			"mysqldump 的绝对路径(如果路径中有空格,则要加 引号,如果没有,则可以不加引号;)" -u用户名 -p密码 数据库名 [表名2 表名2 ...]>路径


三, 分表原则
	1, 例如分割成3个表:
		根据用户 id%3=值;根据计算出来的值来读取数据

		测试表:
			CREATE TABLE `user_0`(
				`user_id` INT UNSIGNED PRIMARY KEY NOT NULL DEFAULT 0,
				`user_name` VARCHAR(64) NOT NULL DEFAULT '',
				`user_pwd` CHAR(32) NOT NULL DEFAULT ''
			) DEFAULT CHARSET=UTF8 ENGINE=MYISAM;

			CREATE TABLE `user_1`(
				`user_id` INT UNSIGNED PRIMARY KEY NOT NULL DEFAULT 0,
				`user_name` VARCHAR(64) NOT NULL DEFAULT '',
				`user_pwd` CHAR(32) NOT NULL DEFAULT ''
			) DEFAULT CHARSET=UTF8 ENGINE=MYISAM;

			CREATE TABLE `user_3`(
				`user_id` INT UNSIGNED PRIMARY KEY NOT NULL DEFAULT 0,
				`user_name` VARCHAR(64) NOT NULL DEFAULT '',
				`user_pwd` CHAR(32) NOT NULL DEFAULT ''
			) DEFAULT CHARSET=UTF8 ENGINE=MYISAM;


			CREATE TABLE `user_user_id`(`id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT) ENGINE=MYISAM;

四, 数据库参数配置:
	1,最重要的参数就是内存,我们主要用的 INNODB 引擎,所以下面两个参数凋的很大:
		innodb_additional_mem_pool_size=64M
		innodb_buffer_pool_size=1G

	2, 对于 myisam , 需要调整 key_buffer_size
	当然调整参数还是要看状态,用 show status 语句可以看到当前状态,以决定调整哪些参数

	3, 在 my.ini 修改端口 3306, 默认储存引擎 和 最大链接数;


五, 增量备份
	1, 定义:
		mysql 数据库会以二进制的形式,自动把用户对 mysql 数据库的操作记录到文件,当前用户希望恢复的时候
		可以使用备份文件进行恢复

	2, 增量备份会记录(dml语句,创建表的语句,不会记录 select 语句)
	3, 记录的信息: a, 操作语句的本身; b,操作的时间;c:position

	4, 启用增量备份
		配置 my.ini 或 my.conf, 来启用二进制(增量)备份
		增量备份在 5.0 之前是不支持的; 在 5.1 之后才支持;

		如果是 my.ini:
			找到 [mysqld] 模块,在里面加入:
				log-bin=保存文件的路径

	5, 查看备份文件的内容
		使用 mysqlbinlog 来查看备份文件的内容
		进入 cmd: mysqlbinlog 备份文件的路径

		#INSERT INTO `news`(`title`,`content`) VALUES('AA','BBBB');

	6, 恢复
		可以根据位置 或 时间点来恢复

		a, 根据时间点来恢复
			mysqlbinlog --stop-datetime="2015-5-20 21:41:05" 备份文件路径 | mysql -uroot -p
			mysqlbinlog --start-datetime="2015-5-20 21:41:05" 备份文件路径 | mysql -uroot -p

			某个时间段
			mysqlbinlog --start-datetime="2015-5-20 21:41:05" --stop-datetime="2015-5-20 21:41:31" 备份文件的路径 | mysql -uroot -p

		b, 根据位置来恢复
			mysqlbinlog --stop-position="位置值" 备份文件的路径 | mysql-uroot -p
			mysqlbinlog --start-position="位置值" 备份文件的路径 | mysql-uroot -p
