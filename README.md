# wechat-api 微信公众平台接口

### 安装

```
composer require techleeone/wechat-api
```

### 使用

```
// 如果是使用支持composer自动加载的框架（比如thinkphp，laravel），则无需require。
require_once dirname(__FILE__) . '/vendor/autoload.php';

// 配置
$config = [
    'app_id' => 'wxef3bbdf4ed9439c5', // 开发者ID(AppID)
    'secret' => '7294422104de6147d818a09f5b4587fa', // 开发者密码(AppSecret)
    'token' => '598T8YDF1N1AS5FF45H4F', // 令牌(Token)
];

// 获取示例
$wechat = \TechOne\WechatApi\Wechat::init($config);

```

### 菜单管理

#### 自定义菜单创建接口

```$xslt
$data = [
    "button" => [
        [
            "type" => "view",
            "name" => "积分兑换",
            "url"  => route('client.user.exchange'),
        ],
        [
            "type" => "view",
            "name" => "积分夺宝",
            "url"  => route('client.user.rewards'),
        ],
        [
            "type" => "view",
            "name" => "我的账户",
            "url"  => route('client.home'),
        ],
    ],
];
$wechat->menu()->create($data);
```

#### 自定义菜单查询接口

```$xslt
$wechat->menu()->get();
```

#### 自定义菜单删除接口

```$xslt
$wechat->menu()->delete();
```

### 用户管理

#### 获取用户列表
```$xslt
$nextOpenid = 'oeuHrwSsNAUXvLemeusYduRMFGE0'; // 下一个openid，不传从第一个开始
$result     = $wechat->user()->get($nextOpenid);
```

#### 获取用户基本信息(UnionID机制)

```$xslt
$openid = 'oeuHrwSsNAUXvLemeusYduRMFGE0';
$result     = $wechat->user()->info($openid);
```

#### 批量获取用户基本信息

```$xslt
$openids = [
    ["openid" => "oeuHrwSsNAUXvLemeusYduRMFGE0", "lang" => "zh_CN"],
    ["openid" => "oeuHrwTwAOT5GN6K1oPxJXyygwUU"],
];
$result = $wechat->user()->infoBatchget($openids, 'zh_CN');
```

#### 设置用户备注名

```$xslt
$openid = 'oeuHrwSsNAUXvLemeusYduRMFGE0';
$remark = '二傻子1'; // 备注名
$result = $wechat->user()->updateremark($openid, $remark);
```

### 用户标签管理

#### 创建标签

```$xslt
$tagName = '北京'; // 标签名
$result  = $wechat->tags()->create($tagName);
```

#### 获取公众号已创建的标签

```$xslt
$result = $wechat->tags()->get();
```

#### 编辑标签

```$xslt
$tagId = '101'; // 标签id
$tagName = '福建'; // 要修改为的标签名
$result     = $wechat->tags()->update($tagId, $tagName);
```

#### 删除标签

```$xslt
$tagId = '101'; // 标签id
$result     = $wechat->tags()->delete($tagId);
```

#### 获取标签下粉丝列表

```$xslt
$tagId      = '100'; // 标签id
$nextOpenid = 'oeuHrwSsNAUXvLemeusYduRMFGE0'; // 下一个openid 不传从第一个开始
$result     = $wechat->tags()->user($tagId);
$result     = $wechat->tags()->user($tagId, $nextOpenid);
```

#### 批量为用户打标签

```$xslt
$tagId   = '102'; // 标签id
$openids = [
    "oeuHrwSsNAUXvLemeusYduRMFGE0",
    "oeuHrwTwAOT5GN6K1oPxJXyygwUU",
]; // 要修改标签的用户的openid
$result = $wechat->tags()->batchtagging($tagId, $openids);
```

#### 批量为用户取消标签

```$xslt
$tagId   = '102'; // 标签id
$openids = [
    "oeuHrwSsNAUXvLemeusYduRMFGE0",
    "oeuHrwTwAOT5GN6K1oPxJXyygwUU",
]; // 要取消标签的用户的openid
$result = $wechat->tags()->batchuntagging($tagId, $openids);
```

#### 获取用户身上的标签列表

```$xslt
$openid = "oeuHrwSsNAUXvLemeusYduRMFGE0";
$result = $wechat->tags()->idlist($openid);
```