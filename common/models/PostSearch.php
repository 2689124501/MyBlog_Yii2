<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form of `common\models\Post`.
 */
class PostSearch extends Post
{
    public function attributes()
    {
        //添加属性
        return array_merge(parent::attributes(),['authorName']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title', 'content', 'tags', 'authorName'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() //场景
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * 搜索的实现是靠查询构建器来程序化地构建查询，然后交给数据提供者
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
            'sort' => [     //实现排序
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
                'attributes' => ['id', 'title'],
            ]
        ]);

        // echo "<pre>";
        // // print_r($dataProvider->getPagination());    //展示分页信息                
        // print_r($dataProvider->getModels());    //取得DataProvider中的数据，有可能是对象数组，或者是普通数组
        // echo "<hr />";
        // // print_r($dataProvider->getSort());  //排序信息
        // echo "</pre>";        
        // exit(0);

        //查询构建器
        //块赋值，将表单中填写的数据赋值给当前对象的属性
        $this->load($params);
        //判断提交的数据是否符合规则
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'author_id' => $this->author_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        $query->join('INNER JOIN', 'Adminuser','post.author_id = Adminuser.id');
        $query->andFilterWhere(['like','Adminuser.nickname', $this->authorName]);

        $dataProvider->sort->attributes['authorName']=
        [
            'asc'=>['Adminuser.nickname'=>SORT_ASC],
            'desc'=>['Adminuser.nickname'=>SORT_DESC],
        ];

        return $dataProvider;
    }
}
