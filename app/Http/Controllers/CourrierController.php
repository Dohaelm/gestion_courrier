<?php

namespace App\Http\Controllers;
use App\Pagination\CustomPaginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courrier;
use App\Models\CourrierSupprime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CourrierController extends Controller
{
    public function index(Request $request)
    {
        $query = Courrier::query();
        $searchTerm = $request->input('search');
    
        if ($request->filled('search')) {
            $searchTerms = explode(' ', $request->input('search'));
    
            foreach ($searchTerms as $term) {
                $query->where(function ($query) use ($term) {
                    $query->where('expediteur', 'like', "%{$term}%")
                          ->orWhere('destinataire', 'like', "%{$term}%")
                          ->orWhere('type', 'like', "%{$term}%")
                          ->orWhere('date', 'like', "%{$term}%"); // Assuming date is a string field
                });
            }
        }
    
        $courriers = $query->paginate(10);
    
        return view('courriers.index', compact('courriers','searchTerm'));
    }
    public function corbeille(Request $request)
    {
        $query = CourrierSupprime::query();
    
        if ($request->filled('search')) {
            $searchTerms = explode(' ', $request->input('search'));
    
            foreach ($searchTerms as $term) {
                $query->where(function ($query) use ($term) {
                    $query->where('expediteur', 'like', "%{$term}%")
                          ->orWhere('destinataire', 'like', "%{$term}%")
                          ->orWhere('type', 'like', "%{$term}%")
                          ->orWhere('date', 'like', "%{$term}%") // Assuming date is a string field
                          ->orWhere('motif_de_suppression', 'like', "%{$term}%"); // Assuming date is a string field
                });
            }
        }
    
        $courriers = $query->paginate(10);
    
        return view('courriers.corbeille', compact('courriers'));
    }
    public function create(){
        return view('courriers.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'date' => 'required|date',
            'destinataire' => 'required',
            'expediteur' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }
    
        Courrier::create([
            'type' => $request->type,
            'date' => $request->date,
            'destinataire' => $request->destinataire,
            'expediteur' => $request->expediteur,
            'description' => $request->description,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('courrier.index')->with('success', 'Courrier enregistré avec succès.');
    }
    public function edit(Courrier $courrier)
{
    return view('courriers.edit', ['courrier' => $courrier]);
}
    public function update(Request $request, Courrier $courrier)
    {
        $request->validate([
            'type' => 'required',
            'date' => 'required|date',
            'destinataire' => 'required',
            'expediteur' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        if ($request->has('delete_image') && $request->delete_image == 1) {
            Storage::delete('public/' . $courrier->image);
            $courrier->image = null; // or set to any default image if applicable
        }
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            if ($courrier->image) {
                Storage::disk('public')->delete($courrier->image);
            }
        } else {
            $imagePath = $courrier->image;
        }
    
        $courrier->update([
            'type' => $request->type,
            'date' => $request->date,
            'destinataire' => $request->destinataire,
            'expediteur' => $request->expediteur,
            'description' => $request->description,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('courrier.index')->with('success', 'Courrier modifié avec succès.');
    }
         public function destroy(Courrier $courrier, Request $request)
        {
            CourrierSupprime::create([
                'type' => $courrier->type,
                'date' => $courrier->date,
                'destinataire' => $courrier->destinataire,
                'expediteur' => $courrier->expediteur,
                'description' => $courrier->description,
              'image' => $courrier->image ?? 'default.png',
                'motif_de_suppression'=>$request->motif_de_suppression

            ]);
            $courrier->delete();
            return redirect(route('courrier.index'))->with('success', 'Courrier supprimé avec succès.');
        }
}
