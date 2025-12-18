<?php

namespace App\Http\Controllers;

use App\Enums\AdoptionStatus;
use App\Enums\Status;
use App\Jobs\ProcessUploadedAnimalImage;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Note;
use App\Models\Species;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AnimalsController extends Controller
{
    public function index()
    {
        $animals = Animal::with('breed')
            ->with('coat')
            ->with('specie')
            ->with('vaccines')
            ->with('notes')
            ->paginate(6);
        $breeds = Breed::all();
        $species = Species::all();
        $coats = Coat::all();
        $status = collect(Status::cases())->map(fn($case) => [
            'value' => $case->value,
            'label' => $case->label()
        ]);
        $vaccines = Vaccine::all();
        return Inertia::render('Animals', [
            'title' => 'Animaux',
            'animals' => $animals,
            'coats' => $coats,
            'breeds' => $breeds,
            'species' => $species,
            'status' => $status,
            'vaccines' => $vaccines
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'breed_id' => 'required|exists:breeds,id',
            'sexe' => 'required',
            'age' => 'required|date',
            'desc' => 'max:255',
            'status' => 'required',
            'images' => 'array',
            'images.*' => 'image|max:2048',
            'note' => 'array',
            'note.*' =>'string',
        ]);

        $coats = $request['coat_id'];
        $vaccines = $request['vaccines'];

        $images = $validated['images'];
        $new_images = [];

        if ($images) {
            foreach ($images as $image) {
                $new_original_file_name = uniqid() . '.' . config('image.image_type');
                $full_path_to_original = Storage::putFileAs(
                    config('image.original_path'),
                    $image,
                    $new_original_file_name
                );
                if ($full_path_to_original) {
                    $image = $new_original_file_name;
                    ProcessUploadedAnimalImage::dispatch($full_path_to_original, $new_original_file_name);
                } else {
                    $image = '';
                }
                $image = $full_path_to_original;
                $new_images[$image] = $image;
            }
        }
        $validated['images'] = collect($new_images);

        $validated['images']->toJson();

        $animal = Animal::create($validated);
        if ($vaccines) {
            foreach ($vaccines as $vaccine) {
                $animal->vaccines()->attach($vaccine);
            }
        }
        if ($coats) {
            foreach ($coats as $coat) {
                $animal->coat()->attach($coat);
            }
        }
        $note = $request['note'];
        if ($note) {
            $animal->notes()->create([
                'title' => $note['title'],
                'content' => $note['content'],
            ]);
        }

        return back();

    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'breed_id' => 'required|exists:breeds,id',
            'sexe' => 'required',
            'age' => 'required',
            'desc' => 'max:255',
            'status' => 'required',
        ]);

        $animal = Animal::findOrFail($id);

        if ($request->hasFile('images')) {
            $request->validate([
                'images' => 'array',
                'images.*' => 'image|max:2048',
            ]);
            $images = $request->file('images');
            $images = is_array($images) ? $images : [$images];
            $new_images = [];
            foreach ($images as $image) {
                $new_original_file_name = uniqid() . '.' . config('image.image_type');
                $full_path_to_original = Storage::putFileAs(
                    config('image.original_path'),
                    $image,
                    $new_original_file_name
                );
                if ($full_path_to_original) {
                    ProcessUploadedAnimalImage::dispatch($full_path_to_original, $new_original_file_name);
                    $new_images[$full_path_to_original] = $full_path_to_original;
                }
            }
            $validated['images'] = json_encode($new_images);
        } else {
            $validated['images'] = $animal->images;
        }
        $animal->update($validated);

        $coats = $request['coat_id'];
        $vaccines = $request['vaccines'];

        if ($vaccines) {
            foreach ($vaccines as $vaccine) {
                $animal->vaccines()->sync($vaccine);
            }
        }
        if ($coats) {
            foreach ($coats as $coat) {
                $animal->coat()->sync($coat);
            }
        }


        return back();

    }

    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);

        $animal->delete();
    }

    public function updateStatus(Animal $animal, Request $request)
    {
        $status = $request['status'];
        $animal->update(array('status' => $status));
        $animal->save();
        return back();
    }
}
