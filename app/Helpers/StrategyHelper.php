<?php

namespace App\Helpers;

class StrategyHelper
{
    public static function makeStrategy(
        string $strategyPath,
        string $strategyModel,
        string $mainStrategy,
        string $methodName,
        array $params = [],
        array $methodParams = []
    ) {
        $strategyModel = $strategyPath . $strategyModel . 'Strategy';
        if (class_exists($strategyModel)) {
            $strategy = new $mainStrategy(
                new $strategyModel($params)
            );

            return $strategy->$methodName($methodParams);
        }
    }
}
