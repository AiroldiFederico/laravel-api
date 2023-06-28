<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Project;
use App\Models\Admin\Type;
use App\Models\Admin\Technology;

use Illuminate\Support\Str;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('type')->get();
        $types = Type::all();

        return view('guest.index', compact('projects', 'types'));
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin\Projects\create', compact('types', 'technologies'));
    }







    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'github' => 'required|string|max:255',
        'link' => 'required|string|max:255',
        // 'languages' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048', // Aggiunto il controllo per il tipo e la dimensione dell'immagine
        'type_id' => 'nullable',
        'technologies' => 'nullable|array',
        ],
        [
        'title.required' => 'Il campo titolo è obbligatorio.',
        'github.required' => 'Il campo GitHub è obbligatorio.',
        'link.required' => 'Il campo link è obbligatorio.',
        // 'languages.required' => 'Il campo lingue è obbligatorio.',
        'image.image' => 'Il campo immagine deve essere un file di immagine.',
        'image.max' => 'La dimensione massima consentita per limmagine è 2 MB',
        'technologies.array' => 'Il campo tecnologie deve essere un array.',
        ]
    );


    $form_data = $request->all();
    $form_data = $request->except('technologies');

    if ($request->hasFile('image')) {
        $image_path = $request->file('image')->store('public/images'); // Salva l'immagine nella directory 'public/images'
        $form_data['image'] = $image_path;
    }



    $slug = Project::generateSlug($request->title); // Genera lo slug corretto
    $form_data['slug'] = $slug;

    $new_project = new Project();
    $new_project->fill($form_data);
    $new_project->save();


    if ($request->has('technologies')) {
        $technologies = $request->input('technologies');
        $new_project->technologies()->attach($technologies);
    }

    return redirect()->route('projects.index');
}





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('guest.show', compact('project'));
    }






    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies' ));
    }








    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $form_data = $request->all();

        $project->title = $form_data['title'];
        $project->slug = Str::slug($form_data['title']);
        $project->github = $form_data['github'];
        $project->link = $form_data['link'];
        // $project->languages = $form_data['languages'];
        $project->type_id = $request->type_id; // Aggiungi questa riga per assegnare il nuovo tipo
        $project->save();

        if ($request->has('technologies')) {
            $technologies = $request->input('technologies');
            $project->technologies()->sync($technologies); // Utilizza il metodo sync per sincronizzare le tecnologie associate al progetto
        }
    
        return redirect()->route('admin.projects.show', $project->id);
    }







    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
    
        return redirect()->route('projects.index')->with('success', 'Il progetto è stato eliminato con successo.');
    }
    
}
