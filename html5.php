
1, 拖拽
	在拖拽进行时,被拖拽物会发生如下事件
	// 拖拽开始
	oDrag.ondragstart=function (oDragEv){

	}

	// 拖拽过程中
	oDrag.ondrag=function (oDragEv){

	}

	// 拖拽完成后
	oDrag.ondragend=function (oDragEv){

	}

	// 投放区的事件

	// 当拖拽的物体进行到投放区时
	oTar.ondragenter=function (oE){

	}

	// 当拖拽体在投放区移动时
	oTar.ondragover=function (oE){

		oE.stopPropagation();
		oE.preventDefault();
	}

	// 当拖拽体投放到投放区时
	oTar.ondrop=function (oE){
		oE.stopPropagation();
		oE.preventDefault();
	}

	// 当拖拽体离开投放区时
	oTar.ondragleave=function (oE){

	}


2, 异步上传
	a, 创建表单对象
	var oForm=new FormData();
	oForm.append('name 值','内容');

3, 多媒体
	html5 的 video 元素支持的视频格式
		ogg:
		mpeg4:
		WebM

	3.1, video 的属性:

		autoplay : autlplay : 如果出现该属性,则该视频在就绪后马上播放;

		controls : controls : 如果出现该属性,则向用户显示控件,比如播放按钮;

		height : 像素: 设置视频播放器的高度

		loop  : loop : 如果出现该属性,则当媒介文件完成播放后,再次开始播放;

		preload : preload : 如果出现该属性,则视频在页面加载时进行加载,并预备播放;如果使用 'autoplay',则会忽略该属性;

		poster : 图片地址; 显示默认图片,而不是视频的第一帧;

		src : url : 播放的视频的 url

		width : 像素: 设置视频的播放的宽度;


		video 的 API方法:
			a, addTextTrack()
				向音频/视频添加新的文本轨道(目前没有浏览器支持)

			b, canPlayType()
				检测浏览是否能播放指定的音频/视频类型;

			c, load()
				重新加载音频/视频元素

			d, play()
				开始播放音频/视频

			e, requestFullScreen()
				全屏:
					webkit 内核: webkitRequestFullScreen();
					moz 内核: mozRequestFullScreen();

			f, document.exitFullScreen()
				退出全屏:
					webkit 内核: webkitRequestFullScreen();
					moz 内核: mozRequestFullScreen();

			g, pause()
				暂停当前播放的音频/视频

		video API属性:
			a, audioTracks 返回表示可用音轨的 audioTrackList 对象

			b, autlplay 设置或返回是否在加载完成后立即播放

			c, buffered 返回表示音频/视频缓冲部分的 timeRanges 对象

			


	3.2, source 标签
		音频文件提供至少两种不同的解码器才能覆盖所有支持 html5 的浏览器,
		如同对视频元素的处理一样,需要使用 source 元素来实现该功能;
		一个 audio 元素能包含多种 source 元素,因此可以为音频提供多种格式支持;

		属性:
		media : media 定义媒介资源的类型,供浏览器决定是否下载;
		src : url: 媒介的 url;
		type : 数值: 定义播放在音频流中的什么位置开始播放;默认是从开关播放;

4, 表单
	4.1
		把表单元素放在 <form> 之外
		<form action="" id="login_form"></form>
		<input type="text" name="user_name" form="login_form" />

	4.2, 必填属性
		required
		<input type="text" required />

	4.3, type 的值
		email:
		url:
		date:
		time:
		month:
		datetime:
		datetime-local:
		number:
			属性: max:最大值;
				  min:最小值
		range:


	4.4, 属性
		autofocus="true" // 自动获取焦点
