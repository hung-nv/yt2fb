<?php

/**
 * This is the model class for table "youtube_link".
 *
 * The followings are the available columns in table 'youtube_link':
 * @property integer $id
 * @property string $youtube_id
 * @property string $fb_headline
 * @property string $fb_description
 * @property string $fb_thumbnail
 * @property string $fb_sitename
 * @property integer $member_id
 * @property string $purl_redirect
 * @property string $murl_redirect
 * @property integer $view
 * @property string $created_datetime
 * @property integer $status
 */
class YoutubeLink extends CActiveRecord {
    
    public $imgFile;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'youtube_link';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('youtube_id', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('youtube_id, fb_headline, fb_thumbnail, purl_redirect, murl_redirect', 'length', 'max' => 255),
            array('fb_thumbnail', 'file', 'allowEmpty' => true, 'types' => Yii::app()->params['imageType']),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, youtube_id, fb_headline, fb_description, fb_thumbnail, member_id, purl_redirect, murl_redirect, view, created_datetime, status', 'safe', 'on' => 'search'),
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
            'youtube_id' => 'Youtube',
            'fb_headline' => 'Fb Headline',
            'fb_description' => 'Fb Description',
            'fb_thumbnail' => 'Fb Thumbnail',
            'fb_sitename' => 'FB Site Name',
            'member_id' => 'Member',
            'purl_redirect' => 'PC Redirect',
            'murl_redirect' => 'Mobile Redirect',
            'view' => 'View',
            'created_datetime' => 'Created Datetime',
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
        $criteria->compare('youtube_id', $this->youtube_id, true);
        $criteria->compare('fb_headline', $this->fb_headline, true);
        $criteria->compare('fb_description', $this->fb_description, true);
        $criteria->compare('fb_thumbnail', $this->fb_thumbnail, true);
        $criteria->compare('member_id', $this->member_id);
        $criteria->compare('purl_redirect', $this->purl_redirect, true);
        $criteria->compare('murl_redirect', $this->murl_redirect, true);
        $criteria->compare('view', $this->view);
        $criteria->compare('created_datetime', $this->created_datetime, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return YoutubeLink the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
