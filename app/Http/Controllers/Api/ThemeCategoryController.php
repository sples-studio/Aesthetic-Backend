<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ThemeCategory;
use Illuminate\Http\Request;

class ThemeCategoryController extends Controller
{

    private function headline($headline, $limit = null)
    {
            $categories = $headline->categories();
            if ($limit) $categories->limit($limit);
            $categories = $categories->get();
            $catArray = [];
            /** @var ThemeCategory $category */
            foreach($categories as $category) {
                $catArray[] = [
                    "id" => $category->id,
                    "title" => $category->title,
                    "is_premium" => $category->is_premium,
                    "cover_image_url" => $category->cover_image_url,
                ];
            }
            return ["id" => $headline->id, "title" => $headline->title, "categories" => $catArray];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        return ThemeCategory::query()
            ->paginate($perPage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ThemeCategory  $themeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ThemeCategory $category)
    {
       return [
            'id' => $category->id,
            'title' => $category->title,
            'is_premium' => $category->is_premium,
            'cover_image_url' => $category->cover_image_url
        ];
    }

    public function themes(Request $request, ThemeCategory $category)
    {
        $perPage = $request->get('per_page', 5);
        return $category->themes()->paginate($perPage);
    }
}
