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
                    ->get()
            ]
        );
    }

    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail(); // use forceDelete() if you want to permanently delete it

        return redirect()->back()
            ->with('success', "Listing has been deleted!"); 
    }
}
