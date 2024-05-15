<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Auth;

class AlbumController extends Controller
{
    // Método para mostrar todos los álbumes
    public function index()
    {
        $albums = Album::all();
        return view('albums.index', compact('albums'));
    }

    // Método para mostrar el formulario de creación de álbum
    public function create()
    {
        return view('albums.create');
    }

    // Método para almacenar un nuevo álbum en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $album = new Album();
        $album->title = $request->title;
        $album->description = $request->description;
        $album->image = $imageName;
        $album->user_id = Auth::id(); // Asignar el ID del usuario autenticado
        $album->save();

        return redirect()->route('albums.index')->with('success', 'Álbum creado exitosamente.');
    }

    // Método para mostrar los detalles de un álbum específico
    public function show($id)
    {
        $album = Album::findOrFail($id);
        return view('albums.show', compact('album'));
    }

    // Método para mostrar el formulario de edición de un álbum
    public function edit($id)
    {
        $album = Album::findOrFail($id);
        return view('albums.edit', compact('album'));
    }

    // Método para actualizar un álbum en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $album = Album::findOrFail($id);
        $album->title = $request->title;
        $album->description = $request->description;
        $album->save();

        return redirect()->route('albums.index')->with('success', 'Álbum actualizado exitosamente.');
    }

    // Método para eliminar un álbum de la base de datos
    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Álbum eliminado exitosamente.');
    }

    // Método para manejar la calificación de un álbum
    public function rate(Request $request, $id)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'rating' => 'required|integer|min:1|max:10', // Calificación debe ser un entero entre 1 y 10
        ]);

        // Obtener el álbum basado en el ID proporcionado
        $album = Album::findOrFail($id);

        // Actualizar la calificación del álbum
        $album->rating = $request->rating;
        $album->save();

        // Redireccionar de vuelta a la página de álbumes con un mensaje de éxito
        return redirect()->route('albums.index')->with('success', 'Álbum calificado exitosamente.');
    }
}
