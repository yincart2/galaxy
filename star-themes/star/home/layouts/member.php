<?php
/**
 * the layouts for member module
 * @var yii\web\View $this
 **/
use yii\helpers\Url;

$this->beginContent('@theme/star/home/layouts/main.php');

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
                                        <b><?= Yii::t('member','Person Information')?></b>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/member/wishlist/get-wishlist','type' => 2])?>" class="f_size_large color_dark d_block">
                                        <b><?= Yii::t('member','My Compare')?></b>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/member/wishlist/get-wishlist','type' => 1])?>" class="f_size_large color_dark d_block">
                                        <b><?= Yii::t('member','My WishList')?></b>
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