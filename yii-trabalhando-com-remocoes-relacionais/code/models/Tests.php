<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%tests}}".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property TestsHasGames[] $testsHasGames
 * @property Games[] $games
 */
class Tests extends \yii\db\ActiveRecord
{

  public $count_games = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tests}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['count_games'],'interger'],
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
            'nome' => 'Nome',
            'count_games'=>'Games'
        ];
    }


    public function search()
    {
      $query = Tests::find();

      $dataprovaider = new ActiveDataProvider([
        'query'=>$query,
        'pagination' => [
          'pageSize' => 10,
      ],
      ]);

      return $dataprovaider;

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestsHasGames()
    {
        return $this->hasMany(TestsHasGames::className(), ['tests_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Games::className(), ['id' => 'games_id'])->viaTable('{{%tests_has_games}}', ['tests_id' => 'id']);
    }

    public function getGame()
    {
        return $this->hasOne(Games::className(), ['id' => 'games_id'])->viaTable('{{%tests_has_games}}', ['tests_id' => 'id']);
    }

}
