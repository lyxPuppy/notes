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

8, git bash 中文乱码
	http://ideabean.iteye.com/blog/2007367

9, 忽略某些文件
	可以创建一个名为 .gitignore 的文件,列出要忽略的文件模式,如:
	cat .gitignore
	*.[oa]
	*~

	第一行告诉 git 忽略所有以 .o 或 .a 结尾的文件;
	第二行告诉 git 忽略所有以 ~ 结尾的文件;

	要养成一开始就设置好 .gitignore 文件的习惯,以免将来误提交这类不无用的文件;

10, .gitignore 的格式规范如下:
	a, 所有空行或者以 注释号 # 开头的行都会被 git 忽略
	b, 可以使用标签的 glob 模式匹配
	c, 匹配模式最后跟斜杠(/),说明要忽略的是目录
	d, 要忽略指定模式以外的文件或目录,可以在模式前加上 ! 取反;

	所谓的 glob 模式是指 shell 所使用的简化了的正则表达式; 
	* 匹配零个或多个任意字符;
	[abc] 匹配任何一个列在广播号中的字符;
	? 只匹配一个任意字符;
	[0-9] 匹配 0 到 9 的数字;


	如:
	# 这是注释
	*.a          # 忽略所有 .a 结尾的文件
	!lib.a       # 但 lib.a 文件除外
	/TODO        # 仅仅忽略根目录下的 TODO 文件,不包括 subdir/TODO(子目录下的 TODO)
	build/       # 忽略 build/目录下所有的文件
	doc/*.txt    # 会忽略 doc/notes.txt, 但不包括 doc/server/arch.txt

11, 查看工作目录中当前文件和暂存区域快照之间的差异,也就是修改之后还没有暂存起来的变化内容
	git diff

12, 若要查看已经暂存起来的文件和上次提交时的快照之间的差异,可以使用 git diff --cached 命令;
	git 1.6.1+ 的版本还允许使用 git diff --staged , 效果是相同的;

13, 提交修改
	git commit -v   # -v 选项把修改差异的每一行添加到注释

14, 跳过 git commit 之前使用 git add (跳过使用暂存区)
	git add -a
	会把所有已跟踪的文件都提交

15, 移除文件
	a, 如果删除文件,则使用 git rm
		在使用 git rm 的时候,要注意,被删除的文件如果是新建的文件,还没有加入跟踪,
		则使用 rm 删除即可,如果使用 git rm 删除,会抛出: fatal: pathspec 'test.t' did not match any files 的错误

		如果被删除的文件已经加入了跟踪,并还没有提交,则要使用 git rm -f 删除

		如果被删除的文件已经提交,则使用 git rm 来删除

	b, 取消跟踪文件
		git rm --cached 文件路径

	d, 如果使用 git 的 glob 模型,则会递归删除
		git rm \*.t

16, 移动或重命名文件(目录)
	git mv 原文件名 新的文件名
	注意: 重命名的文件是要给 git 跟踪的文件;

17, 查看提交历史
	a, git log

	b, git log -p 查看每次提交的差异

	c, git log -数字 只查看指定数字个提交

	d, git log --pretty=
		--pretty 的值:
			oneline : 把每个提交显示在一行
			short : 只显示提交 id, 作者, 作者邮箱, 提交的注释
			full : 在 short 基础上多显示 提交都的信息
			fuller : 在 full 基础上多显示 作者的日期, 提交的日期

			format: git log --pretty=format:"%h , %an , %ar : %s"
				%H : 提交对象 (commit)的完整 哈希字串
				%h : 提交对象的简短哈希字串
				%T : 树对象(tree)的完整哈希字串
				%t : 树对象的简短哈希字串
				%P : 父对象(parent)的完整哈希字串
				%p : 父对象的简短哈希字串

				%an : 作者(author) 的名字
				%ae : 作者的邮箱
				%ad : 作者修订日期(date)(可以用 -date= 选项定制格式)
				%ar : 作者修订日期,按多久以前的方式显示
				%cn : 提交者(committer)的名字
				%ce : 提交者的邮箱
				%cd : 提交日期
				%cr : 提交日期,按多久以前的方式显示
				%s  : 提交的说明
	e, git log 一些常用参数
		-p 按补丁格式显示每个更新之间的差异
		--state : 显示每次更新的文件修改统计信息
		--shortstat : 只显示 --stat 中最后的行数修改添加移除统计
		--name-only : 仅在提交信息后显示已修改的文件清单
		--name-status : 显示新增,修改,删除的文件清单
		--abbrev-commit : 仅显示 SHA-1 的前几个字符,而非所有的 40 个字符
		--relative-date : 使用较短的相对时间显示(比如: '2 weeks ago')
		--graph : 显示 ASCII 图形表示的分支合并历史
		--pretty : 使用其他格式显示历史提交信息;可用选项: online,short,full,fuller 和 format(后跟指定的格式)
		--grep : 可以使用正则匹配提交的说明
		--author : 只显示指定的作者的提交

		如果要得到同时满足两个选项搜索条件的提交,就必须使用 --all-match 选项

	f, 如果只关心某些文件或者目录的历史提交,可以在 git log 选项的最后指定它们的路径;因为是放在最后位置的选项,
		所以用两个短线(--) 隔开之前的选项和后面限定的路径名
		如: git log --grep -- test

18, 修改最后一次提交
	git commit --amend

19, 取消已经暂存的文件
	如果在 git add 的时候,把暂时不想 add 文件给 add 了,同可以使用 [git reset HEAD 文件名] 来取消暂存
	如:
		git reset HEAD test.php

20, 取消对文件的修改
	如果觉得刚才对某文件的修改完全没必要,那么该如何取消修改,回到之前的状态(也就是修改前的版本呢?)
	可以使用 git status 来得到这样的提示
	git checkout -- 文件名

21, 查看远程仓库
	a, git remote
	b, git remote -v 会把相应的值列出来 -v(verbose)

22, 添加远程仓库
	git remote add 名称 地址

23, 重命名远程仓库
	git remote rename 原名 新的名

24, 删除远程仓库
	git remote rm 名称

25, 列出所有的标签(顺序是按字母顺序排序的)
	git tag

26, 搜索指定的标签
	git tag -l '可以用正则'

27, git 使用的标签有两种类型: 轻量级的(lightweight) 和 含附注的(annotated); 轻量级标签就像是个不会
	变化的分支,实际上它就是个指向特定提交对象的引用; 而含附注标签,实际上是存储在仓库中的一个独立对象,
	它有自身的校验和信息,包含着标签的名字,电子邮件地址 和 日期,以及标签说明,标签本身也允许使用 
	GNU Privacy Guard (GPG) 来签署或验证;一般我们都建议使用含附注型的标签,以便保留相关信息;当然,如果只
	是临时性加注标签,或者不需要旁注额外信息,用轻量级标签也没问题

28, 创建含附注的标签
	git tag -a 标签名 -m "注释"
	如果在创建时没有提供 -m 参数,则会启动文本编辑器来添加注释

29, 创建轻量级标签
	git tag 标签名 [-m(可以加上注释)]

30, 后期加注标签
	可以在后期对早先的某次提交加注标签
	git tag -a 标签名 提交的哈希值(前几位即可)

31, 分享标签
	默认情况下, git push 并不会把标签传送到无端服务器上,只有通过显式命令才能分享标签到无端仓库;
	其命令格式如同推送分支,
	git push origin 标签名

	如果要一次推送所有(本地新增的)标签上去,可以使用 --tags 选项
	git push origin --tags


32, 设置别名
	git config --global alias.名称 命令

33, 查看最后一次提交 
	git log -1(这个是数字 1) HEAD

34, 创建分支
	git branch 分支名称

35, 切换分支
	git checkout 分支名称

36, 创建并切换到新建的分支
	git checkout -b 分支名

37, 在切换分支的时候,如果当前的工作目录或暂存区里有还没有提交的修改,它会和即将检出的分支产生冲突从而
	阻止 git 切换分支; 切换分支的时候最好保持一个清洁的工作区域;

