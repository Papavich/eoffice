<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>


  <!-- Indicators -->
<div class="col-md-12 col-sm-12">
      <div class="row">
          <div class="form-group ">

                  <button type="button" onclick="pub1(this)" class="btn btn-default">
                      รูปแบบที่หนึ่ง
                  </button>
                  <button type="button" onclick="pub2(this)" class="btn btn-default">
                      รูปแบบที่สอง
                  </button>


                  <input type="text" name="cond[]" value="inside" class="hidden">
              </div>
          </div>
      </div>


  <!-- Wrapper for slides -->


  </div>
    <!--ฟอร์มที่2-->
    <div class="f1">

                <iframe src="http://stiic.sti.or.th/work/"height="500" width="100%"frameborder="0"scrolling="auto"align="right">
                </iframe>





        </div>
    <!---->

  <!-- Controls -->
    <!--ฟอร์มที่3-->
    <div class="f2 hidden">
        <iframe src=" https://www.sciencedirect.com/search?qs=portfolio&authors=&pub=&volume=&issue=&page=&origin=home&zone=qSearch"height="500" width="100%"frameborder="0"scrolling="auto"align="right">
        </iframe>


    </div>
    <!---->
</div>
<script>

function pub1 (ev) {
console.log(ev)


$('.f1').attr('class', 'f1 ')
$('.f2').attr('class', 'f2 hidden')

}

function pub2 (ev) {
console.log(ev)


$('.f1').attr('class', 'f1 hidden')
$('.f2').attr('class', 'f2 ')
}
</script>