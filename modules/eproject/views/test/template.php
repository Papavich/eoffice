<?php

/* @var $this yii\web\View */


use app\modules\eproject\controllers;

$this->title = controllers::t( 'label', 'Test' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

//Open Form
$form = ActiveForm::begin( ['method' => 'get', 'action' => 'student-per-adviser'] );
ActiveForm::end();

//Select2 Major with All value
$data = ArrayHelper::map( \app\modules\eproject\models\Major::find()->all(), 'id', 'name' );
$data[0] = controllers::t( 'label', 'All' );
ksort( $data );
echo '<label class="control-label">' . controllers::t( 'label', 'Major' ) . '</label>';
echo Select2::widget( [
    'name' => 'major',
    'data' => $data,
    'value' => $major
] );


//Search Button
echo '<br>' . Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) . '',
        ['class' => 'btn btn-3d btn-teal pull-right'] );



//LEFT OUPTER JOIN
$subjectDocumentTypes = SubjectDocumentType::find()
    ->leftJoin( ProjectDocument::tableName()
        , SubjectDocumentType::tableName() . '.document_type_id=' . ProjectDocument::tableName()
        . '.document_type_id
                         AND ' . ProjectDocument::tableName() . '.project_id = ' . $project->id )
    ->where( ['subject_id' => $project->subject] )
    ->andWhere( ProjectDocument::tableName() . '.project_id is null' )
    ->all();
foreach ($subjectDocumentTypes as $subjectDocumentType) {
    echo $subjectDocumentType->documentType->name . ', ';
}
?>


//Not found Template
<?php if (count( $requestAdvisee ) != 0) { ?>
<?php }else { ?>
    <div align="center" class="main-container">
        <?= controllers::t( 'label', 'Not Found' ) ?>
    </div>

<?php  }

//Double Left Join

$studentProjects = Enroll::find()
    ->leftJoin( StudentProject::tableName(),
        Enroll::tableName().'.student_id = '.StudentProject::tableName().'.student_id')
    ->leftJoin(Advise::tableName(),Advise::tableName() . '.project_id = ' . StudentProject::tableName() . '.project_id')
    ->where( [Enroll::tableName() . '.year_id' => ModelHelper::getNowYear()] )
    ->andWhere( [Enroll::tableName() . '.semester_id' => ModelHelper::getNowSemester()] )
    ->andWhere( Advise::tableName() . '.project_id is null' )
    ->orWhere( StudentProject::tableName() . '.project_id is null' )
    ->all();?>

<?php
//Fill Comma
$tmp=[];
foreach ($subjectDocumentTypes as $subjectDocumentType) {
    $tmp[]=$subjectDocumentType->documentType->name;
}
echo  implode(', ',$tmp);

$subQuery = Advise::find()
    ->where( ['project_id' => $this->id] )
    ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
    ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
    ->andWhere(['adviser_type_id'=>AdviserType::TYPE_PRIMARY_ADVISER])
    ->select('adviser_id');
return User::find()
    ->where(['not in', 'id', $subQuery])
    ->andWhere( [User::tableName() . '.user_type_id' => 1] )
    ->all();
?>


<script>
  //id is element of select2
  //data is select option : id,name
  function addSelect2 (id ,data) {
    var $select = $('#'+id);

// save current config. options
    var options = $select.data('select2').options.options;

// delete all items of the native select element
    $select.html('');

// build new items
    var items = [];
    for (var i = 0; i < data.length; i++) {
      items.push({
        "id": data[i]['id'],
        "text": data[i]['name']
      });
      $select.append("<option value=\"" +data[i]['id']+ "\">" + data[i]['name']+ "</option>");
    }
// add new items
    options.data = items;
    $select.select2(options);
  }

  $.ajax({
    url    : 'ajax-get-subject',
    type   : 'POST',
    data   : {
      year: year,
      semester: semester,
      major: major
    },
    beforeSend: function () {
      swal({
        title: "ท่านต้องการลบหนังสือทำลายใช่หรือไม่?",
        text: "ท่านไม่สามารถกู้คืนข้อความของท่านได้หากยกเลิก",
        type: "warning",
        showCancelButton: true,
        icon: "success",


      })
    },
    complete: function (data, status) {
      data=data.responseJSON
      var select = $('#subject')
      select.html(' <option disabled selected value> -- กรุณาเลือกรายวิขา -- </option>')
      for (var i = 0; i < data.length; i++) {
        select.append('<option value="' + data[i]['id'] + '">' + data[i]['name'] + '</option>')
      }
    }
  })
</script>