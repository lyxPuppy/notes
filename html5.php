
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

5, 地理位置(widnow.navigator.geolocation)
	5.1, getCurrentPosition(success,error,options)
		该方法是实现地理定位的核心方法,该方法能够对获取到的信息作出处理以及设置
		success(position): 获取信息成功的回调函数
		error(errorCode) 获取信息失败的回调函数
		options 获取信息前可以执照指定需求来设置一些参数

		5.1.1, 获取成功传给回调的参数
			{
				coords.latitude, // 纬度
				coords.longitude, // (经度)
				coords.altitude, // 海拔
				coords.accuracy, // 位置精确度
				coords.altitudeAccuracy, // 海拔精确度
				coords.heading, // 朝向
				coords.speed, // 速度
				timestamp, // 响度的日期/时间
			}

		5.1.2, options={
				enableHighAccuracy:, // 表示是否允许用高精度,但这个参数在很多设备上设置了都没有
				timeout:, // 指定超时时间
				maximumAge: // 指定缓存的时间
			};
6, Canvas
	6.1, Canvas 默认的尺寸是:300*150;背景颜色:白色;
	
	6.2, 获取绘图环境
		var canvas=document.getElementById('canvas'),
		canvasContext=canvas.getContext('2d'); // 这里获取绘图环境

	6.3, 颜色值
		a, 直接用颜色名称:red,blue;
		b, 十六进制颜色值: #aaaaaa;
		c, rgb(1-255,1-255,1-255);
		d, rgba(1-255,1-255,1-255,透明度[0-1]);

	6.4, 画图
		6.4.1, 矩形
			参数:
				x : x 坐标;
				y : y 坐标;
				w : 宽度;
				h : 高度;

			rect(x,y,w,h) : 创建矩形
			fillRect(x,y,w,h) : 绘制'被填充'的矩形;
			strokeRect(x,y,w,h) : 绘制矩形(无填充)

	6.5, 颜色的属性
		fillStyle : 设置 或 返回用于填充绘画的颜色,渐变,或模式; 如: fillStyle='#aaa';

		strokeStyle : 设置 或 返回用于笔触的颜色,渐变或模式

		shadowColor : 设置 或 返回用于阴影的颜色

		shadowBlur : 设置 或 返回用于阴影模糊级别

		shadowOffsetX : 设置 或 返回阴影矩形关的水平距离

		shadowOffsetY : 设置 或 返回阴影距形状的垂直距离

	6.6, 颜色的方法
		createLinearGradient(开始坐标x,开始坐标y,结束坐标x,结束坐标y) : 创建线性渐变(用在画布内容上)

		createPattern(图片对象,'repeat[repeat-x,repeat-y]') : 在指定的方向重复指定元素

		createRadialGradient(开始圆心x,开始圆心y,开始圆的半径,结束圆心x,结束圆心y,结束圆的半径) : 创建放射状/环形的渐变(用在画布内容上)

		addColorStop(位置值,颜色值) : 规定渐变对象中的颜色和停止位置

	6.7, 路径
		canvas.rect(0,0,100,100);
		canvas.stroke(); // 画图
		canvas.fill(); // 画填充的矩形