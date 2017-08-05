<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property integer $parent_id
 * @property string $image
 * @property string $groups
 * @property string $showas
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $ordering
 * @property integer $hot
 * @property integer $status
 */
class Categories extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public $search;
    public $groupsSelected;

    public function tableName() {
        return 'categories';
    }

    public function getTitle() {
        switch ($this->parent_id) {
            case 0:
                return $this->title;
                break;
            default:
                return '- ' . $this->title;
                break;
        }
    }

    public function getListCategory() {
        $return = array();
        $cmd = Yii::app()->db->createCommand('select id,title from categories where status=1 && showas not like "%page%" && parent_id=0');
        $data = $cmd->queryAll();
        $return['0'] = 'Select...';
        if (isset($data) && $data) {
            foreach ($data as $i) {
                $return[$i['id']] = $i['title'];
            }
        }
        return $return;
    }

    public function beforeFind() {
        $this->title = '';
        parent::beforeFind();
    }
    
    public function afterFind() {
        $this->groupsSelected = explode(',', $this->groups);
        parent::afterFind();
    }

    public function getParent() {
        $cate = $this->findByAttributes(array('id' => $this->parent_id));
        if ($this->parent_id == 0)
            return '';
        else
            return $cate->title;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'required', 'message' => '{attribute} không được để trống!'),
            array('parent_id, ordering, hot, status', 'numerical', 'integerOnly' => true),
            array('title, alias, image, groups, showas, meta_title, meta_description, meta_keywords', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, parent_id, search, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Tên',
            'alias' => 'Alias',
            'parent_id' => 'Danh mục cha',
            'image' => 'Ảnh',
            'groups' => 'Vị trí',
            'showas' => 'Định dạng',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'ordering' => 'Sắp xếp',
            'hot' => 'Hot',
            'status' => 'Trạng thái',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('title', $this->search, true);
        $criteria->order = 'id';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 10)
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Categories the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
