<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Citizen extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'citizens';

    protected $fillable = ['first_name', 'phone','last_name','social_areas_id', 'fathers_name', 'birth_date', 'region_id', 'city_id', 'address', 'password', 'passport', 'tin', 'remember_token', 'created_at', 'updated_at',];

    public static function rules()
    {
        return [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'fathers_name' => 'string|required',
            'phone' => 'string|required',
            'birth_date' => 'integer|required',
            'region_id' => 'integer|nullable',
            'city_id' => 'integer|nullable',
            'address' => 'string|required',
            'password' => 'string|required',
            'passport' => 'string|required',
            'tin' => 'integer|required',
            'social_areas_id' => 'integer|required',
            'remember_token' => 'string|nullable',
            'created_at' => 'datetime|nullable',
            'updated_at' => 'datetime|nullable',

        ];
    }
    public function setBirthDateAttribute($value)
    {
        if (strpos($value, '.')) {
            $b_date = explode(".", $value);
            $value = $b_date[2] . "-" . $b_date[1] . "-" . $b_date[0];
        }
        $this->attributes['birth_date'] = $value;
    }

    public function getBirthDateAttribute(){
        return date('d.m.Y', strtotime($this->attributes['birth_date']));
    }

    public function region() {
        return $this->belongsTo('App\Region','region_id');
    }
    public function city() {
        return $this->belongsTo('App\City','city_id');
    }
    public function social_areas() {
        return $this->belongsTo('App\SocialAreas','social_areas_id');
    }

}
