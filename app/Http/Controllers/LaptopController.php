<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LaptopController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        // Показва всички лаптопи
        $laptops = Laptop::latest()->paginate(10);
        return view('laptops.index', compact('laptops'));
    }

    public function create()
    {
        return view('laptops.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $laptop = new Laptop();
        $laptop->brand = $request->brand;
        $laptop->model = $request->model;
        $laptop->year = $request->year;
        $laptop->description = $request->description;
        $laptop->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('laptops', 'public');
            $laptop->image = $path;
        }

        $laptop->save();

        return redirect()->route('laptops.index')->with('success', 'Лаптопът е добавен успешно!');
    }

    public function show(Laptop $laptop)
    {
        return view('laptops.show', compact('laptop'));
    }

    public function edit(Laptop $laptop)
    {
        // Временно премахваме authorize проверката
        // $this->authorize('update', $laptop); // Policy check
        
        // Проверка дали потребителят е създал този лаптоп
        if (Auth::id() !== $laptop->user_id) {
            return redirect()->route('laptops.index')
                ->with('error', 'Нямате право да редактирате този лаптоп!');
        }
        
        return view('laptops.edit', compact('laptop'));
    }

    public function update(Request $request, Laptop $laptop)
    {
        // Временно премахваме authorize проверката
        // $this->authorize('update', $laptop);
        
        // Проверка дали потребителят е създал този лаптоп
        if (Auth::id() !== $laptop->user_id) {
            return redirect()->route('laptops.index')
                ->with('error', 'Нямате право да обновявате този лаптоп!');
        }

        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $laptop->brand = $request->brand;
        $laptop->model = $request->model;
        $laptop->year = $request->year;
        $laptop->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('laptops', 'public');
            $laptop->image = $path;
        }

        $laptop->save();

        return redirect()->route('laptops.index')->with('success', 'Лаптопът е обновен успешно!');
    }

    public function destroy(Laptop $laptop)
    {
        // Временно премахваме authorize проверката и позволяваме директно изтриване
        // $this->authorize('delete', $laptop);
        
        // Проверка дали потребителят е създал този лаптоп
        if (Auth::id() !== $laptop->user_id) {
            return redirect()->route('laptops.index')
                ->with('error', 'Нямате право да изтриете този лаптоп!');
        }
        
        $laptop->delete();

        return redirect()->route('laptops.index')->with('success', 'Лаптопът е изтрит успешно!');
    }
}
