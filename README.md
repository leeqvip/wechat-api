# wechat-api 微信公众平台接口


[微信公众平台技术文档](https://mp.weixin.qq.com/wiki)

### 安装

```
composer require techleeone/wechat-api
```

### 使用

```php
// 如果是使用支持composer自动加载的框架（比如thinkphp，laravel），则无需require。
require_once dirname(__FILE__) . '/vendor/autoload.php';

// 配置
$config = [
    'app_id' => 'wxef3bbdf4ed9439c5', // 开发者ID(AppID)
    'secret' => '7294422104de6147d818a09f5b4587fa', // 开发者密码(AppSecret)
    'token' => '598T8YDF1N1AS5FF45H4F', // 令牌(Token)
    'debug' => true, // 是否为调试模式，调试模式会记录日志
];

// 获取示例
$wechat = \TechOne\WechatApi\Wechat::init($config);

```

### 响应微信发送的Token验证

此处根据来自微信的请求类型，如为GET请求，会自动验证签名

若确认此次GET请求来自微信服务器，原样返回echostr参数内容，则接入生效，否则接入失败。

```php
$wechat->access();
```

### 接收普通消息&接收事件推送

此处根据来自微信的请求类型，如为POST请求，则自动接收来自微信的普通消息或事件推送

返回类型为：

TechOne\WechatApi\Messages\EventMessage

TechOne\WechatApi\Messages\ImageMessage

TechOne\WechatApi\Messages\LinkMessage

TechOne\WechatApi\Messages\LocationMessage

TechOne\WechatApi\Messages\ShortVideoMessage

TechOne\WechatApi\Messages\TextMessage

TechOne\WechatApi\Messages\VideoMessage

TechOne\WechatApi\Messages\VoiceMessage


```php
$message = $wechat->access();
```

### 被动回复用户消息

#### 回复文本消息

如果是收到的文本消息，且回复文本消息，则可在收到的消息上直接回复

回复其他类型的消息，同理。

```php
$message = $wechat->access();   
$message->content = '我收到你发的文本消息啦';
$message->response();
```

如果回复的消息类型和收到的消息类型不同，则需要初始化新的消息实例

```php
$message = $wechat->access();  
$data = [
    'ToUserName' => $message->toUserName,
    'FromUserName' => $message->fromUserName,
    'MsgType' => 'text',
    'Content' => '这是回复的内容',
];
$messageResponse = \TechOne\WechatApi\Message::load($data);
$messageResponse->response();
```

#### 回复图文消息
#### 回复图片消息
#### 回复语音消息
#### 回复视频消息
#### 回复图文消息

```php
$message = $wechat->access();  
$data = [
    'ToUserName' => $message->toUserName,
    'FromUserName' => $message->fromUserName,
    'MsgType' => 'news',
    'Articles' => [
        [
            'title' => '快速上手——我用scrapy写爬虫（一）',
            'description' => 'python的爬虫框架也很多，诸如pyspider 和 scrapy',
            'pic_url' => 'http://www.tech1024.cn/uploads/images/scrapy354.png',
            'url' => 'http://www.tech1024.cn/original/2951.html',
        ],
        [
            'title' => '保存数据到MySql数据库——我用scrapy写爬虫（二）',
            'description' => '说了如何创建项目，并爬去网站内容，下面我们说一下如何保存爬去到的数据',
            'pic_url' => 'http://www.tech1024.cn/uploads/images/scrapy354.png',
            'url' => 'http://www.tech1024.cn/original/2959.html',
        ],
        [
            'title' => 'scrapy爬取慕课网全部免费课程——我用scrapy写爬虫（三）',
            'description' => '简单用scrapy写了一个小demo，本篇文章主要目标是完整用scrapy爬取，慕课网所有免费的课程、标题、图片、地址、学习人数、难度、方向、分类、时长、评分、评论数等。',
            'pic_url' => 'http://www.tech1024.cn/uploads/images/scrapy354.png',
            'url' => 'http://www.tech1024.cn/original/2965.html',
        ],
        [
            'title' => '利用Flask和ECharts进行数据可视化——我用scrapy写爬虫（四）',
            'description' => '我们对慕课网的课程进行了爬取，本文就对数据进行统计和可视化，让这些数据更直观的展现出来。',
            'pic_url' => 'http://www.tech1024.cn/uploads/images/scrapy354.png',
            'url' => 'http://www.tech1024.cn/original/2978.html',
        ],
    ],
];
$messageResponse = \TechOne\WechatApi\Message::load($data);
$messageResponse->response();
```

### 微信网页授权

如果用户在微信客户端中访问第三方网页，公众号可以通过微信网页授权机制，来获取用户基本信息，进而实现业务逻辑。

#### 微信网页授权

```php
// 该接口已经实现：
// 第一步：用户同意授权，获取code
// 第二步：通过code换取网页授权access_token
// 可直接拉取用户信息
$userinfo = $wechat->oauth2()->userinfo();
```

### 菜单管理

#### 自定义菜单创建接口

```php
$data = [
    "button" => [
        [
            "type" => "view",
            "name" => "百度一下",
            "url"  => "https://www.baidu.com/",
        ],
        [
            "type" => "view",
            "name" => "导航",
            "url"  => "http://hao.tech1024.cn/",
        ],
        [
            "type" => "view",
            "name" => "笔记",
            "url"  => "http://www.tech1024.cn/",
        ],
    ],
];
$wechat->menu()->create($data);
```

#### 自定义菜单查询接口

```php
$wechat->menu()->get();
```

#### 自定义菜单删除接口

```php
$wechat->menu()->delete();
```

### 用户管理

#### 获取用户列表
```php
$nextOpenid = 'oeuHrwSsNAUXvLemeusYduRMFGE0'; // 下一个openid，不传从第一个开始
$result     = $wechat->user()->get($nextOpenid);
```

#### 获取用户基本信息(UnionID机制)

```php
$openid = 'oeuHrwSsNAUXvLemeusYduRMFGE0';
$result     = $wechat->user()->info($openid);
```

#### 批量获取用户基本信息

```php
$openids = [
    ["openid" => "oeuHrwSsNAUXvLemeusYduRMFGE0", "lang" => "zh_CN"],
    ["openid" => "oeuHrwTwAOT5GN6K1oPxJXyygwUU"],
];
$result = $wechat->user()->infoBatchget($openids, 'zh_CN');
```

#### 设置用户备注名

```php
$openid = 'oeuHrwSsNAUXvLemeusYduRMFGE0';
$remark = '二傻子1'; // 备注名
$result = $wechat->user()->updateremark($openid, $remark);
```

### 用户标签管理

#### 创建标签

```php
$tagName = '北京'; // 标签名
$result  = $wechat->tags()->create($tagName);
```

#### 获取公众号已创建的标签

```php
$result = $wechat->tags()->get();
```

#### 编辑标签

```php
$tagId = '101'; // 标签id
$tagName = '福建'; // 要修改为的标签名
$result     = $wechat->tags()->update($tagId, $tagName);
```

#### 删除标签

```php
$tagId = '101'; // 标签id
$result     = $wechat->tags()->delete($tagId);
```

#### 获取标签下粉丝列表

```php
$tagId      = '100'; // 标签id
$nextOpenid = 'oeuHrwSsNAUXvLemeusYduRMFGE0'; // 下一个openid 不传从第一个开始
$result     = $wechat->tags()->user($tagId);
$result     = $wechat->tags()->user($tagId, $nextOpenid);
```

#### 批量为用户打标签

```php
$tagId   = '102'; // 标签id
$openids = [
    "oeuHrwSsNAUXvLemeusYduRMFGE0",
    "oeuHrwTwAOT5GN6K1oPxJXyygwUU",
]; // 要修改标签的用户的openid
$result = $wechat->tags()->batchtagging($tagId, $openids);
```

#### 批量为用户取消标签

```php
$tagId   = '102'; // 标签id
$openids = [
    "oeuHrwSsNAUXvLemeusYduRMFGE0",
    "oeuHrwTwAOT5GN6K1oPxJXyygwUU",
]; // 要取消标签的用户的openid
$result = $wechat->tags()->batchuntagging($tagId, $openids);
```

#### 获取用户身上的标签列表

```php
$openid = "oeuHrwSsNAUXvLemeusYduRMFGE0";
$result = $wechat->tags()->idlist($openid);
```