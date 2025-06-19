<?php

namespace App\Http\Controllers\Landlord;

use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::where('owner_id', auth()->id())->get();
        return view('landlord.equipment.index', compact('equipments'));
    }

    public function create()
    {
        return view('landlord.equipment.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'hourly_rate' => 'required|numeric|min:100',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['owner_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('equipment', 'public');
        }

        Equipment::create($data);

        return redirect()->route('landlord.equipment.index')
            ->with('success', 'Техника успешно добавлена');
    }

    public function edit(Equipment $equipment)
    {
        // Убедитесь, что редактировать может только владелец устройства
        if ($equipment->owner_id !== auth()->id()) {
            abort(403, 'Недостаточно прав для редактирования.');
        }

        return view('landlord.equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        // Убедитесь, что только владелец устройства может обновлять
        if ($equipment->owner_id !== auth()->id()) {
            abort(403, 'Недостаточно прав для обновления.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'hourly_rate' => 'required|numeric|min:100',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Удалите старые фотографии (если они существуют)
            if ($equipment->image_path) {
                Storage::disk('public')->delete($equipment->image_path);
            }

            // Сохранить новое изображение
            $data['image_path'] = $request->file('image')->store('equipment', 'public');
        }

        $equipment->update($data);

        return redirect()->route('landlord.equipment.index')
            ->with('success', 'Техника успешно обновлена');
    }

    public function destroy(Equipment $equipment)
    {
        // Убедитесь, что удалить его может только владелец устройства
        if ($equipment->owner_id !== auth()->id()) {
            abort(403, 'Недостаточно прав для удаления.');
        }

        // Удалить картинку (если она существует)

        if ($equipment->image_path) {
            Storage::disk('public')->delete($equipment->image_path);
        }

        $equipment->delete();

        return redirect()->route('landlord.equipment.index')
            ->with('success', 'Техника успешно удалена');
    }
}
