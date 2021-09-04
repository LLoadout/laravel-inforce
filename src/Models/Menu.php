<?php

namespace LLoadoutInforce\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * @return mixed
     */
    public function menu()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->with('menu');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id')->with('parent');
    }

    public function getPrefixInfoAttribute()
    {
        $count = $root = 0;
        $path = strrev(\Str::slug($this->name)).".";
        $this->countParents($this, $count, $root, $path);
        $path = "menu".strrev($path);

        return ['count' => $count, 'root' => $root, 'name' => str_repeat('-', $count) . " " . $this->name, 'path' => $path];
    }

    private function countParents($menu, &$count, &$root, &$path)
    {
        if (! empty($menu->parent)) {
            $count++;
            $root = $menu->parent;
            $path .= strrev(".".\Str::slug($menu->parent->name));
            $this->countParents($menu->parent, $count, $root, $path);
        }
    }
}
