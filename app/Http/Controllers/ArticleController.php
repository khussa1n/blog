<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug = null)
    {
        $query = Article::query()->with('user', 'category');

        if ($slug)
        {
            $category = Category::where('slug', $slug)->firstOrFail();
            $query->where('category_id', $category->id)
                ->where('status', 'published');
        }

        $totalItems = $query->count();

        $perPage = request()->input('per_page', 10);
        $articles = $query
            ->where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage);

        return view('articles.index', compact('articles','totalItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id')->get();
        return view('articles.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|string|in:draft,published'
        ]);

        $image_blob = null;
        $image_mime = null;

        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            $image = $request->file('image');
            $image_blob = base64_encode(file_get_contents($image->getRealPath()));
            $image_mime = $image->getClientMimeType();
        }

        $article = new Article();
        $article->user_id = auth()->id();
        $article->title = $request->input('title');
        $article->excerpt = $request->input('excerpt');
        $article->content = $request->input('body');
        $article->category_id = $request->input('category_id');
        $article->status = $request->input('status');
        $article->image_blob = $image_blob;
        $article->image_mime = $image_mime;
        $article->save();

        return redirect()->route('articles.show', $article)->with('success', 'Статья успешно создана!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::orderBy('id')->get();
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            $image = $request->file('image');
            $image_blob = base64_encode(file_get_contents($image->getRealPath()));
            $image_mime = $image->getClientMimeType();
            $article->image_blob = $image_blob;
            $article->image_mime = $image_mime;
        }

        $article->title = $request->title;
        $article->excerpt = $request->excerpt;
        $article->content = $request->body;
        $article->category_id = $request->category_id;
        $article->status = $request->input('status');
        $article->save();

        return redirect()->route('articles.show', $article)
            ->with('success', 'Статья успешно обновлена!');
    }

    public function archive(Article $article)
    {
        $article->status = 'archived';
        $article->save();

        return redirect()->route('articles.show', $article)
            ->with('success', 'Статья успешно архивирована!');
    }

    public function publish(Article $article)
    {
        $article->status = 'published';
        $article->save();

        return redirect()->route('articles.show', $article)
            ->with('success', 'Статья успешно опубликована!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')
            ->with('success', 'Статья успешно удалена!');
    }
}
