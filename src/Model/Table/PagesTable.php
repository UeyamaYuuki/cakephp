<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class PagesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function beforeSave($event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            // スラグをスキーマで定義されている最大長に調整
            $entity->slug = substr($sluggedTitle, 0, 191);
        }
    }
    public function validationDefault(Validator $validator): \Cake\Validation\Validator
    {
        $validator
            ->minLength('title', 10)
            ->maxLength('title', 255)
            ->notEmpty('title')

            ->notEmpty('body')
            ->minLength('body', 10);


        return $validator;
    }
}