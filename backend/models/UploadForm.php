<?php
namespace backend\models;
use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use backend\models\Images;
class UploadForm extends Model
{
    //use it to save $_FILE data.
    /**
     * @var $imageFile UploadedFile[];
     */
    public $imageFile;

    public function rules()
    {
        return [
            //数据验证这里可自己做
            //[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }


    public function upload()
    {
        print_r("sdddddddddddddddddddddddddd");
        if($this->validate()){
            print_r("----------------------");
            print_r($this->validate());
            //$path = \Yii::getAlias('@upload') . '/' . date("Ymd");
            $path = "../../uploads". '/' . date("Ymd");
            //print_r($path);
            //exit();
            if(!is_dir($path) || !is_writable($path)){
                FileHelper::createDirectory($path,0777,true);
            }

            $filePath = $path  . '/' . Yii::$app->request->post('model','') . '_' .md5(uniqid() . mt_rand(10000,99999999)) . '.' . $this->imageFile->extension;
            print_r("----------------------<br/>");
            print_r($this->imageFile);
            //exit();
            if( $this->imageFile->saveAs($filePath)){
                /*print_r($filePath);
                exit();*/
                //这里将上传成功后的图片信息保存到数据库
                $imageUrl = $this->parseImageUrl($filePath);
                $imageModel = new Images();
                $imageModel->url = $imageUrl;
                $imageModel->addtime = time();
                $imageModel->status = 0;
                $imageModel->module = Yii::$app->request->post('model','');

                $imageModel->save(false);

                return $imageUrl;
            }
        }

        return false;
    }

    /**
     * 这里在upload中定义了上传目录根目录别名，以及图片域名
     * 将/var/www/html/gushanxia/upload/20160626/file.png 转化为 http://statics.gushanxia.com/20160626/file.png
     * format:http://domain/path/file.extension
     * @param $filePath
     * @return string
     */
    private function parseImageUrl($filePath)
    {
        if(strpos($filePath,Yii::getAlias('@upload')) !== false){
            return Yii::$app->params['assetDomain'] . str_replace(Yii::getAlias('@upload'),'',$filePath);
        }else{
            return $filePath;
        }
    }


}