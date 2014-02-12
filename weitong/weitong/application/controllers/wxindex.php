<?php

/*
 * 微信公众平台自定义文件  
 */

/**
 * TOKEN验证
 */
define("TOKEN", "weixin"); //定义token值 。
$wechatObj = new wxApi();
$wechatObj->responseMsg();


//$wechatObj->valid();

class wxApi {
	//以下三个变量通过公众账号微信官网开发模式下获取。
	private $TOKEN ;
	private $AppID ;
	private $AppSecret ;
	/**
	 * 验证签名
	 *
	 * @return mixed This is the return value description
	 *
	 */	
	public function valid()
	{
		$echoStr = $_GET["echostr"];

		//valid signature , option
		if($this->checkSignature()){
			echo $echoStr;
			exit;
		}
	}  
	public function responseMsg() {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

		//extract post data
		if (!empty($postStr)) {

			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj->FromUserName;
			$toUsername = $postObj->ToUserName;
			$RX_TYPE = trim($postObj->MsgType);
			$time = time();

			switch ($RX_TYPE) {
				case "text":
					$resultStr = $this->handleText($postObj);
					break;
				case "event":
					$resultStr = $this->handleEvent($postObj);
					break;
				default:
					$resultStr = "Unknow msg type: " . $RX_TYPE;
					break;
			}
			echo $resultStr;
		} else {
			echo "";
			exit;
		}
	}

	

	public function responseText($object, $content, $flag = 0) {
		$textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>%d</FuncFlag>
                    </xml>";
		$resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
		return $resultStr;
	}

