<?php
/**
 * the layouts for member module
 * @var yii\web\View $this
 **/
use yii\helpers\Url;

$this->beginContent('@theme/star/cluster/layouts/main.php');

?>
    <div class="row">

        <aside class="col-md-3 col-sm-4">

            <!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

            <section class="section_offset">

                <h3><?= Yii::t('member', 'Member Center') ?></h3>

                <ul class="theme_menu">

                    <li class="active">
                        <a href="<?= Url::to(['/member/default/index']) ?>">
                            <b><?= Yii::t('member', 'Member Information') ?></b>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/member/wishlist/get-wishlist']) ?>">
                            <b><?= Yii::t('member', 'My WishList') ?></b>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/member/address/delivery-address']) ?>">
                            <b><?= Yii::t('member', 'Delivery Address') ?></b>
                        </a>
                    </li>

                </ul>

            </section>
            <!--/ .section_offset -->

            <!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

        </aside>
        <!--/ [col]-->

        <main class="col-md-9 col-sm-8">
            <?= $content ?>
        </main>
        <!--/ [col]-->

    </div><!--/ .row-->

<?php $this->endContent(); ?>