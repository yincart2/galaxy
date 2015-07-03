<?php

namespace star\system\models;

use Yii;
use yii\base\Exception;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "setting".
 *
 * @property integer $setting_id
 * @property string $menu_code
 * @property string $menu_label
 * @property string $group_code
 * @property string $group_label
 * @property integer $menu_sort
 * @property integer $group_sort
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_code', 'menu_label', 'group_code', 'group_label', 'menu_sort', 'group_sort'], 'required'],
            [['setting_id', 'menu_sort', 'group_sort'], 'integer'],
            [['menu_code', 'menu_label', 'group_code', 'group_label'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'setting_id' => Yii::t('system', 'Setting ID'),
            'menu_code' => Yii::t('system', 'Menu Code'),
            'menu_label' => Yii::t('system', 'Menu Label'),
            'group_code' => Yii::t('system', 'Group Code'),
            'group_label' => Yii::t('system', 'Group Label'),
            'menu_sort' => Yii::t('system', 'Menu Sort'),
            'group_sort' => Yii::t('system', 'Group Sort'),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->saveSettingFields($this->setting_id);
        parent::afterSave($insert, $changedAttributes);
    }

    public function saveSettingFields($settingId)
    {
        if (isset($_POST['SettingFields'])) {
            $settingFields = $_POST['SettingFields'];
            unset($_POST['SettingFields']);
            if (is_array($settingFields['type']) && $count = count($settingFields['type'])) {
                for ($i = 0; $i < $count; $i++) {
                    if (isset($settingFields['setting_fields_id'][$i]) && $settingFields['setting_fields_id'][$i]) {
                        $propValue = Yii::createObject(SettingFields::className());
                        /** @var  $settingFieldsModel  SettingFields */
                        $settingFieldsModel = $propValue::find()->where(['setting_fields_id' => $settingFields['setting_fields_id'][$i]])->one();;
                    } else {
                        $settingFieldsModel = Yii::createObject(SettingFields::className());
                    }
                    if ($settingFields['type'][$i] != SettingFields::TYPE_TEXT) {
                        $settingFieldsModel->setAttributes([
                            'chosen_value' => end(array_keys(Json::decode($settingFields['value'][$i]))),
                        ]);
                    } else {
                        $settingFieldsModel->setAttributes([
                            'chosen_value' => $settingFields['value'][$i],
                        ]);
                    }
                    $settingFieldsModel->setAttributes(array(
                        'setting_id' => $settingId,
                        'type' => $settingFields['type'][$i],
                        'fields_code' => $settingFields['fields_code'][$i],
                        'fields_label' => $settingFields['fields_label'][$i],
                        'value' => $settingFields['value'][$i],
                        'setting_code' => $this->menu_code . '_' . $this->group_code . '_' . $settingFields['fields_code'][$i],
                    ));
                    if (isset($settingFields['setting_fields_id'][$i]) && $settingFields['setting_fields_id'][$i]) {
                        $settingFieldsModel->update();
                    } else {
                        if (!$settingFieldsModel->save()) {
                            throw new Exception(Yii::t('system', 'save attributes fail'));
                        }
                    }
                    $settingFields['setting_fields_id'][$i] = $settingFieldsModel->setting_fields_id;
                }
                $propValueModel = Yii::createObject(SettingFields::className());
                //删除
                $models = $propValueModel::findAll(['setting_id' => $settingId]);
                $delArr = array();
                foreach ($models as $k1 => $v1) {
                    if (!in_array($v1->setting_fields_id, $settingFields['setting_fields_id'])) {
                        $delArr[] = $v1->setting_fields_id;
                    }
                }
                if (count($delArr)) {
                    $propValueModel = Yii::createObject(SettingFields::className());
                    $propValueModel::deleteAll('setting_fields_id IN (' . implode(', ', $delArr) . ')');
                }
            }
        } else {
            //已经没有属性了，要清除数据表内容
            $propValueModel = Yii::createObject(SettingFields::className());
            $propValueModel::deleteAll('setting_id = ' . $settingId);
        }
    }

    public function getSettingFields()
    {
        return self::hasMany(SettingFields::className(), ['setting_id' => 'setting_id']);
    }

    public function getSystemConfig()
    {
        $settings = self::find()->all();

        $systemConfig = [];

        /** @var \star\system\models\Setting $setting */
        foreach ($settings as $setting) {
            $fieldsConfig = [];
            $groupConfig = [];

            $settingFields = $setting->settingFields;
            /** @var \star\system\models\SettingFields $settingField */
            foreach ($settingFields as $settingField) {
                if ($settingField->type == 2 || $settingField->type == 3) {
                    $data = json_decode($settingField->value);

                    if (isset($fieldsConfig[$settingField->setting_code])) {
                        $data = ArrayHelper::merge($fieldsConfig[$settingField->setting_code]['value'], $data);
                    }
                    $fieldsConfig[$settingField->setting_code] = [
                        'label' => $settingField->fields_label,
                        'inputType' => $settingField->type,
                        'value' => $data,
                        'setting_code' => $settingField->setting_code
                    ];

                } else {
                    $fieldsConfig[$settingField->setting_code] = [
                        'label' => $settingField->fields_label,
                        'inputType' => $settingField->type,
                        'value' => $settingField->value,
                        'setting_code' => $settingField->setting_code
                    ];
                }
            }

            $groupConfig[$setting->group_code] = [
                'label' => $setting->group_label,
                'sort' => $setting->group_sort,
                'fields' => $fieldsConfig
            ];

            if (isset($systemConfig[$setting->menu_code]) && $systemConfig[$setting->menu_code]) {
                $preConfig = $systemConfig[$setting->menu_code];
            }
            $systemConfig[$setting->menu_code] = [
                'label' => $setting->menu_label,
                'sort' => $setting->menu_sort,
                'groups' => $groupConfig
            ];
            if (isset($preConfig)) {
                $systemConfig[$setting->menu_code] = ArrayHelper::merge($preConfig, $systemConfig[$setting->menu_code]);
            }
        }

        return $systemConfig;
    }

    /**
     * get the config
     * @param \yii\bootstrap\ActiveForm $form
     * @param array $options
     * @return string
     */
    public function renderForm($form, $options = [])
    {
        $config = $this->getSystemConfig();

        $tabItems = [];
        foreach ($config as $tabKey => $tab) {
            $groupItems = [];
            foreach ($tab['groups'] as $groupKey => $group) {
                $groupContent = '';
                foreach ($group['fields'] as $fieldKey => $field) {

                    $inlineRadioListTemplate = "<label class = \"control-label col-sm-1\">" . $field['label'] . "</label>\n<div class=\"col-sm-11\">{input}\n{hint}\n{error}</div>";
                    $inlineCheckboxListTemplate = "<label class = \"control-label col-sm-1\">" . $field['label'] . "</label>\n<div class=\"col-sm-11\">{input}\n{hint}\n{error}</div>";

                    $options['template'] = "<label class = \"control-label col-sm-1\">" . $field['label'] . "</label>\n<div class=\"col-sm-11\">{input}\n<div style=\"width:60%\">{hint}\n</div>{error}</div>";
                    $fieldOptions = array_merge($options, ['options' => ['class' => 'form-group'], 'inputOptions' => ['name' => 'setting_code[' . $field['setting_code'] . ']']]);

                    /** @var \yii\bootstrap\ActiveField $activeField */
                    $fieldClass = Yii::createObject(SettingFields::className());
                    $fieldModel = $fieldClass::findOne(['setting_code' => $field['setting_code']]);
                    if($field['inputType'] == 3) {
                        $fieldModel->chosen_value = json_decode($fieldModel->chosen_value, true);
                    }
                    $activeField = $form->field($fieldModel, 'chosen_value', $fieldOptions);

                    switch ($field['inputType']) {
                        case 3:
                            $activeField->inline()->checkboxList($field['value'], ['name' => 'setting_code[' . $field['setting_code'] . ']', 'template' => $inlineCheckboxListTemplate]);
                            break;
                        case 2:
                            $activeField->inline()->radioList($field['value'], ['name' => 'setting_code[' . $field['setting_code'] . ']', 'template' => $inlineRadioListTemplate]);
                            break;
                        case 1:
                            $activeField->textInput();
                            break;
//                        case 'select':
//                            $activeField->dropDownList($dataList);
//                            break;
//                        case 'textarea':
//                            $activeField->textarea();
//                            break;
//                        case 'password':
//                            $activeField->passwordInput();
//                            break;
                    }
                    if (isset($field['hint'])) {
                        $activeField->hint($field['hint']);
                    }
                    $groupContent .= $activeField->render();
                }

                $groupItems[$group['label']] = [
                    'label' => $group['label'],
                    'content' => $groupContent,
                ];
            }
            $tabContent = Collapse::widget(['items' => $groupItems]);
            $tabItems[] = [
                'label' => $tab['label'],
                'content' => $tabContent,
            ];
        }

        $js = <<<JS
var modelName = 'SettingModel'
$(document).on('change', 'select, input[type=checkbox], input[type=radio]', function() {
    var name = $(this).attr('name')
    var dataKey = name.substring(modelName.length + 1, name.length - 1);
    var dataValue = $(this).val();
    if ($('[data-depend-key='+dataKey+']').length) {
        $('[data-depend-key='+dataKey+']').hide();
    }
    if ($('[data-depend-key='+dataKey+'][data-depend-value='+dataValue+']').length) {
        $('[data-depend-key='+dataKey+'][data-depend-value='+dataValue+']').show();
    }
});

$('[data-depend-key]').each(function() {
    var input = $(this);
    var valueInput = $('[name="'+modelName+'['+input.data('depend-key')+']"]');
    if (valueInput.val() == input.data('depend-key')) {
        input.show();
    } else {
        input.hide();
    }
});
JS;

        Yii::$app->view->registerJs($js);

        return Tabs::widget(['items' => $tabItems]);
    }
}
