<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Car Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $brand_id
 * @property string|null $name
 * @property string $make
 * @property string $model
 * @property string $color
 * @property string $description
 * @property string $image
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $modified_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Brand $brand
 * @property \App\Model\Entity\Rating[] $rating
 */
class Car extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'user_id' => true,
        'brand_id' => true,
        'name' => true,
        'make' => true,
        'model' => true,
        'color' => true,
        'description' => true,
        'image' => true,
        'status' => true,
        'created_at' => true,
        'modified_at' => true,
        'user' => true,
        'brand' => true,
        'rating' => true,
    ];
}
