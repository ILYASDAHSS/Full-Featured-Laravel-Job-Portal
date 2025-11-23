<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Listing;

class ListingController extends Controller
{
    //show all listings
    public function index(/*Request $request  dependincie injection */){
    //  dd(request("tag"));
      return view('listings.index',[
        'heading' => 'Latest Job Listings',
        'listings' => Listing::latest()->filter(request(["tag", "search"]))->paginate(4)
    ]);
    }
    
    //show single listings
    public function show(Listing $listingS){
      return view('listings.show', [
        'heading' => $listingS['title'],
        'listings' => [$listingS]
      ]);
    }
    //the form 
    public function create(Listing $listings){  
    return view('listings.create');
    }

    //show edit form
    public function edit(Listing $listingS){
        return view('listings.edit', [
            'listing' => $listingS
        ]);
    }

    //update listing
    public function update(Request $request, Listing $listingS){
        $formFields = $request->validate([
            'title' => ['required', 'min:3'],
            'company' => ['required', 'min:2'],
            'location' => ['required'],
            'email' => ['required', 'email'],
            'website' => ['nullable', 'url'],
            'tags' => ['required'],
            'description' => ['required', 'min:20'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($listingS->logo && Storage::disk('public')->exists($listingS->logo)) {
                Storage::disk('public')->delete($listingS->logo);
            }
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listingS->update($formFields);

        return redirect()
            ->route('listings.show', $listingS)
            ->with('message', 'Job listing updated successfully!');
    }

    //delete listing
    public function destroy(Listing $listingS){
        
        if ($listingS->logo && Storage::disk('public')->exists($listingS->logo)) {
            Storage::disk('public')->delete($listingS->logo);
        }

        $listingS->delete();

        return redirect()
            ->route('listings.index')
            ->with('message', 'Job listing deleted successfully!');
    }
}
