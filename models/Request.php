<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string|null $request_name
 * @property string|null $request_description
 * @property int|null $category_id
 * @property int|null $user_id
 * @property string|null $photo
 * @property string|null $photo_after
 * @property string|null $data
 * @property string $status
 * @property string|null $reason
 *
 * @property Category $category
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'user_id'], 'integer'],
            [['data'], 'safe'],
            [['status'], 'string'],
            [['request_name', 'request_description', 'photo', 'photo_after', 'reason'], 'string', 'max' => 255],
            [['request_name', 'request_description', 'category_id'], 'required'],
            [['photo'], 'file',  'extensions' => ['png', 'jpg', 'gif'],'skipOnEmpty' => false ],
            [['photo_after'], 'file',  'extensions' => ['png', 'jpg', 'gif'],'skipOnEmpty' => false ],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_name' => 'Название запроса',
            'request_description' => 'Описание запроса',
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'photo' => 'Фото',
            'photo_after' => 'Фото после',
            'data' => 'Дата',
            'status' => 'Статус',
            'reason' => 'Причина',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public function getRequest()
    {
        return $this->hasOne(Request::class, ['id' => 'id']);
    }
}

