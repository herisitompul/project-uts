<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SettingResource;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return SettingResource::collection($settings);
    }

    public function show($id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json(['error' => 'Setting not found'], 404);
        }

        return new SettingResource($setting);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'value' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $setting = Setting::create($request->all());
        $settingResource = new SettingResource($setting);

        $links = [
            'self' => [
                'href' => route('settings.show', ['id' => $setting->id]),
                'method' => 'GET',
                'description' => 'Get setting details',
            ],
            'update' => [
                'href' => route('settings.update', ['id' => $setting->id]),
                'method' => 'PUT',
                'description' => 'Update setting details',
            ],
            'delete' => [
                'href' => route('settings.destroy', ['id' => $setting->id]),
                'method' => 'DELETE',
                'description' => 'Delete setting',
            ],
        ];

        return response()->json(['message' => 'Setting successfully added', 'setting' => $settingResource, 'links' => $links], 201);
    }
    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json(['error' => 'Setting not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'value' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $setting->update($request->all());
        return new SettingResource($setting);
    }

    public function destroy($id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json(['error' => 'Setting not found'], 404);
        }

        $setting->post();
        return response()->json(['message' => 'Setting deleted successfully']);
    }
}