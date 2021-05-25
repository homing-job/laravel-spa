<?php

namespace App\UseCases\Admin\Master\JobCategory;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateAction{
    /**
     * __invoke
     *
     * @param Request $request
     * @return void
     */
    public function __invoke(Request $request): void
    {
        DB::transaction(function () use($request){
            if(!empty($request->file)){
                $path = Storage::putFile('public/images', $request->file, 'public');
            }else{
                $path = $request->item['image'];
            }

            $update = [
                'name' => $request->item['name'],
                'content' => $request->item['content'],
                'image' => $path,
                'sort_no' => $request->item['sort_no'],
            ];
            JobCategory::where('id', $request->item['id'])->update($update);
        });
    }
}
