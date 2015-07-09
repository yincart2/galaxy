<?php
/**
 * the layouts for member module
 * @var yii\web\View $this
 **/
use yii\helpers\Url;
use kartik\sidenav\SideNav;

$this->beginContent('@theme/core/default/layouts/main.php');
?>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-2 col-sm-4">
                    <?php
                    $type = 'http';
                    $heading = Yii::t('auth','Auth');
                    $item = 'home';

                    echo SideNav::widget([
                        'type' => $type,
                        'encodeLabels' => false,
                        'heading' => $heading,
                        'items' => [
                            ['label' => Yii::t('catalog','Create Permissions'), 'icon' => 'book', 'url' => Url::to(['/auth/auth/create', $type]), 'active' => ($item == 'props')],
                            ['label' => Yii::t('catalog','Role List'), 'icon' => 'tags', 'url' => Url::to(['/auth/auth/list-role', $type]), 'active' => ($item == 'items')],
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-10 col-sm-8">
                    <?php echo $content ?>
                </div>
            </div>
        </div>

<?php $this->endContent(); ?>