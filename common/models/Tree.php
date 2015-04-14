<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/23/2015
 * Time: 11:24 AM
 */

namespace common\models;

use gilek\gtreetable\models\TreeModel;

class Tree extends TreeModel
{
    public static function tableName()
    {
        return 'tree';
    }

    public static function getTreesByName($name)
    {
        /** @var \common\models\Tree|\creocoder\nestedsets\NestedSetsBehavior $root */
        $root = static::find()->where(['name' => $name])->one();
        $categories = $root->children()->indexBy('id')->all();
        return array_map(function($cate) use ($root) {
            $prefix = '';
            $cate->level -= $root->level;
            while(--$cate->level) {
                $prefix .= '|----';
            }
            return $prefix . $cate->name;
        }, $categories);
    }
}