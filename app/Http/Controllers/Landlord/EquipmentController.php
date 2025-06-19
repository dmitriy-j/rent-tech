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
        /*$equipments = Equipment::where('owner_id', auth()->id())->get();
        return view('landlord.equipment.index', compact('equipments'));*/
            $equipments = Equipment::where('owner_id', auth()->id())
                    ->paginate(10); // 10 элементов на странице
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

    public function show(Equipment $equipment)
    {
        $this->authorize('view', $equipment);
        return view('landlord.equipment.show', compact('equipment'));
    }

    public function edit(Equipment $equipment)
    {
        $this->authorize('update', $equipment);
        return view('landlord.equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $this->authorize('update', $equipment);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'hourly_rate' => 'required|numeric|min:100',
            'status' => 'required|in:available,rented,repair',
            'image' => 'nullable|image|max:2048',
        ]);

        // Обновление изображения
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($equipment->image_path) {
                Storage::disk('public')->delete($equipment->image_path);
            }
            $data['image_path'] = $request->file('image')->store('equipment', 'public');
        }

        $equipment->update($data);

        return redirect()->route('landlord.equipment.index')
            ->with('success', 'Техника успешно обновлена');
    }

    public function destroy(Equipment $equipment)
    {
        $this->authorize('delete', $equipment);

        // Проверка на активные заказы
        if ($equipment->activeRentals()->exists()) {
            return redirect()->back()
                ->withErrors('Нельзя удалить технику с активными арендами');
        }

        // Удаление изображения
        if ($equipment->image_path) {
            Storage::disk('public')->delete($equipment->image_path);
        }

        $equipment->delete();

        return redirect()->route('landlord.equipment.index')
            ->with('success', 'Техника успешно удалена');
    }
}
