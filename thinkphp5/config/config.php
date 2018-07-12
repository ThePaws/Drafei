<?php 
return [
     'alipay'=>[
           //应用ID,您的APPID。
        'app_id' => "2016091400508563",

        //商户私钥
        'merchant_private_key' => "MIIEpgIBAAKCAQEAqGmhB3P/qTUoCyQ0K7QiJ+noxNt1sIX8tWDVsYmO6T7GeoS9YwC4F6PEda4TAjtwZmfVIUQYrx5VEJpa5l57xjOCRC53j96JOhzRZgehGOHfFsOFs4WaXbE/+tBafrRiWnYpSS9V45UbCM8WZrixkQUU1KcEPdcOWp3syjUnvffJgCVrdEPtt+5D4FT7sm6pXjIm0o+1I3sRT/kKaDekpsXEn692dSH4tlO15uIPwo0xN8f4Xv0Esj2VKGz0/r/yy/6kJHTVkMIVPuCYDLJb+2voIomd4pmQ8zL/Ic+PB+6gOh+WQDGRtKFuTBL1j+I+UK3VjZ7rXtCbmi0hGihuXwIDAQABAoIBAQCSXpOsxZ16848k98c8AKf65qn+hfpofFshTNMNJVAG2h9olnt/Uz2slhIGcU9mDkDnT/EFo4iMkqE999lvBMkwfs4F8hjJ+pBr6GX59kGGPbFFuJM4brK2IXpIw9MS8jXVB4NkbvaIAKxpYIrIplb1gmQTWkEuef2otj75k29CA3Ma4pUNLx60wZUdXxfV2HVRhM+AcB1TqqpuWfKizTUfVx3SG3G5BNOd2evy2ptC5gYO0uNHTYRA6f1gnRAR+5sW0ynLtE3j1ZbvHgdk+EblzsF45eTQ6XdK2t4zDOLui9YZxVWWSXkEO3TsaIj7kwM82dorw/aneJ+Zor9JJNXxAoGBANwoC6v3IZoODJGWt7HzFg9rzeAmi7Y69jTSTwFpjNp2xgatCfBxpA/Bn8HPhnnDUi6Bcgohc4jqwMnE7n7QzwTFxE3mCPNrMgF6/JqmKPCNPRGMNQXnAjc/aZilug/nMESBj44SkferjL6EnvKjXS603D+7DMFXjYs48tLBEZq3AoGBAMPU8KxklIAGRLpcHNgtXDWs7wiQ/NZNQypSReFwru8cjOYXYzn5aaxN+DGbobnY14/VoqVoIu910nCLPI1CIJD1yBEiEww1s0PwKmpugceX64qZ1sbrV6wFejG3MdorldQtw0IZm/3E1bR+kaVpYokN2gxX26tQZ1DkYjCz+cGZAoGBANOAwV3PCQAIeTixE/8oKsxb5Chwv44tbPToCrCvp3sF2k71lHPjqRreCE3YwjdeVyiIgXeMFYO3C8mLoRhCIHBUUrgHxBeepybW8bDc6r3W4pFmIlZuTSmoiRj2Nh8rGqrl0XVLD+Jhc9BgdpdiLJY/eMzdNW7VXw0eg+HHS9NXAoGBAKWQsqoNnz9eDV1B42EheIQo4S7s5daJG+/7/vjKvBuMl9MwksPBCoaSpPPMEL9/hUAl7ozJrj+l7XUZQuhqr/3eznctx8za2eTmd/Xj1/VXi9xylBM5hbX6K4U8zPkXQGVTC3InFKtIbyVanOisYJJfE6q73QzJvY+2hw2GG/KBAoGBAMO8g8Iq549jmaWjSVPmuv3bQ3h3Ctd0QvfhBVa1jdaP1bk9XUbSPQMeUz9YynEJswJYuu9mHvUtT4fMcGyK50kwAvUHXL658uHKzoSgkvz+LBOJnxRPaXsxkTpjh0N1I6XFqw+rpQx+aTBzksBEfjfZGbQQlBOLyKcZ+Ws+/B/V",
        
        //异步通知地址
        'notify_url' =>"http://tfhshop.51zuopin.com/Index/Decidepay/notify",
        // 'notify_url' => "http://tfhshop.51zuopin.com/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
        
        //同步跳转
        // 'return_url' => "http://tfhshop.51zuopin.com/Index/Paysuccess/paysuccess",
        'return_url' => "http://tfhshop.51zuopin.com/Index/Paysuccess/paysuccess",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA1iJtVFzVqA7KTItP5DAq4bTUK2xeaOsJoIJfJ266fUabtntTRnW3o1NFCna4V71zILgKPqk864ESDghJzNbpSIb6WDTGChGr6hphoV+WtCExb9zMTGVFQ/BsmRsYadABy/FlDcA0m1oZr7cQ6p4Jy8KP8e/ypYLGxeKZYMzx+FofBtUI2Np8Fgo8YwSlJjL7bq5Zv7Xt4Lon96kYY6uK+q79R0VF5iTbE5bXbEnkAjRkXFYNsnEGJgJ9lGORClnWnHktP3VYxoZSqmmVvP6PQ3T1CCyvCAEr5Zg6mC2dgpjc0t78xqFSs4k5ZmLzmq+zg7ROJKd5FmYYNlpw6FjlUQIDAQAB",

      ],
	// 应用调试模式
     //验证码
    'captcha'  => [
        // 验证码字符集合
        'codeSet'  => '2345678091',
        // 验证码字体大小(px)
        'fontSize' => 18,
        // 是否画混淆曲线
        'useCurve' => false,
         // 验证码图片高度
        'imageH'   => 40,
        // 验证码图片宽度
        'imageW'   => 95, 
        // 验证码位数
        'length'   => 3, 
        // 验证成功后是否重置        
        'reset'    => true
],
    //数据库类型
     'view_replace_str'       => [
              '__PUBLIC__'=> '/public',
              'CSS_DIR'   =>'/static'
            ],
     // +----------------------------------------------------------------------
 // | 模块设置
    // +----------------------------------------------------------------------
     // 默认模块名
    'default_module'         => 'index',
    // 禁止访问模块
    'deny_module_list'       => ['common'],
    // 默认控制器名
    'default_controller'     => 'Index',
    // 默认操作名
    'default_action'         => 'index',
    // 默认验证器
    'default_validate'       => '',
    // 默认的空控制器名
    'empty_controller'       => 'Error',
    // 操作方法后缀
    'action_suffix'          => '',
    // 自动搜索控制器
    'controller_auto_search' => false,

    //debug模式
    'app_debug'              => true,

    'database'=>[
        'type'            => 'mysql',
        // 服务器地址
        'hostname'        => '127.0.0.1',
        // 数据库名
        'database'        => 'tfh',
        // 用户名
        'username'        => 'root',
        // 密码
        'password'        => 'root',
        // 端口
        'hostport'        => '',
        // 连接dsn
        'dsn'             => '',
        // 数据库连接参数
        'params'          => [],
        // 数据库编码默认采用utf8
        'charset'         => 'utf8',
        // 数据库表前缀
        'prefix'          => '',
        // 数据库调试模式
        'debug'           => true,
        // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
        'deploy'          => 0,
        // 数据库读写是否分离 主从式有效
        'rw_separate'     => false,
        // 读写分离后 主服务器数量
        'master_num'      => 1,
        // 指定从服务器序号
        'slave_no'        => '',
        // 是否严格检查字段是否存在
        'fields_strict'   => true,
        // 数据集返回类型
        'resultset_type'  => 'array',
        // 自动写入时间戳字段
        'auto_timestamp'  => false,
        // 时间字段取出后的默认时间格式
        'datetime_format' => 'Y-m-d H:i:s',
        // 是否需要进行SQL性能分析
        'sql_explain'     => false,
    ],
    //   'database'=>[
    //     'type'            => 'mysql',
    //     // 服务器地址
    //     'hostname'        => '127.0.0.1',
    //     // 数据库名
    //     'database'        => '50991dbz7IK2',
    //     // 用户名
    //     'username'        => '50991_f74101',
    //     // 密码
    //     'password'        => 'IE4ApFrFLZBCqCR',
    //     // 端口
    //     'hostport'        => '',
    //     // 连接dsn
    //     'dsn'             => '',
    //     // 数据库连接参数
    //     'params'          => [],
    //     // 数据库编码默认采用utf8
    //     'charset'         => 'utf8',
    //     // 数据库表前缀
    //     'prefix'          => '',
    //     // 数据库调试模式
    //     'debug'           => true,
    //     // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    //     'deploy'          => 0,
    //     // 数据库读写是否分离 主从式有效
    //     'rw_separate'     => false,
    //     // 读写分离后 主服务器数量
    //     'master_num'      => 1,
    //     // 指定从服务器序号
    //     'slave_no'        => '',
    //     // 是否严格检查字段是否存在
    //     'fields_strict'   => true,
    //     // 数据集返回类型
    //     'resultset_type'  => 'array',
    //     // 自动写入时间戳字段
    //     'auto_timestamp'  => false,
    //     // 时间字段取出后的默认时间格式
    //     'datetime_format' => 'Y-m-d H:i:s',
    //     // 是否需要进行SQL性能分析
    //     'sql_explain'     => false,
    // ]
];
