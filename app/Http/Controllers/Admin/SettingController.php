<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        
        // Scan for logos in public/uploads/logos
        $logos = [];
        $logosPath = public_path('uploads/logos');
        if (file_exists($logosPath)) {
            $files = array_diff(scandir($logosPath), ['.', '..']);
            $filePaths = [];
            foreach ($files as $file) {
                $filePath = $logosPath . '/' . $file;
                if (is_file($filePath)) {
                    $filePaths[] = $filePath;
                }
            }
            // sort by modified time desc
            usort($filePaths, function ($a, $b) {
                return filemtime($b) - filemtime($a);
            });
            $logos = array_map(function($file) {
                return 'uploads/logos/' . basename($file);
            }, $filePaths);
        }

        return view('admin.pages.settings.index', compact('settings', 'logos'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        // 1. Handle Logo Selection or Cropped Upload
        if ($request->filled('site_logo_base64')) {
            $image_parts = explode(";base64,", $request->site_logo_base64);
            if (count($image_parts) == 2) {
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1] ?? 'png';
                $image_base64 = base64_decode($image_parts[1]);
                $fileName = 'logo_' . time() . '.' . $image_type;
                
                $destinationPath = public_path('uploads/logos');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                file_put_contents($destinationPath . '/' . $fileName, $image_base64);
                
                $data['site_logo'] = 'uploads/logos/' . $fileName;
            }
            unset($data['site_logo_base64']);
        } elseif ($request->filled('site_logo_existing')) {
            // User selected an old logo
            $data['site_logo'] = $request->site_logo_existing;
            unset($data['site_logo_existing']);
        }

        // Clean up temporary logo fields
        unset($data['site_logo_file'], $data['site_logo_base64'], $data['site_logo_existing']);

        // 2. Handle Footer Columns Builder
        $footerColumns = [];
        for ($i = 1; $i <= 3; $i++) {
            $title = $request->input("footer_col_{$i}_title");
            $linksInput = $request->input("footer_col_{$i}_links", []);
            
            $links = [];
            foreach ($linksInput as $link) {
                if (!empty($link['label']) || !empty($link['url'])) {
                    $links[] = [
                        'text' => $link['label'] ?? '',
                        'url' => $link['url'] ?? '#'
                    ];
                }
            }
            
            if (!empty($title) || !empty($links)) {
                $footerColumns[] = [
                    'title' => $title,
                    'links' => $links
                ];
            }
            
            unset($data["footer_col_{$i}_title"], $data["footer_col_{$i}_links"]);
        }

        if (!empty($footerColumns)) {
            $data['footer_columns'] = json_encode($footerColumns, JSON_UNESCAPED_UNICODE);
        } else {
            $data['footer_columns'] = json_encode([]);
        }

        // 3. Handle Footer Socials Builder
        $socialsInput = $request->input('footer_socials_links', []);
        $socials = [];
        foreach ($socialsInput as $social) {
            if (!empty($social['url'])) {
                $socials[] = [
                    'icon' => $social['icon'] ?? 'pi-link',
                    'url' => $social['url'] ?? '#',
                    'title' => $social['title'] ?? ''
                ];
            }
        }
        $data['footer_socials'] = json_encode($socials, JSON_UNESCAPED_UNICODE);
        unset($data['footer_socials_links']);

        // 4. Save to Database
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value]
            );
        }

        Cache::forget('site_settings');

        return redirect()->back()->with('success', 'Cấu hình đã được cập nhật thành công!');
    }

    public function deleteLogo(Request $request)
    {
        $path = $request->input('path');
        // Path should be like "uploads/logos/..."
        if (strpos($path, 'uploads/logos/') === 0) {
            $fullPath = public_path($path);
            if (file_exists($fullPath)) {
                unlink($fullPath);
                
                // If it's the current logo, remove it from settings
                if (setting('site_logo') === $path) {
                    Setting::where('key', 'site_logo')->update(['value' => null]);
                    Cache::forget('site_settings');
                }

                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false], 400);
    }
}
