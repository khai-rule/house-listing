<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{

    //? This is an alternative way of what we did in web.php --> adding routes protection
    // public function __construct()
    // {
    //     $this->middleware("auth")->except(["index", "show"]);
    // }

    public function __construct()
    {
        $this->authorizeResource(Listing::class, "listing");
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            "priceFrom", "priceTo", "beds", "baths", "areaFrom", "areaTo"
        ]);

        //* You don't even need to create $query variable and can just pass it down below directly if you want
        // $query = Listing::orderByDesc("created_at")  //  Sort by newest 
        // $query = Listing::mostRecent();  //  Sort by newest // Using local scope, see Listing.php
            // ->when(
            //     $filters["priceFrom"] ?? false,
            //     fn ($query, $value) => $query->where("price", ">=", $value)
            // )->when(
            //     $filters["priceTo"] ?? false,
            //     fn ($query, $value) => $query->where("price", "<=", $value)
            // )->when(
            //     $filters["baths"] ?? false,
            //     fn ($query, $value) => $query->where("baths", (int)$value < 6 ? "=" : ">=", $value) // how we handle 6+
            // )->when(
            //     $filters["beds"] ?? false,
            //     fn ($query, $value) => $query->where("beds", (int)$value < 6 ? "=" : ">=", $value)
            // )->when(
            //     $filters["areaFrom"] ?? false,
            //     fn ($query, $value) => $query->where("area", ">=", $value)
            // )->when(
            //     $filters["areaTo"] ?? false,
            //     fn ($query, $value) => $query->where("area", ">=", $value)
            // );

        //? Below functions the same way as above which filters based on the query
        //? Above is the preferred way of writing
        // if ($filters["priceFrom"] ?? false) {
        //     $query->where("price", ">=", $filters["priceFrom"]);
        // }
        // if ($filters["priceTo"] ?? false) {
        //     $query->where("price", "<=", $filters["priceTo"]);
        // }
        // if ($filters["baths"] ?? false) {
        //     $query->where("baths", $filters["baths"]);
        // }
        // if ($filters["beds"] ?? false) {
        //     $query->where("beds", $filters["beds"]);
        // }
        // if ($filters["areaTo"] ?? false) {
        //     $query->where("area", ">=", $filters["areaTo"]);
        // }
        // if ($filters["areaFrom"] ?? false) {
        //     $query->where("area", "<=", $filters["areaFrom"]);
        // }

        return inertia("Listing/Index", 
            [
                //* "listings" => Listing::all() // show all listings

                "filters" => $filters,
                "listings" => Listing::mostRecent()
                    ->filter($filters) // Filter using local scope
                    ->paginate(10) // paginate after sorting
                    ->withQueryString() // This will look at the url to see if there is a query
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize("create". Listing::class);
        return inertia("Listing/Create");
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
        
        return redirect()->route('listing.index')
            ->with('success', 'Listing was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // if (Auth::user()->cannot("view", $listing)) abort(403);  // You can write this so user will see 403 page. Policy "view" must return false
        //* $this->authorize("view", $listing); // Preferred way of writing above code // Policy "view" must return false

        return inertia(
            "Listing/Show", 
            [
                "listing" => $listing
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia("Listing/Edit", [
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
        
        return redirect()->route('listing.index')
            ->with('success', 'Listing has been updated!');
    }
}