	private function checkSignature() {
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];

		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);

		if ($tmpStr == $signature) {
			return true;
		} else {
			return false;
		}
	}

	public function handleNews($postObj) {//最近活动
		$fromUsername = $postObj->FromUserName;
		$toUsername = $postObj->ToUserName;
		$time = time();
		$textTpl = "<xml>
 					<ToUserName><![CDATA[%s]]></ToUserName>
 					<FromUserName><![CDATA[%s]]></FromUserName>
 					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
 					<ArticleCount>3</ArticleCount>
 					<Articles>
 						<item>
 							<Title><![CDATA[%s]]></Title> 
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
 						<item>
 							<Title><![CDATA[%s]]></Title>
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
						<item>
 							<Title><![CDATA[%s]]></Title>
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
 					</Articles>
 					<FuncFlag>1</FuncFlag>
 				</xml>";
		$title1 = "IAP 雄起，传统服务App 已死？！";
		$Description1 = "1";
		$PicUrl1 = "http://tankr.net/s/medium/44Y9.jpg";
		$Url1 = "http://jandan.net/2013/10/09/paid-apps-arent-dead.html";

		$title2 = "米尔格伦的「服从权威实验」的真相";
		$Description2 = "2";
		$PicUrl2 = "http://tankr.net/s/medium/RRP3.jpg";
		$Url2 = "http://jandan.net/2013/10/09/truth-of-the-milgram.html";

		$title3 = "为什么说压力会让你吃得更多";
		$Description3 = "3";
		$PicUrl3 = "http://tankr.net/s/medium/QBQM.jpg";
		$Url3 = "http://jandan.net/2013/10/09/does-stress-make-you-hungry.html";

		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $title1, $Description1, $PicUrl1, $Url1, $title2, $Description2, $PicUrl2, $Url2, $title3, $Description3, $PicUrl3, $Url3);
		echo $resultStr;
	}

	public function handleHotNews($postObj) {//热门推荐
		$fromUsername = $postObj->FromUserName;
		$toUsername = $postObj->ToUserName;
		$time = time();
		$textTpl = "<xml>
 					<ToUserName><![CDATA[%s]]></ToUserName>
 					<FromUserName><![CDATA[%s]]></FromUserName>
 					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
 					<ArticleCount>3</ArticleCount>
 					<Articles>
 						<item>
 							<Title><![CDATA[%s]]></Title> 
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
 						<item>
 							<Title><![CDATA[%s]]></Title>
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
						<item>
 							<Title><![CDATA[%s]]></Title>
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
 					</Articles>
 					<FuncFlag>1</FuncFlag>
 				</xml>";
		$title1 = "超级英雄为儿童医院刷墙";
		$Description1 = "1";
		$PicUrl1 = "http://tankr.net/s/medium/YSFI.jpg";
		$Url1 = "http://jandan.net/2013/10/08/superhero-window-washers.html";

		$title2 = "罪犯乐园：委内瑞拉圣安东尼监狱";
		$Description2 = "2";
		$PicUrl2 = "http://tankr.net/s/medium/SYYY.jpg";
		$Url2 = "http://jandan.net/2013/10/08/venezuelas-paradise.html";

		$title3 = "女摄影师的孕期自拍";
		$Description3 = "3";
		$PicUrl3 = "http://ww1.sinaimg.cn/mw600/6d050af1gw1e9dmlbze8fj20go0p0q68.jpg";
		$Url3 = "http://jandan.net/2013/10/08/sophie-starzenski.html";

		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $title1, $Description1, $PicUrl1, $Url1, $title2, $Description2, $PicUrl2, $Url2, $title3, $Description3, $PicUrl3, $Url3);
		echo $resultStr;
	}

	public function handleText($postObj) {//根据关键词回复
		$fromUsername = $postObj->FromUserName;
		$toUsername = $postObj->ToUserName;
		$keyword = trim($postObj->Content);
		$Location_X = $postObj->Location_X;
		$time = time();
		$city = array('北京', '朝阳', '顺义', '怀柔', '通州', '昌平', '延庆', '丰台', '石景山', '大兴', '房山', '密云', '门头沟', '平谷', '八达岭', '佛爷顶', '汤河口', '密云上甸子', '斋堂', '霞云岭', '北京城区', '海淀', '天津', '宝坻', '东丽', '西青', '北辰', '蓟县', '汉沽', '静海', '津南', '塘沽', '大港', '武清', '宁河', '上海', '宝山', '嘉定', '南汇', '浦东', '青浦', '松江', '奉贤', '崇明', '徐家汇', '闵行', '金山', '石家庄', '张家口', '承德', '唐山', '秦皇岛', '沧州', '衡水', '邢台', '邯郸', '保定', '廊坊', '郑州', '新乡', '许昌', '平顶山', '信阳', '南阳', '开封', '洛阳', '商丘', '焦作', '鹤壁', '濮阳', '周口', '漯河', '驻马店', '三门峡', '济源', '安阳', '合肥', '芜湖', '淮南', '马鞍山', '安庆', '宿州', '阜阳', '亳州', '黄山', '滁州', '淮北', '铜陵', '宣城', '六安', '巢湖', '池州', '蚌埠', '杭州', '舟山', '湖州', '嘉兴', '金华', '绍兴', '台州', '温州', '丽水', '衢州', '宁波', '重庆', '合川', '南川', '江津', '万盛', '渝北', '北碚', '巴南', '长寿', '黔江', '万州天城', '万州龙宝', '涪陵', '开县', '城口', '云阳', '巫溪', '奉节', '巫山', '潼南', '垫江', '梁平', '忠县', '石柱', '大足', '荣昌', '铜梁', '璧山', '丰都', '武隆', '彭水', '綦江', '酉阳', '秀山', '沙坪坝', '永川', '福州', '泉州', '漳州', '龙岩', '晋江', '南平', '厦门', '宁德', '莆田', '三明', '兰州', '平凉', '庆阳', '武威', '金昌', '嘉峪关', '酒泉', '天水', '武都', '临夏', '合作', '白银', '定西', '张掖', '广州', '惠州', '梅州', '汕头', '深圳', '珠海', '佛山', '肇庆', '湛江', '江门', '河源', '清远', '云浮', '潮州', '东莞', '中山', '阳江', '揭阳', '茂名', '汕尾', '韶关', '南宁', '柳州', '来宾', '桂林', '梧州', '防城港', '贵港', '玉林', '百色', '钦州', '河池', '北海', '崇左', '贺州', '贵阳', '安顺', '都匀', '兴义', '铜仁', '毕节', '六盘水', '遵义', '凯里', '昆明', '红河', '文山', '玉溪', '楚雄', '普洱', '昭通', '临沧', '怒江', '香格里拉', '丽江', '德宏', '景洪', '大理', '曲靖', '保山', '呼和浩特', '乌海', '集宁', '通辽', '阿拉善左旗', '鄂尔多斯', '临河', '锡林浩特', '呼伦贝尔', '乌兰浩特', '包头', '赤峰', '南昌', '上饶', '抚州', '宜春', '鹰潭', '赣州', '景德镇', '萍乡', '新余', '九江', '吉安', '武汉', '黄冈', '荆州', '宜昌', '恩施', '十堰', '神农架', '随州', '荆门', '天门', '仙桃', '潜江', '襄樊', '鄂州', '孝感', '黄石', '咸宁', '成都', '自贡', '绵阳', '南充', '达州', '遂宁', '广安', '巴中', '泸州', '宜宾', '内江', '资阳', '乐山', '眉山', '凉山', '雅安', '甘孜', '阿坝', '德阳', '广元', '攀枝花', '银川', '中卫', '固原', '石嘴山', '吴忠', '西宁', '黄南', '海北', '果洛', '玉树', '海西', '海东', '济南', '潍坊', '临沂', '菏泽', '滨州', '东营', '威海', '枣庄', '日照', '莱芜', '聊城', '青岛', '淄博', '德州', '烟台', '济宁', '泰安', '西安', '延安', '榆林', '铜川', '商洛', '安康', '汉中', '宝鸡', '咸阳', '渭南', '太原', '临汾', '运城', '朔州', '忻州', '长治', '大同', '阳泉', '晋中', '晋城', '吕梁', '乌鲁木齐', '石河子', '昌吉', '吐鲁番', '库尔勒', '阿拉尔', '阿克苏', '喀什', '伊宁', '塔城', '哈密', '和田', '阿勒泰', '阿图什', '博乐', '克拉玛依', '拉萨', '山南', '阿里', '昌都', '那曲', '日喀则', '林芝', '台北县', '高雄', '台中', '海口', '三亚', '东方', '临高', '澄迈', '儋州', '昌江', '白沙', '琼中', '定安', '屯昌', '琼海', '文昌', '保亭', '万宁', '陵水', '西沙', '南沙岛', '乐东', '五指山', '琼山', '长沙', '株洲', '衡阳', '郴州', '常德', '益阳', '娄底', '邵阳', '岳阳', '张家界', '怀化', '黔阳', '永州', '吉首', '湘潭', '南京', '镇江', '苏州', '南通', '扬州', '宿迁', '徐州', '淮安', '连云港', '常州', '泰州', '无锡', '盐城', '哈尔滨', '牡丹江', '佳木斯', '绥化', '黑河', '双鸭山', '伊春', '大庆', '七台河', '鸡西', '鹤岗', '齐齐哈尔', '大兴安岭', '长春', '延吉', '四平', '白山', '白城', '辽源', '松原', '吉林', '通化', '沈阳', '鞍山', '抚顺', '本溪', '丹东', '葫芦岛', '营口', '阜新', '辽阳', '铁岭', '朝阳', '盘锦', '大连', '锦州');
		if (in_array($keyword, $city)) {
			$urlstr = file_get_contents("http://sou.qq.com/online/get_weather.php?callback=Weather&city=" . $keyword);
			$strgsh = "[" . substr($urlstr, 8, -2) . "]";
			$arrayjson = json_decode($strgsh, true);
			if ($arrayjson[0]['future']['forecast'][3]['BWEA'] == $arrayjson[0]['future']['forecast'][3]['EWEA']) {
				$hwea = $arrayjson[0]['future']['forecast'][3]['BWEA'];
			} else {
				$hwea = $arrayjson[0]['future']['forecast'][3]['BWEA'] . "转" . $arrayjson[0]['future']['forecast'][3]['EWEA'];
			}
			if ($arrayjson[0]['future']['forecast'][4]['BWEA'] == $arrayjson[0]['future']['forecast'][4]['EWEA']) {
				$dhwea = $arrayjson[0]['future']['forecast'][4]['BWEA'];
			} else {
				$dhwea = $arrayjson[0]['future']['forecast'][4]['BWEA'] . "转" . $arrayjson[0]['future']['forecast'][4]['EWEA'];
			}
			$huifu = "城市：" . $arrayjson[0]['future']['name'] . "。
现在气温是" . $arrayjson[0]['real']['temperature'] . "℃。
今日天气：" . $arrayjson[0]['future']['wea_0'] . "。
温度范围：" . $arrayjson[0]['future']['forecast'][0]['TMAX'] . "~" . $arrayjson[0]['future']['forecast'][0]['TMIN'] . "℃
明天天气：" . $arrayjson[0]['future']['wea_1'] . "
后天天气：" . $arrayjson[0]['future']['wea_2'] . "
大后天的：" . $hwea . "
大大后天：" . $dhwea;
		} else if (strpos($keyword, "你好") !== false) {
			$huifu = "你也好~";
		} else if (strpos($keyword, "傻") !== false) {
			$huifu = "我不傻！哼~ ";
		} else if (strpos($keyword, "逼") !== false) {
			$huifu = "你说脏话，我叫警察叔叔来抓你！ ";
		} else if (strpos($keyword, "操") !== false) {
			$huifu = "你说脏话，我叫警察叔叔来抓你！ 哼~ ";
		} else if (strpos($keyword, "帮助") !== false) {
			$huifu = "输入城市名称查天气就好啦! 比如输入”北京“";
		} else if (strpos($keyword, "是谁") !== false) {
			$huifu = "我是微天气， 你可以叫我小微，可以叫我小天，但不要叫我小气~";
		} else if (strpos($keyword, "小气") !== false) {
			$huifu = "你才小气呐！";
		} else if ($keyword == "h" || $keyword == "H") {
			$huifu = "欢迎使用微天气，
输入城市名字（如：'北京'）并发送即可查询天气情况。
输入'H'或者'h'显示本帮助内容。
输入'冷笑话'即可查看冷笑话一枚。
输入'a'查看程序相关。
输入v查看版本号。";
		} else if ($keyword == 'a') {
			$huifu = "本程序是由Cyril 创建。 
http://cyrilis.com
欢迎提出改进意见。:)";
		} else if ($keyword == "v") {
			$huifu = "版本号:0.91";
		} else if ($keyword == "冷笑话") {
			$huifu = "冷笑话功能近期推出哟~";
		} else {
			$huifu = "太复杂了我看不懂，
说点儿我看得懂的吧，
输入城市名（如“北京”或者“青岛”）查看天气，
或输入'h'查看帮助。";
		}
		$time = time();
		$textTpl = "<xml>
                                    <ToUserName><![CDATA[" . $fromUsername . "]]></ToUserName>
                                    <FromUserName><![CDATA[" . $toUsername . "]]></FromUserName>
                                    <CreateTime>" . $time . "</CreateTime>
                                    <MsgType><![CDATA[text]]></MsgType>
                                    <Content><![CDATA[" . $huifu . "]]></Content>
                                    <FuncFlag>0</FuncFlag>
                                    </xml>";
		if (!empty($keyword)) {
			$msgType = "text";
			$contentStr = "Welcome to wechat world!";
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $textTpl;
		} else {
			$msgType = "text";
			$contentStr = "Welcome to wechat world!";
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $textTpl;
		}
	}

	public function offersQuery($object) {//优惠查询
		$fromUsername = $object->FromUserName;
		$toUsername = $object->ToUserName;
		$keyword = trim($object->Content);
		$time = time();
		$textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        
                    </xml>";
		if (!empty($keyword)) {
			$contentStr = "感谢您的使用！";
		} else {
			$contentStr = "中文请回复1，英文请回复2，日语请回复3，感谢您的关注！...";
		}
		$msgType = "text";
		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
		echo $resultStr;
	}

	public function stores($object) {//多图文显示
		$fromUsername = $object->FromUserName;
		$toUsername = $object->ToUserName;
		$time = time();
		$textTpl = "<xml>
 					<ToUserName><![CDATA[%s]]></ToUserName>
 					<FromUserName><![CDATA[%s]]></FromUserName>
 					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
 					<ArticleCount>3</ArticleCount>
 					<Articles>
 						<item>
 							<Title><![CDATA[%s]]></Title> 
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
 						<item>
 							<Title><![CDATA[%s]]></Title>
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
						<item>
 							<Title><![CDATA[%s]]></Title>
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
 					</Articles>
 					<FuncFlag>1</FuncFlag>
 				</xml>";
		$title1 = "香噹噹\n距离:139米\n位置:市中区泺源大街226号";
		$Description1 = "1";
		$PicUrl1 = "http://p1.meituan.net/460.280/deal/__21794278__2494254.jpg";
		$Url1 = "http://jn.meituan.com/deal/9469395.html?source=hao123&utm_campaign=tuan.baidu.com&utm_medium=nav&utm_source=tuan.baidu.com&utm_content=pic&_rdt=1&urpid=baidutuan_mp%7C_%7C03f98af290061216e55c2376a17af120&utm_term=baidutuan_mp%5E%5E_%5E%5E03f98af290061216e55c2376a17af120";

		$title2 = "鲁能新天地\n距离:130米\n位置:市中区经四路64号林祥大厦1、3楼";
		$Description2 = "2";
		$PicUrl2 = "http://p0.meituan.net/460.280/deal/__17461622__8748005.jpg";
		$Url2 = "http://jn.meituan.com/deal/3422379.html";

		$title3 = "澳门豆捞\n距离:200米\n位置:市中区六里山路20号";
		$Description3 = "3";
		$PicUrl3 = "http://p1.meituan.net/460.280/deal/__23527210__8788315.jpg";
		$Url3 = "http://www.meituan.com/deal/3570431.html";

		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $title1, $Description1, $PicUrl1, $Url1, $title2, $Description2, $PicUrl2, $Url2, $title3, $Description3, $PicUrl3, $Url3);
		echo $resultStr;
	}

	public function help($object) {//帮助菜单内容
		$fromUsername = $object->FromUserName;
		$toUsername = $object->ToUserName;
		$keyword = trim($object->Content);
		$time = time();
		$textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        
                    </xml>";
		if (!empty($keyword)) {
			$contentStr = "感谢您的使用！";
		} else {
			$contentStr = "又升级了！
多了一点点记忆
多了一点点情绪
===================
攻略：
--------------------------
这个最不需要介绍,您懂的
===================
优惠活动：
--------------------------
会根据心情和您的运气随机发送。
或许是热门的推荐
或许是最新的关注               
或许是名牌
或许是土豪般的屌丝装备
... ...
谁知道呢，随缘吧
===================
附近：
--------------------------
需要开启微信定位选项
跟信息和移动端同步
最新动态U惠信息根据个人位置周边依次显示
===================
优惠查询：
--------------------------
搜索“最新动态”。输入：我爱U, 将返回最新的U惠动态
--------------------------
搜索“热门U惠”。输入：大U起床啦, 将返回最新的热门U惠
--------------------------
搜索“附近U惠”。输入：顺手牵羊, 将返回最新的周边U惠
--------------------------
搜索“会员信息”。输入：大U还钱, 将返回个人的会员卡信息
===================";
		}
		$msgType = "text";
		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
		echo $resultStr;
	}

	public function subscription($object) {//单图文显示
		$fromUsername = $object->FromUserName;
		$toUsername = $object->ToUserName;
		$time = time();
		$ArticleCount = "1";

		$textTpl = "<xml>
 					<ToUserName><![CDATA[%s]]></ToUserName>
 					<FromUserName><![CDATA[%s]]></FromUserName>
 					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
 					<ArticleCount>%s</ArticleCount>
 					<Articles>
 						<item>
 							<Title><![CDATA[%s]]></Title> 
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
 					</Articles>
 					<FuncFlag>1</FuncFlag>
 				</xml>";

		$title = "点击查看首页";
		$Description = "全球最低,圆您土豪梦,没有998,只有997,坐拥小三不是梦,大U惠帮您来升华.";
		$PicUrl = "http://20131008.dinnertime.sinaapp.com/wxduh/index/img/divBg.jpg";
		$Url = "http://20131008.dinnertime.sinaapp.com/wxduh/index.html";



		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $ArticleCount, $title, $Description, $PicUrl, $Url);
		echo $resultStr;
	}

	public function handleEvent($object) {//菜单判断
		$contentStr = "";
		$key = $object->EventKey;

		if (!empty($key)) {
			if ($key == "V1001_01_01") {
				$resultStr = $this->handleHotNews($object);
			} else if ($key == "V1001_01_02") {
				$resultStr = $this->handleNews($object);
			} else if ($key == "V1001_01_03") {
				$resultStr = $this->offersQuery($object);
			} else if ($key == "V1001_01_04") {
				$resultStr = $this->stores($object);
			} else if ($key == "V1001_02_01") {
				$resultStr = $this->help($object);
			} else if ($key == "V1001_03_01") {
				$resultStr = $this->subscription($object);
			} else {
				// $contentStr = "感谢您关注【大U惠顾】111111111111";
				$resultStr = $this->subscription($object);
			}
		} else {
			$contentStr = "购物新时尚";
			$resultStr = $this->responseText($object, $contentStr);
		}
		return $resultStr;
	}

} 

?>
<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();

class wechatCallbackapiTest
{
	public function valid()
	{
		$echoStr = $_GET["echostr"];

		//valid signature , option
		if($this->checkSignature()){
			echo $echoStr;
			exit;
		}
	}

	public function responseMsg()
	{
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

		//extract post data
		if (!empty($postStr)){
			
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj->FromUserName;
			$toUsername = $postObj->ToUserName;
			$keyword = trim($postObj->Content);
			$time = time();
			$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
			if(!empty( $keyword ))
			{
				$msgType = "text";
				$contentStr = "Welcome to wechat world!";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
			}else{
				echo "Input something...";
			}

		}else {
			echo "";
			exit;
		}
	}
	
	private function checkSignature()
	{
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];	
		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>
