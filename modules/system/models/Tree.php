<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/23/2015
 * Time: 11:24 AM
 */

namespace star\system\models;

use gilek\gtreetable\models\TreeModel;

class Tree extends TreeModel
{
    public static function tableName()
    {
        return 'tree';
    }

    public static function getTreesByName($name)
    {
        /** @var \star\system\models\Tree|\creocoder\nestedsets\NestedSetsBehavior $root */
        $root = static::find()->where(['name' => $name])->one();
        if ($root) {
            $categories = $root->children()->indexBy('id')->all();
            return array_map(function ($cate) use ($root) {
                $prefix = '';
                $cate->level -= $root->level;
                while (--$cate->level) {
                    $prefix .= '|----';
                }
                return $prefix . $cate->name;
            }, $categories);
        } else {
            return false;
        }
    }

    public static function getTreesById($id)
    {
        /** @var \star\system\models\Tree|\creocoder\nestedsets\NestedSetsBehavior $root */
        $root = static::find()->where(['id' => $id])->one();
        if ($root) {
            $categories = Tree::find()->where('lft >= '.$root->lft.' and rgt <= '.$root->rgt.' and root = '.$root->root.' order by id desc')->indexBy('id')->all();
            return array_map(function ($cate) use ($root) {
                return $cate->name;
            }, $categories);
        } else {
            return false;
        }
    }

    public static function getCategoriesById($id)
    {
        /** @var \star\system\models\Tree|\creocoder\nestedsets\NestedSetsBehavior $root */
        $root = static::find()->where(['id' => $id])->one();
        if ($root) {
            $categories = $root->children(1)->indexBy('id')->all();
            if($categories) {
                return $categories;
            } else {
                return array($root);
            }
        } else {
            return false;
        }
    }
}