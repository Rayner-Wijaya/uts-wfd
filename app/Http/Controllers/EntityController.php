<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function index()
    {
        $entities = Entity::all();
        return view('entities.index', compact('entities'));
    }

    public function show(Entity $entity)
    {
        $items = $entity->items;
        return view('entities.show', compact('entity', 'items'));
    }
}
