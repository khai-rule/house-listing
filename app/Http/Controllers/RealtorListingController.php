<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, "listing");
    }

    public function index(Request $request) 
    {
        // dd(Auth::user()->listings);
        // dd($request->all());
        
        $filters = [
            "deleted" => $request->boolean("deleted"), // We have to add "boolean" because php by default return a strings
            ...$request->only(["by", "order"])
        ];

        return inertia(
            "Realtor/Index",
            [
                "filters" => $filters,
                "listings" => Auth::user()
                    ->listings()
                    // ->mostRecent()
                    ->filter($filters)
                    ->paginate(10)
                    ->withQueryString()
                    // ->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize("create". Listing::class);
        return inertia("Realtor/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //* Listing::create(  This is what we have at the start
        $request->user()->listings()->create( //* We change it to this so that every listing we create will be associated to the current user
            $request->validate([
                "beds" => "required|integer|min:0|max:20",
                "baths" => "required|integer|min:0|max:20",
                "area" => "required|integer|min:15|max:1500",
                "city" => "required",
                "code" => "required",
                "street" => "required",
                "street_nr" => "required|min:1|max:1000",
                "price" => "required|integer|min:1|max:20000000",
            ])
        );
        
        return redirect()->route('realtor.index')
            ->with('success', 'Listing was created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia("Realtor/Edit", [
            "listing" => $listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                "beds" => "required|integer|min:0|max:20",
                "baths" => "required|integer|min:0|max:20",
                "area" => "required|integer|min:15|max:1500",
                "city" => "required",
                "code" => "required",
                "street" => "required",
                "street_nr" => "required|min:1|max:1000",
                "price" => "required|integer|min:1|max:20000000",
            ])
        );
        
        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing has been updated!');
    }

    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail(); // use forceDelete() if you want to permanently delete it

        return redirect()->back()
            ->with('success', "Listing has been deleted!"); 
    }
}
