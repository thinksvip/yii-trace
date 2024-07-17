<?php

namespace Xincheng\YiiTrace;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\console\Request;

class Bootstrap implements BootstrapInterface
{
    public const TRACE_ID = 'trace_id';

    /**
     * 配置自动负载
     *
     * @param Application $app
     * @return void
     * @throws InvalidConfigException
     */
    public function bootstrap($app)
    {
        $this->withTraceId();

        $this->register($app);
    }

    /**
     * 设置 trace id
     *
     * @return void
     */
    private function withTraceId()
    {
        $withTraceId = function ()
        {
            if (Yii::$app->request instanceof Request) {
                Yii::$app->params[self::TRACE_ID] = TraceId::newTraceId();
                return;
            }

            $headers = Yii::$app->request->getHeaders();
            $traceId = TraceId::newTraceId($headers->get('x-request-id', ''));
            $headers->set('X-Trace-Id', $traceId);
            Yii::$app->params[self::TRACE_ID] = $traceId;
        };

        Yii::$app->on(Application::EVENT_BEFORE_REQUEST, $withTraceId);
    }

    /**
     * 注册组件
     *
     * @param Application $app
     * @return void
     * @throws InvalidConfigException
     */
    private function register(Application $app)
    {
        $app->set('traceId', ['class' => TraceId::class]);
    }
}