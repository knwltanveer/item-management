<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return successResponse(
            ['items' => $items],
            Lang::get('messages.success'),
            Lang::get('messages.item_list')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:items,name',
        ]);
        try {
            $item = Item::create([
                'name'        => request('name'),
                'is_selected' => false,
            ]);
            return successResponse(
                ['item' => $item],
                Lang::get('messages.success'),
                Lang::get('messages.item_created')
            );
        } catch (\Throwable $th) {
            return errorResponse(
                Lang::get('messages.failure'),
                Lang::get('messages.server_error'),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $th->getMessage()
            );
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $item)
    {
        $localItem = Item::whereId($item)->first();
        try {
            $localItem->is_selected = $request->is_selected;
            $localItem->update();
            return successResponse(
                ['item' => $localItem],
                Lang::get('messages.success'),
                Lang::get('messages.item_updated')
            );
        } catch (\Throwable $th) {
            return errorResponse(
                Lang::get('messages.failure'),
                Lang::get('messages.server_error'),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $th->getMessage()
            );
        }
    }


}
