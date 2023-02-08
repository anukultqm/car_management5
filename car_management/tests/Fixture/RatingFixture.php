<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RatingFixture
 */
class RatingFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'rating';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'car_id' => 1,
                'rating' => 'Lorem ipsum dolor sit amet',
                'review' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'created_at' => '2023-02-01 08:57:33',
            ],
        ];
        parent::init();
    }
}
