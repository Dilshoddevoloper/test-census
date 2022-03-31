<?php
namespace App;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = ['name', 'display_name', 'description'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Permission::class);
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(Permission::class,'parent_id','id');
    }
}
