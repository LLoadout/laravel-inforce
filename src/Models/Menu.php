<?php

namespace LLoadoutEnforce\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    /**
     * @return mixed
     */
    public function menu()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->withCount('parent')->with('menu');
    }

    public function parent(){
        return $this->belongsTo(Menu::class,'parent_id','id');
    }
}
