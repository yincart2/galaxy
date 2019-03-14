<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-29
 * Time: 下午8:23
 */

namespace matter;


use yii\base\BootstrapInterface;
use Yii;
use matter\helpers\DirHelper;
use yii\base\InvalidConfigException;

class Gravitation implements BootstrapInterface
{
    public $codePools = ['@star'];

    public $namespaceSuffix = ['@star' => 'star'];

    public function bootstrap($app)
    {
        $this->runBootstraps();
    }


    /**
     * get bootstrap from codePools and add them into Yii::$app
     */
    public function runBootstraps()
    {
        foreach ($this->codePools as $codePoolDir) {
            $namespaceSuffix = $this->namespaceSuffix[$codePoolDir];
            $codePoolDir = Yii::getAlias($codePoolDir);
            $namespaceDirs = DirHelper::findDirs($codePoolDir);
            foreach ($namespaceDirs as $namespaceDir) {
                $dirNames = explode(DIRECTORY_SEPARATOR, $namespaceDir);
                $namespace = $namespaceSuffix . DIRECTORY_SEPARATOR . end($dirNames);
                $bootstrap = $namespace . DIRECTORY_SEPARATOR . 'Bootstrap';

                if (class_exists($bootstrap)) {
                    $component = Yii::createObject($bootstrap);
                    if ($component instanceof BootstrapInterface) {
                        Yii::trace("Bootstrap with " . get_class($component) . '::bootstrap()', __METHOD__);
                        $component->bootstrap(Yii::$app);
                    } else {
                        Yii::trace("Bootstrap with " . get_class($component), __METHOD__);
                    }
                } else {
//                    throw new InvalidConfigException("Unknown bootstrapping component ID: $bootstrap");
                }
            }
        }
    }

}