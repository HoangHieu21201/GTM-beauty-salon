<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tree = [
            'Phẫu thuật thẩm mỹ' => [
                'Nâng mũi',
                'Nâng ngực',
                'Cắt mí',
                'Hút mỡ',
                'Gọt cằm',
                'Độn cằm',
                'Căng da mặt',
            ],
            'Chăm sóc da' => [
                'Trẻ hóa da',
                'Trị mụn',
                'Tắm trắng',
                'Điều trị nám',
                'Peel da',
            ],
            'Răng - Hàm - Mặt' => [
                'Niềng răng',
                'Bọc răng sứ',
                'Tẩy trắng răng',
                'Cấy ghép Implant',
            ],
        ];

        $categories = Category::orderBy('parent_id')->orderBy('name')->get();

        foreach ($tree as $parentName => $children) {
            $parent = $this->findCategoryBySlug($categories, $parentName);

            if (! $parent) {
                $parent = Category::create([
                    'name' => $parentName,
                    'slug' => Str::slug($parentName),
                    'parent_id' => null,
                ]);
                $categories->push($parent);
            } elseif ($parent->parent_id !== null) {
                $parent->update(['parent_id' => null]);
                $parent->parent_id = null;
            }

            foreach ($children as $childName) {
                $child = $this->findCategoryBySlug($categories, $childName);

                if (! $child) {
                    $child = Category::create([
                        'name' => $childName,
                        'slug' => Str::slug($childName),
                        'parent_id' => $parent->id,
                    ]);
                    $categories->push($child);
                    continue;
                }

                if ($child->parent_id === null && ! $child->children()->exists()) {
                    $child->update(['parent_id' => $parent->id]);
                    $child->parent_id = $parent->id;
                }
            }
        }
    }

    private function findCategoryBySlug($categories, string $name)
    {
        $slug = Str::slug($name);

        return $categories->first(
            fn ($category) => Str::slug($category->name) === $slug || $category->slug === $slug
        );
    }
}
