1, 配置信息存放的位置:
	a, /etc/gitconfig 文件: 系统中对所有用户都普遍适用的配置; 若使用 git config 时, 用--system 选项,读写的就是这个文件

	b, ~/.gitconfig 文件: 用户目录下的配置文件只适用于该用户;若使用 git config 时,用 --global 选项,
	读写的就是这个文件

	c, 当前项目的 git 目录中的配置文件(也就是工作目录中的 .git/config 文件):这里的配置仅仅针对当前项目有效;
	每一个级别的配置都会覆盖上层的相同配置,所以 ./git/config 里的配置会覆盖 /etc/gitconfig 中同名变量

	d, 在 Windows 系统上, git 会寻找用户主目录下的 .gitconfig 文件;主目录即 $HOME 变量指定的目录,一般是 
	c:\Document and Settings\$USER ; 此外, git 还会尝试找寻 /etc/gitconfig 文件,只不过看当初 git 装在什么目录,
	就以此作为根目录来定位

2, 初次使用时的配置信息
	git config -global user.name "用户名"
	git config -global user.email "邮箱"
	# 以上两项存放在 ~/.gitconfig 文件中; c:\Document and Settings\$USER\.gitconfig 文件中

3, 查看所有 config 的变量
	git config --list
	或
	git config --global --list

4, 配置当前项目的 config
	git config 变量名 "值"
	# 保存在 .git/config 文件中

5, sumblime 的 git 插件
	http://www.cnblogs.com/owenChen/archive/2012/12/28/2837450.html

6, 有两种取得 git 项目仓库的方法
	a, 在现存的目录下,通过导入所有文件来创建新的 git 仓库;(git init)
	b, 从已有的 git 仓库克隆出一个新的镜像仓库( git clone 地址 [新的文件夹名称] )

7, 对文件进行跟踪
	git add *.php   # 代表跟踪当前目录下(包括子目录)所有的 php 文件
	git add .       # 跟踪当前目录下所有的文件
	git add a.php   # 代表跟踪当前目录下的 a.php 文件