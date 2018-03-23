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
];

// 获取示例
$wechat = \TechOne\WechatApi\Wechat::init($config);

```

### 响应微信发送的Token验证

```php
$wechat->checkSignature();
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