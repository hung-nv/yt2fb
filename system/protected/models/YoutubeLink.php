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
    
    public $author, $adsfb, $updateAds;

    /**
     * @return string the associated database table name
     */
    public function getAdsFb() {
        $quote = '<blockquote>';
        $end = '</blockquote>';
        $infor = '<small>FB Headline: <cite class="text-red">'.$this->fb_headline.'</cite></small>
                <small>FB Description: <cite class="text-light-blue">'.$this->fb_description.'</cite></small>
                <small>Mobile Redirect: <cite class="text-light-blue">'.$this->murl_redirect.'</cite></small>
                <small><a class="img-ok text-red" href="'.$this->fb_thumbnail . '" data-lightbox="roadtrip">XEM ẢNH</a></small>
                <small>Created Datetime: <cite>'.$this->created_datetime.'</cite></small>';
        return $this->adsfb = $quote.$infor.$end;
    }
    
    public function getupdate() {
        return '<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" 
            data-target="#modal-dialog-'.$this->id.'">EDIT ADS</button>
            <div class="modal fade" id="modal-dialog-'.$this->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Update Facebook Ads #'.$this->id.'</h4>
                  </div>
                  <form class="form-horizontal" id="ads-form" data-toggle="validator" role="form" method="post">
                  <input name="Ads[id]" type="hidden" value="'.$this->id.'">
                  <div class="modal-body">
                       <div class="box-body">
                          <div class="form-group" style="margin-bottom:15px; display: block;">
                            <label class="col-sm-3 control-label" for="inputEmail3">Fb Headline</label>
                            <div class="col-sm-9">
                              <input name="Ads[fb_headline]" type="text" value="'.$this->fb_headline.'" placeholder="FB Headline" class="form-control" required>
                            </div>
                          </div>
                          <div class="form-group" style="margin-bottom:15px; display: block;">
                            <label class="col-sm-3 control-label" for="inputEmail3">Fb Description</label>
                            <div class="col-sm-9">
                              <input name="Ads[fb_description]" type="text" value="'.$this->fb_description.'" placeholder="FB Description" class="form-control" required>
                            </div>
                          </div>
                          <div class="form-group" style="margin-bottom:15px; display: block;">
                            <label class="col-sm-3 control-label" for="inputEmail3">Mobile Redirect</label>
                            <div class="col-sm-9">
                              <input name="Ads[murl_redirect]" type="url" value="'.$this->murl_redirect.'" placeholder="Mobile Redirect" class="form-control" required>
                            </div>
                          </div>
                        </div>
                  </div>
                  <div class="modal-footer" style="padding:10px 20px 10px; margin-top:0;">
                    <button class="btn btn-primary pull-right" type="submit">Submit</button>
                  </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
            
            <script type="text/javascript">
            $("#ads-form").on("submit", function(e) {
                if($("#vip-number").val() == "0")
                    e.preventDefault();
            });
            </script>
            ';
    }
    
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
            array('youtube_id, fb_headline, fb_description, fb_thumbnail, view, created_datetime', 'required'),
            array('member_id, view, status', 'numerical', 'integerOnly' => true),
            array('youtube_id, fb_headline, fb_thumbnail, fb_sitename, purl_redirect, murl_redirect', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('b.email, author, a.member_id', 'safe', 'on' => 'search'),
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
            'fb_sitename' => 'Fb Sitename',
            'member_id' => 'Member',
            'purl_redirect' => 'Purl Redirect',
            'murl_redirect' => 'Murl Redirect',
            'view' => 'View',
            'created_datetime' => 'Created Datetime',
            'status' => 'Status',
            'adsfb' => 'FB ADS',
            'updateAds' => 'Edit Ads'
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
        $criteria->alias = 'a';
        $criteria->select = 'a.*, b.email as author';
        $criteria->join = 'left join member as b on a.member_id=b.id';

        $criteria->compare('b.email', $this->author, true);
        
        $criteria->order = 'a.id desc';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => '20')
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
