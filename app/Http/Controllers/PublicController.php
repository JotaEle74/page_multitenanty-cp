<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Publication;
use App\Models\School;
use Inertia\Inertia;
use App\Models\Section;

class PublicController extends Controller
{
    public function school($slug)
    {
        $school = School::with(['programs'])->where('slug', $slug)->firstOrFail();
        $sections = Section::where('page', 'escuela')
            ->where('school_id', $school->id)
            ->orderBy('order')
            ->get();

        return Inertia::render('Public/EscuelasPage', [
            'school' => $school,
            'schools' => School::select('id', 'name', 'slug')->orderBy('name')->get(),
            'sections' => $sections,
        ]);
    }

    public function schoolAbout($slug)
    {
        $school = School::with(['programs', 'authorities'])->where('slug', $slug)->firstOrFail();

        return Inertia::render('Public/NosotrosEscuelaPage', [
            'school' => $school,
            'authorities' => $school->authorities,
            'schools' => School::select('id', 'name', 'slug')->orderBy('name')->get(),
        ]);
    }

    public function schoolProgram($slug)
    {
        $program = Program::where('slug', $slug)->firstOrFail();
        $school = School::with('programs')->where('id', $program->school_id)->firstOrFail();
        $sections = Section::where('page', 'programas')
            ->where('school_id', $school->id)
            ->orderBy('order')
            ->get();
        return Inertia::render('Public/ProgramasPage', [
            'school' => $school,
            'sections' => $sections,
        ]);
    }

    public function schoolDocuments($slug)
    {
        $school = School::with(['programs'])->where('slug', $slug)->firstOrFail();
        $documents = $school->documents()->orderBy('date', 'desc')->get();
        return Inertia::render('Public/DocumentosPage', [
            'school' => $school,
            'documentos' => $documents,
            'schools' => School::select('id', 'name', 'slug')->orderBy('name')->get(),
        ]);
    }

    public function schoolPublications($slug)
    {
        $school = School::with(['programs'])->where('slug', $slug)->firstOrFail();
        $publications = $school->publications()->orderByDesc('published_at')->get();

        return Inertia::render('Public/PublicacionesPage', [
            'school' => $school,
            'publicaciones' => $publications,
            'schools' => School::select('id', 'name', 'slug')->orderBy('name')->get(),
        ]);
    }
}
