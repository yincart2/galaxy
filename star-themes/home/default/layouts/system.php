<?php
use yii\widgets\Breadcrumbs;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

$this->beginContent('@theme/core/default/layouts/main.php');
?>
    <div class="container" style="width: 100%">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-2 col-sm-4">
                    <?php
                    $type = 'http';
                    $heading = Yii::t('system','System');
                    $item = 'system';

                    echo SideNav::widget([
                        'type' => $type,
                        'encodeLabels' => false,
                        'heading' => $heading,
                        'items' => [
                            ['label' => Yii::t('system','System'), 'icon' => 'book', 'url' => Url::to(['/system/core/system/index', $type]), 'active' => ($item == 'tree')],
                            ['label' => Yii::t('system','Tree'), 'icon' => 'book', 'url' => Url::to(['/system/core/tree/index', $type]), 'active' => ($item == 'tree')],
                            ['label' => Yii::t('system','Station'), 'icon' => 'tags', 'url' => Url::to(['/system/core/station/index', $type]), 'active' => ($item == 'stations')],
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-10 col-sm-8">
                    <?php echo $content ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>