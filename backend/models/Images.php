<?php
namespace backend\models;
use Yii;
use yii\db\ActiveRecord;
class Images extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%images}}";
    }

    public function attributeLabels()
    {
        return [

        ];
    }
    public function rules()
    {
        return [
            ['url', 'required', 'message' => '图片路径不能为这'],
        ];
    }

    public function create($data)
    {
        if ($this->load($data) && $this->save()) {
            return true;
        }
        return false;
    }

}