<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model implements \JsonSerializable
{
    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
