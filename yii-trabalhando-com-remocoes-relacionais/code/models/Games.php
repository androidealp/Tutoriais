<?php

namespace app\models;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * This is the model class for table "{{%games}}".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property TestsHasGames[] $testsHasGames
 * @property Tests[] $tests
 */
class Games extends \yii\db\ActiveRecord
{

  public $count_testes = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%games}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['count_testes'],'interger'],
            [['nome'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome do game',
            'count_testes'=>'Testes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestsHasGames()
    {
        return $this->hasMany(TestsHasGames::className(), ['games_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTests()
    {
        return $this->hasMany(Tests::className(), ['id' => 'tests_id'])->viaTable('{{%tests_has_games}}', ['games_id' => 'id']);
    }


    public function search()
    {
      $query = Games::find();

      $dataprovaider = new ActiveDataProvider([
        'query'=>$query,
        'pagination' => [
          'pageSize' => 10,
      ],
      ]);

      return $dataprovaider;

    }

}
