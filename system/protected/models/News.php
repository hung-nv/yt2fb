<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $tag
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $image
 * @property string $description
 * @property string $content
 * @property string $keywords
 * @property integer $view
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property integer $hot
 * @property string $author
 * @property integer $ispage
 * @property integer $status
 */
class News extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public $date, $parent;
    public $tagSelected;
    public $oldImage, $imgFile;
    public $page = false;

    public function afterFind() {
        $this->tagSelected = explode(',', $this->tag);
        $this->oldImage = $this->image;
        return parent::afterFind();
    }

    public function beforeSave() {
        if ($this->alias == '')
            $this->alias = $this->convertLink($this->title);
        return parent::beforeSave();
    }

    function convertLink($string) {
        $a = array("\\", '*', '^', '`', '~', '$', 'ä', '%', ' - ', '\"', '#', '…', 'Ấ', "'", '"', ")", "(", "ễ", ";", ",", "&", "&quot;", "“", "”", "/", "Á", "À", "Ả", "Ã", "Ạ", "Ó", "Ò", "Ỏ", "Õ", "Ọ", "Ă", "Ắ", "Ằ", "Ẳ", "Ẵ", "Ặ", "Ô", "Ố", "Ồ", "Ổ", "Ỗ", "Ộ", "Â", "Ã", "Á", "À", "Ả", "Ẫ", "Ậ", "Ơ", "Ớ", "Ờ", "Ở", "Ỡ", "Ợ", "É", "È", "Ẻ", "Ẽ", "Ẹ", "Ú", "Ù", "Ủ", "Ũ", "Ụ", "Ê", "Ễ", "Ề", "Ể", "Ệ", "Ư", "Ứ", "Ừ", "Ử", "Ữ", "Ự", "Í", "Ì", "Ỉ", "Ĩ", "Ị", "Ý", "Ỳ", "Ỷ", "Ỹ", "Ỵ", "Đ", "á", "à", "ả", "ã", "ạ", "ó", "ò", "ỏ", "õ", "ọ", "ă", "ắ", "ằ", "ẳ", "ẵ", "ặ", "ô", "ố", "ồ", "ổ", "ỗ", "ộ", "â", "ã", "ấ", "ầ", "ẩ", "ẫ", "ậ", "ơ", "ớ", "ờ", "ở", "ỡ", "ợ", "é", "è", "ẻ", "ê", "ế", "ề", "ệ", "ẽ", "ẹ", "ú", "ù", "ủ", "ũ", "ụ", "ê", "ẽ", "ề", "ể", "ệ", "ư", "ứ", "ừ", "ử", "ữ", "ự", "í", "ì", "ỉ", "ĩ", "ị", "ý", "ỳ", "ỷ", "ỹ", "ỵ", "đ", "!", "@", "?", ".", ":");
        $b = array('', '', '', '', '', '', 'a', '', '', '', '', '', '', '', '', "", "", "e", "", "", "", "", "", "", " ", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "u", "i", "i", "i", "i", "i", "y", "y", "y", "y", "y", "d", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "e", "e", "e", "e", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "u", "i", "i", "i", "i", "i", "y", "y", "y", "y", "y", "d", "", "", "", "", "" . "");
        $string = strtolower(str_replace($a, $b, $string));
        $string = preg_replace('/\s{2}+/', ' ', $string);
        $string = str_replace(" ", "-", $string);
        $string = preg_replace('/\-{2}+/', '-', $string);
        return $string;
    }

    public function getListCategory($type = NULL) {
        $return = array();
        $cmd = Yii::app()->db->createCommand('select id,title,alias from categories where status=1 && showas not like "%page%" && parent_id=0');
        $data = $cmd->queryAll();
        if (isset($type) && $type == 1)
            $return[''] = 'Tất cả Danh mục';
        if (isset($data) && $data) {
            foreach ($data as $i) {
                $cmdSub = Yii::app()->db->createCommand(
                        'select id,title,alias from categories where status=1 && showas not like "%page%" && parent_id=' . $i['id']
                );
                $dataSub = $cmdSub->queryAll();
                if (isset($dataSub) && $dataSub) {
                    foreach ($dataSub as $j) {
                        $return[$i['title']]['['.$j['alias'].']'] = $j['title'];
                    }
                } else {
                    $return['['.$i['alias'].']'] = $i['title'];
                }
            }
        }
        return $return;
    }
    
    public function getListPages() {
        $return = array();
        $cmd = Yii::app()->db->createCommand('select id,title,alias from categories where status=1 && showas like "%page%" && parent_id=0');
        $data = $cmd->queryAll();
        if(isset($data) && $data) {
            foreach($data as $i) {
                $return['['.$i['alias'].']'] = $i['title'];
            }
        }
        return $return;
    }

    public function getParent() {
        preg_match_all('/\[(.*?)\]/', $this->tag, $tag);
        $arrayParent = array();
        if (isset($tag) && $tag[1]) {
            foreach ($tag[1] as $i) {
                $cate = Categories::model()->findByAttributes(array('alias' => $i));
                if (isset($cate) && $cate)
                    $arrayParent[] = $cate->title;
            }

            $this->parent = implode(',', $arrayParent);
        }
        return $this->parent;
    }

    public function getTitle() {
        return '<p style="font-family: Arial;font-size: 13px;font-weight: bold;">' . $this->title . '</p><p style="padding-left:20px;font-size:13px;">- ' . $this->description . '</p>';
    }

    public function getImage() {
        if (isset($this->image) && $this->image) {
            return '<span class="label label-primary">Available</span><div style="text-align: center; margin-top:10px;"><a class="img-ok" href="../uploads/news/' . $this->image . '" data-lightbox="roadtrip">XEM ẢNH</a></div>';
        } else {
            return '<span class="label label-danger">Empty</span>';
        }
    }

    public function tableName() {
        return 'news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $rules = array(
            array('title, description, content', 'required', 'message' => '{attribute} không được để trống!'),
            array('view, hot, status, ispage', 'numerical', 'integerOnly' => true),
            array('title, alias, tag, meta_title, meta_description, meta_keywords, image, keywords', 'length', 'max' => 255),
            array('author', 'length', 'max' => 50),
            array('updated_datetime', 'safe'),
            array('alias', 'validateAlias'),
            array('image', 'file', 'allowEmpty' => true, 'types' => Yii::app()->params['imageType']),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('title, tag, keywords, created_datetime, author, status, date, ispage', 'safe', 'on' => 'search'),
        );
        
        if ($this->isNewRecord && Yii::app()->controller->action->id == 'create') {
            $rules[] = array('image', 'file', 'allowEmpty' => false, 'types' => Yii::app()->params['imageType'], 'on' => 'insert', 'message' => 'Chọn ảnh đại diện!');
        }
        
        if($this->isNewRecord && Yii::app()->controller->action->id == 'createpage') {
            $rules[] = array('tag', 'validateTag');
        }
        
        return $rules;
    }
    
    public function validateTag($attribute, $params) {
        if($this->isNewRecord) {
            if($this->findByAttributes(array('tag' => $this->tag, 'ispage' => 1, 'status' => 1)))
                    $this->addError ($attribute, 'Already Exits! Please try again.');
        }
    }

    public function validateAlias($attribute, $params) {
        if ($this->isNewRecord) {
            if ($this->findByAttributes(array('alias' => $this->alias)))
                $this->addError($attribute, 'Already Exits! Please try again.');
        }else {
            if ($this->findByPk($this->id)->alias != $this->alias && $this->findByAttributes(array('alias' => $this->alias)))
                $this->addError($attribute, 'Already Exits! Please try again.');
        }
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
            'alias' => 'Alias',
            'tag' => 'Danh mục cha',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'image' => 'Ảnh đại diện',
            'description' => 'Mô tả ngắn',
            'content' => 'Nội dung',
            'keywords' => 'Từ khóa',
            'view' => 'Lượt xem',
            'created_datetime' => 'Ngày tạo',
            'updated_datetime' => 'Updated Datetime',
            'hot' => 'Hot',
            'author' => 'Tác giả',
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

        $criteria->compare('id', $this->id);
        if (isset($this->title) && $this->title) {
            $criteria->compare('title', $this->title, true);
            $criteria->compare('keywords', $this->title, true, 'OR');
        }
        $criteria->compare('tag', $this->tag, true);
        $criteria->compare('created_datetime', $this->created_datetime, true);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('status', $this->status);
        
        if($this->page)
            $criteria->compare('ispage', 1);
        else
            $criteria->compare ('ispage', 0);

        $criteria->order = 'id desc';

        if (isset($this->date) && $this->date) {
            $array = explode('-', $this->date);
            if (isset($array) && $array) {
                $exp = '/\d{2}\/\d{2}\/\d{4}/';
                if (preg_match($exp, trim($array[0])) && preg_match($exp, trim($array[1]))) {
                    $begin = date('Y-m-d', strtotime(trim($array[0])));
                    $end = date('Y-m-d', strtotime(trim($array[1])));
                    if ($begin == $end) {
                        if (isset($begin) && $begin)
                            $criteria->compare('created_datetime', '>' . $begin);
                    } else {
                        if (isset($begin) && $begin)
                            $criteria->compare('created_datetime', '>' . $begin);
                        if (isset($end) && $end)
                            $criteria->compare('created_datetime', '<' . $end);
                    }
                }
            }
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20)
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return News the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
