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

    public function index() 
    {
        // dd(Auth::user()->listings);
        return inertia(
            "Realtor/Index",
            ["listings" => Auth::user()->listings]
        );
    }

    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail(); // use forceDelete() if you want to permanently delete it

        return redirect()->back()
            ->with('success', "Listing has been deleted!"); 
    }
}
