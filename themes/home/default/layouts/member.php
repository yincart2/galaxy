<?php
/**
 * the layouts for member module
 * @var yii\web\View $this
 **/
use yii\helpers\Url;

$this->beginContent('@theme/home/default/layouts/main.php');

?>
    <!--content-->
    <div class="page_content_offset">
        <div class="container">
            <div class="row clearfix">
                <aside class="col-lg-3 col-md-3 col-sm-3">
                    <!--widgets-->
                    <figure class="widget shadow r_corners wrapper m_bottom_30">
                        <figcaption>
                            <h3 class="color_light"><?= Yii::t('member','Member Center')?></h3>
                        </figcaption>
                        <div class="widget_content">
                            <!--Categories list-->
                            <ul class="categories_list">
                                <li class="active">
                                    <a href="<?= Url::to(['/member/default/index'])?>" class="f_size_large color_dark d_block">
                                        <b><?= Yii::t('member','Member Information')?></b>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/member/wishlist/get-wishlist'])?>" class="f_size_large color_dark d_block">
                                        <b><?= Yii::t('member','My WishList')?></b>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/member/address/delivery-address'])?>" class="f_size_large color_dark d_block">
                                        <b><?= Yii::t('member','Delivery Address')?></b>
                                    </a>
                                </li>
                                <li >
                                    <a href="<?= Url::to(['/order/home/order/list']) ?>" class="f_size_large color_dark d_block">
                                        <b><?= Yii::t('member', 'Order') ?></b>
                                    </a>
                                </li>
                                <li >
                                    <a href="<?= Url::to(['/refund/home/refund/index']) ?>" class="f_size_large color_dark d_block">
                                        <b><?= Yii::t('refund', 'Refund Log') ?> </b>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </figure>
                </aside>
                <aside class="col-lg-9 col-md-9 col-sm-9">
                    <?= $content ?>
                </aside>
            </div>
        </div>
    </div>

<?php $this->endContent(); ?>