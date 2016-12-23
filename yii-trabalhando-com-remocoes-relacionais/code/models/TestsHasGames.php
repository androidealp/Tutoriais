<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tests_has_games}}".
 *
 * @property integer $tests_id
 * @property integer $games_id
 *
 * @property Games $games
 * @property Tests $tests
 */
class TestsHasGames extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tests_has_games}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tests_id', 'games_id'], 'required'],
            [['tests_id', 'games_id'], 'integer'],
            [['games_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['games_id' => 'id']],
            [['tests_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tests::className(), 'targetAttribute' => ['tests_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tests_id' => 'Tests ID',
            'games_id' => 'Games ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasOne(Games::className(), ['id' => 'games_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTests()
    {
        return $this->hasOne(Tests::className(), ['id' => 'tests_id']);
    }
}
