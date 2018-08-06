<?php

namespace star\blog\controllers\home;

use star\system\models\Tree;
use yii\web\Controller;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use star\blog\models\Post;

class DefaultController extends Controller
{
    public function actionIndex()
    {
//        $category = Category::model()->findByPk(5);
//        $childs = $category->descendants()->findAll();
//        foreach ($childs as $c)
//            $ids[] = $c->id;
//        $ids_string = implode(',', $ids);
//        $criteria = new CDbCriteria(array(
//            'condition' => 'status=' . Post::STATUS_PUBLISHED .' AND  category_id in ('.$ids_string.')',
//            'order' => 'create_time DESC',
//            'with' => 'commentCount',
//        ));
//        if (isset($_GET['tag']))
//            $criteria->addSearchCondition('tags', $_GET['tag']);

        $search = \Yii::$app->request->get('tag');

        $catgegories = Tree::findOne(['name' => '单页分类']);
        $children = $catgegories->children()->all();

        foreach ($children as $c)
            $ids[] = $c->id;
        $ids_string = implode(',', $ids);

        $dataProvider = new ActiveDataProvider([
            'query' => !empty($search) ? Post::find()->where('category_id not in ('.$ids_string.')')->orderBy('id desc')->andWhere(['like', 'tags', $search]) : Post::find()->where('category_id not in ('.$ids_string.')')->orderBy('id desc'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

//        $dataProvider = new ActiveDataProvider('Post', array(
//            'pagination' => array(
//                'pageSize' => Yii::app()->params['postsPerPage'],
//            ),
//            'criteria' => $criteria,
//        ));

        return $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
}
