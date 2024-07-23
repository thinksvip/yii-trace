# yii-trace-id

## 使用

### 安装

```php
    
composer require xincheng/yii-trace

```


### 配置

```php
main.php

    use Xincheng\YiiTrace\Bootstrap;
        
    [
        'bootstrap'  => [Bootstrap::class],
        ...
    ]

```

```
log.php 

    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class'       => 'yii\log\FileTarget',
            'levels'      => ['error', 'warning', 'info'],
            ...
            'prefix'      => function ($message) {
                return sprintf('[%s]', Yii::$app->params['trace_id']);
            }
        ],
    ]
```

### 获取TraceId

```php
echo Yii::$app->params['trace_id'];

echo Yii::$app->traceId->getTraceId();
```

### 使用外部TraceId

> header里需要设置： x-request-id


### 日志示例

2024-07-16 15:48:41 [36fb958d-3c5d-2928-a8be-2f77b2e50d8a][info][backend\modules\v1\service\base\OrderStrategyService::getShipping]
