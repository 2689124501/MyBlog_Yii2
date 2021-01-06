<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $tags
 * @property int $status
 * @property int|null $create_time
 * @property int|null $update_time
 * @property int $author_id
 *
 * @property Comment[] $comments
 * @property Adminuser $author
 * @property Poststatus $status0
 */
class Post extends \yii\db\ActiveRecord
{
    private $_oldTags;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'status', 'author_id'], 'required'],
            [['content', 'tags'], 'string'],
            [['status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Adminuser::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Poststatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'status' => '状态',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
            'author_id' => '作者',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        // hasMany用于一对多的情况，本例中，一个Post有多条comment， 返回一个comment数组
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    public function getActiveComments()
    {
    	return $this->hasMany(Comment::className(), ['post_id' => 'id'])
    	->where('status=:status',[':status'=>2])->orderBy('id DESC');
    }
    
    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Adminuser::className(), ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Status0]].
     * 建立两个类之间的关联关系 Post和Poststatus 条件是 id==status
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        // hasOne方法用于多对一，一对一的情况 本例中 多个Post有相同的status 是多对一情况
        return $this->hasOne(Poststatus::className(), ['id' => 'status']);
    }

    //在插入或更新前调用
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->create_time = time();
                $this->update_time = time();            
            }
            else{
                $this->update_time = time();
            }            
            return true;
        } 
        else{
            return false;
        }
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTags = $this->tags;      //保存修改前的老标签
    }
    //POST保存后调用，去更新Tag
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        Tag::updateFrequency($this->_oldTags, $this->tags);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        Tag::updateFrequency($this->tags, '');
    }

    public function getUrl()
    {
    	return Yii::$app->urlManager->createUrl(
                // ['post/detail','id'=>$this->id,'title'=>$this->title]);
                ['post/detail','id'=>$this->id]);
    }

    public function getBeginning($length=288)
    {
    	$tmpStr = strip_tags($this->content);
    	$tmpLen = mb_strlen($tmpStr);
    	 
    	$tmpStr = mb_substr($tmpStr,0,$length,'utf-8');
    	return $tmpStr.($tmpLen>$length?'...':'');
    }
    
    public function  getTagLinks()
    {
    	$links=array();
    	foreach(Tag::string2array($this->tags) as $tag)
    	{
    		$links[]=Html::a(Html::encode($tag),array('post/index','PostSearch[tags]'=>$tag));
    	}
    	return $links;
    }

    public function getCommentCount()
    {
    	return Comment::find()->where(['post_id'=>$this->id,'status'=>2])->count();
    }
}

// gii会根据数据库之间的关联关系，自动生成建立类之间关联关系的代码