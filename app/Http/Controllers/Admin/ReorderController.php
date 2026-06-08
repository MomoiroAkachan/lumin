<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ReorderController extends Controller
{
    public function __invoke(ReorderRequest $request): JsonResponse
    {
        /** @var class-string<Model> $modelClass */
        $modelClass = config('admin-reorder.resources.'.$request->validated('resource'));
        /** @var list<int> $order */
        $order = $request->validated('order');

        $existingIds = $modelClass::query()
            ->whereIn('id', $order)
            ->pluck('id')
            ->all();

        if (count($existingIds) !== count($order)) {
            return response()->json(['message' => 'Lista de itens inválida.'], 422);
        }

        DB::transaction(function () use ($modelClass, $order): void {
            foreach ($order as $position => $id) {
                $modelClass::query()
                    ->whereKey($id)
                    ->update(['position' => $position]);
            }
        });

        return response()->json(['message' => 'Ordem atualizada.']);
    }
}
