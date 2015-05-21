<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use home\assets\AppAsset;
use home\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/user/registration/register']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/user/security/login']];
            } else {
                $menuItems[] = ['label' => 'User', 'url' => ['/user/admin/index']];
                $menuItems[] = [
                    'label' => 'Catalog', 'url' => ['/catalog/core/default/index'],
                ];
                $menuItems[] = ['label' => 'Settings', 'url' => ['/user/settings/profile']];
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container" style="width: 100%">
            <div class="col-sm-12">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <div class="row">
                    <div class="col-md-2 col-sm-4">
                        <?php
                        use kartik\sidenav\SideNav;
                        use yii\helpers\Url;

                        $type = 'http';
                        $heading = Yii::t('catalog','Catalog');
                        $item = 'home';

                        echo SideNav::widget([
                            'type' => $type,
                            'encodeLabels' => false,
                            'heading' => $heading,
                            'items' => [
                                ['label' => Yii::t('catalog','Item List'), 'icon' => 'tags', 'url' => Url::to(['/catalog/core/item/index', $type]), 'active' => ($item == 'items')],
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

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
