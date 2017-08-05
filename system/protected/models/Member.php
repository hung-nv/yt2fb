<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $created_datetime
 * @property string $vip_start
 * @property string $vip_end
 * @property integer $vip_status
 * @property integer $status
 * @property integer $point
 */
class Member extends CActiveRecord {
    
    public $date, $action, $inforMember;
    
    public function getInforMember() {
        $quote = '<blockquote>';
        if($this->vip_status == 1) {
            $infor = '<p class="text-red">'.$this->email.'</p>
                <small>Name: <cite>'.$this->name.'</cite></small>';
            if(strtotime($this->vip_end) > time()) {
                $infor .= '<small>Vip: <cite class="text-red">YES</cite></small>
                <small>Vip End: <cite class="text-red">'.$this->vip_end.'</cite></small>
                <small>POINT: <cite>'.$this->point.'</cite></small>';
            } else {
                $infor .= '<small>Vip: <cite class="text-light-blue">Over</cite></small>
                <small>Vip End: <cite class="text-light-blue">'.$this->vip_end.'</cite></small>
                <small>POINT: <cite>'.$this->point.'</cite></small>';
            }
                
        } else {
            $infor = '<p>'.$this->email.'</p>
                <small>Vip: <cite>NO</cite></small>
                <small>Name: <cite>'.$this->name.'</cite></small>';
        }
        $end = '</blockquote>';
        return $quote.$infor.$end;
    }
    
    public function getaction() {
        return '<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" 
            data-target="#modal-dialog-'.$this->id.'">Add VIP</button>
            <div class="modal fade bs-example-modal-sm" id="modal-dialog-'.$this->id.'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Update Vip Member</h4>
                  </div>
                  <form class="form-horizontal" id="vip-form" data-toggle="validator" role="form" method="post">
                  <input name="Vip[id]" type="hidden" value="'.$this->id.'">
                  <div class="modal-body">
                       <div class="box-body">
                          <div class="form-group" style="margin-bottom:15px; display: block;">
                            <label class="col-sm-3 control-label" for="inputEmail3">Email</label>
                            <div class="col-sm-9">
                              <input name="Vip[email]" type="email" value="'.$this->email.'" placeholder="Email" class="form-control" disabled>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputEmail3">Month</label>
                            <div class="col-sm-9">
                              <input name="Vip[number]" id="vip-number" type="number" min="0" max="12" placeholder="Number" class="form-control" required>
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
            $("#vip-form").on("submit", function(e) {
                if($("#vip-number").val() == "0")
                    e.preventDefault();
            });
            </script>
            ';
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'member';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, password, created_datetime, point', 'required'),
            array('vip_status, status, point', 'numerical', 'integerOnly' => true),
            array('email, name, password', 'length', 'max' => 255),
            array('vip_start, vip_end', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, email, name, password, created_datetime, vip_start, vip_end, vip_status, status, point', 'safe', 'on' => 'search'),
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
            'email' => 'Email',
            'name' => 'Name',
            'password' => 'Password',
            'created_datetime' => 'Created Datetime',
            'vip_start' => 'Vip Start',
            'vip_end' => 'Vip End',
            'vip_status' => 'Vip Status',
            'status' => 'Status',
            'point' => 'Point',
            'inforMember' => 'Information Member'
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
        $criteria->compare('email', $this->email, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('created_datetime', $this->created_datetime, true);
        $criteria->compare('vip_start', $this->vip_start, true);
        $criteria->compare('vip_end', $this->vip_end, true);
        $criteria->compare('vip_status', $this->vip_status);
        $criteria->compare('status', $this->status);
        $criteria->compare('point', $this->point);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Member the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
