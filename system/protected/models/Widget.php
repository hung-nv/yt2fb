<?php

/**
 * This is the model class for table "widget".
 *
 * The followings are the available columns in table 'widget':
 * @property integer $id
 * @property string $title
 * @property string $category_ids
 * @property integer $order_box
 * @property integer $limited
 * @property integer $is_hot
 * @property integer $show
 * @property integer $css
 * @property integer $order_by
 * @property integer $status
 */
class Widget extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public $infor;
    public $categorySelected;
    
    public function afterFind() {
        $this->categorySelected = explode(',', $this->category_ids);
        return parent::afterFind();
    }

    public function getInfor() {
        $orderBox = '';
        $cate = '';
        if ($this->category_ids == "1") {
            $cate = '+ Danh mục: Tất cả<br>';
        } else {
            preg_match_all('/\[(.*?)\]/', $this->category_ids, $parent);
            if (isset($parent) && $parent[1]) {
                foreach ($parent[1] as $i) {
                    $category = Categories::model()->findByAttributes(array('alias' => $i));
                    if (isset($category) && $category)
                        $title[] = $category->title;
                }
                if (isset($title) && $title)
                    $cate = '+ Danh mục: ' . implode(', ', $title) . '<br>';
            }
        }

        if ($this->order_box == 1)
            $orderBox = '+ Điều kiện: mới nhất<br>';
        else
            $orderBox = '+ Điều kiện: xem nhiều<br>';

        $limit = '+ Số lượng: ' . $this->limited . '<br>';

        if ($this->is_hot == 0)
            $isHot = '+ Là tin thường<br>';
        else
            $isHot = '+ Là tin hot<br>';
        $css = '+ Kiểu css: ' . $this->css;
        $this->infor = $cate . $orderBox . $limit . $isHot . $css;
        return $this->infor;
    }

    function getListCategory() {
        $return = array();
        $cmd = Yii::app()->db->createCommand('select id,title,alias from categories where status=1 && showas not like "%page%" && parent_id=0');
        $data = $cmd->queryAll();
        $return['1'] = 'Tất cả Danh mục';
        if (isset($data) && $data) {
            foreach ($data as $i) {
                $return['[' . $i['alias'] . ']'] = $i['title'];
            }
        }
        return $return;
    }

    public function tableName() {
        return 'widget';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, category_ids, order_box, limited, css, order_by', 'required'),
            array('order_box, limited, is_hot, show, css, order_by, status', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('category_ids', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, category_ids, order_box, limited, is_hot, show, css, order_by, status', 'safe', 'on' => 'search'),
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
            'title' => 'Tiêu đề',
            'category_ids' => 'Danh mục',
            'order_box' => 'Sắp xếp theo',
            'limited' => 'Số lượng',
            'is_hot' => 'Tin hot?',
            'show' => 'Vị trí hiển thị',
            'css' => 'Kiểu css',
            'order_by' => 'Thứ tự sắp xếp',
            'categorySelected' => 'Danh mục hiển thị',
            'status' => 'Status',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('category_ids', $this->category_ids, true);
        $criteria->compare('order_box', $this->order_box);
        $criteria->compare('limited', $this->limited);
        $criteria->compare('is_hot', $this->is_hot);
        $criteria->compare('show', $this->show);
        $criteria->compare('css', $this->css);
        $criteria->compare('order_by', $this->order_by);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Widget the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
