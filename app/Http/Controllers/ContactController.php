<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->all('search');
        $contacts = Contact::with('organization')
        ->filter($filters)
        ->latest('id')
        ->paginate(3);

        return Inertia::render('Contacts/Index', compact('contacts', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organizations = \App\Models\Organization::all();
        $countries = \App\Models\Country::all();

        return Inertia::render('Contacts/Create', compact('organizations', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'country_id' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'organization_id' => 'required',
        ]);

        $contact = Contact::create($data);

        return redirect()->route('contacts.edit', $contact);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $organizations = \App\Models\Organization::all();
        $countries = \App\Models\Country::all();

        return Inertia::render('Contacts/Edit', compact('contact', 'organizations', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'country_id' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'organization_id' => 'required',
        ]);

        $contact->update($data);

        return redirect()->route('contacts.edit', $contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
