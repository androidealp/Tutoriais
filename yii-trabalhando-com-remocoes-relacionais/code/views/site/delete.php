<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Remover relações';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">

      <div class="col-md-6">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Testes</h3>
          </div>
          <div class="panel-body">

            <?php

            echo GridView::widget([
               'dataProvider' => $testes,
               'tableOptions'=>[
                 'class'=>'table table-striped'
               ],
               'columns' => [
                 [
                   'attribute' => 'id',
                   'format' => 'text'
                 ],
                 [
                   'attribute' => 'nome',
                   'format' => 'text'
                 ],
                 [
                   'attribute' => 'count_games',
                   'format' => 'raw',
                   'value'=>function($data)
                   {
                     return '<label class="btn btn-success btn-sm">'.count($data->games).'</label>';
                   }
                 ],
                 [
                   'attribute'=>'Deletar',
                   'format'=>'raw',
                   'value'=>function($data){
                     return \yii\helpers\Html::a('Remover', ['site/deletar-test/','id'=>$data->id],['class'=>'btn btn-danger btn-sm']);
                   }
                 ],

           ]]);
             ?>

          </div>
        </div>



      </div>

      <div class="col-md-6">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Games</h3>
          </div>
          <div class="panel-body">
            <?php

            echo GridView::widget([
               'dataProvider' => $games,
               'tableOptions'=>[
                 'class'=>'table table-striped'
               ],
               'columns' => [
                 [
                   'attribute' => 'id',
                   'format' => 'text'
                 ],
                 [
                   'attribute' => 'nome',
                   'format' => 'text'
                 ],
                 [
                   'attribute'=>'count_testes',
                   'format'=>'raw',
                   'value'=>function($data){
                     return "<label class='btn btn-info btn-sm'>".count($data->tests).'</label>';
                   }
                 ],

                 [
                   'attribute'=>'Deletar',
                   'format'=>'raw',
                   'value'=>function($data){
                     return \yii\helpers\Html::a('Remover', ['site/deletar-game/','id'=>$data->id],['class'=>'btn btn-danger btn-sm']);
                   }
                 ],

           ]]);
             ?>
          </div>

        </div>


      </div>

    </div>


</div>
