<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeCard;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeCardController extends Controller
{
    public function index()
    {
        $homePage = Page::where('slug', 'home')->first();

        return view('admin.home-cards.index', [
            'cards' => HomeCard::orderBy('sort_order')->orderByDesc('created_at')->get(),
            'homePage' => $homePage,
        ]);
    }

    public function updateSection(Request $request)
    {
        $validated = $request->validate([
            'home_cards_title' => 'nullable|string|max:255',
            'home_cards_subtitle' => 'nullable|string|max:500',
        ]);

        $homePage = Page::where('slug', 'home')->firstOrFail();
        $homePage->update($validated);

        return redirect()->route('admin.home-cards.index')->with('success', 'Section title updated successfully.');
    }

    public function create()
    {
        return view('admin.home-cards.form', ['card' => new HomeCard]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateCard($request);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['image'] = store_public_upload($request->file('image'), 'uploads/home-cards');

        HomeCard::create($validated);

        return redirect()->route('admin.home-cards.index')->with('success', 'Home card created successfully.');
    }

    public function edit(HomeCard $home_card)
    {
        return view('admin.home-cards.form', ['card' => $home_card]);
    }

    public function update(Request $request, HomeCard $home_card)
    {
        $validated = $this->validateCard($request, true);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = store_public_upload($request->file('image'), 'uploads/home-cards');
        } else {
            unset($validated['image']);
        }

        $home_card->update($validated);

        return redirect()->route('admin.home-cards.index')->with('success', 'Home card updated successfully.');
    }

    public function destroy(HomeCard $home_card)
    {
        $home_card->delete();

        return redirect()->route('admin.home-cards.index')->with('success', 'Home card deleted successfully.');
    }

    private function validateCard(Request $request, bool $updating = false): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'link' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
            'image' => ($updating ? 'nullable' : 'required') . '|image|max:4096',
        ]);
    }
}
