<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\BrandsTable&\Cake\ORM\Association\HasMany $Brands
 * @property \App\Model\Table\CarsTable&\Cake\ORM\Association\HasMany $Cars
 * @property \App\Model\Table\RatingTable&\Cake\ORM\Association\HasMany $Rating
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Brands', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Cars', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Rating', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->notEmptyString('name','Please enter the name');

        $validator
            ->email('email')
            ->notEmptyString('email','please enter the email');

            $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->allowEmptyString('password')
            ->notEmptyString('password','please enter the Password')
            ->add('password',[
                'password'=>array("rule"=>array('custom','/[A-Z]/'),
                "message"=>'Password must contain at least one uppercase'),

                'password-2'=>array("rule"=>array('custom','/[a-z]/'),
                "message"=>'Password must contain at least lowercase'),

                'password-3'=>array("rule"=>array('custom','/[0-9]/'),
                "message"=>'Password must contain at least one numeric digit'),

                'password-4'=>array("rule"=>array('custom','/[!@#$%^&*_]/'),
                "message"=>'Password must contain at least one special character'),

                'password-4'=>array("rule"=>array('custom','/^\S+$/'),
                "message"=>'Password not be white space'),
            ]);
        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->allowEmptyString('status');

        $validator
            ->integer('role')
            ->notEmptyString('role');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('modified_at')
            ->allowEmptyDateTime('modified_at');

        $validator
            ->scalar('token')
            ->maxLength('token', 255)
            ->allowEmptyString('token');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }
}
