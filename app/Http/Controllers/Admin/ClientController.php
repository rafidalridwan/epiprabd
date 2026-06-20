<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('admin.clients.index', [
            'clients' => Client::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.clients.form', ['client' => new Client]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateClient($request);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('uploads/clients', 'public');
        }

        Client::create($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Client logo created successfully.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.form', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $this->validateClient($request, $client->exists);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('uploads/clients', 'public');
        } else {
            unset($validated['logo']);
        }

        $client->update($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Client logo updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client logo deleted successfully.');
    }

    private function validateClient(Request $request, bool $updating = false): array
    {
        return $request->validate([
            'name' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'logo' => ($updating ? 'nullable' : 'required') . '|image|max:4096',
        ]);
    }
}
