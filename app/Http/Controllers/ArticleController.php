<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index($slug = null)
    {
        $query = Article::query()->with('user', 'category');

        if ($slug) {
            $category = Category::where('slug', $slug)->firstOrFail();
            $query->where('category_id', $category->id)
                ->where('status', 'published');
        }

        $totalItems = $query->count();

        $perPage = request()->input('per_page', 10);
        $articles = $query->where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage);

        return view('articles.index', compact('articles', 'totalItems'));
    }

    public function create()
    {
        $categories = Category::orderBy('id')->get();
        return view('articles.create', ['categories' => $categories]);
    }

    public function store(CreateArticleRequest $request)
    {
        $article = $this->articleService->createArticle($request);

        return redirect()->route('articles.show', $article)->with('success', 'Статья успешно создана!');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::orderBy('id')->get();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article = $this->articleService->updateArticle($request, $article);

        return redirect()->route('articles.show', $article)->with('success', 'Статья успешно обновлена!');
    }

    public function archive(Article $article)
    {
        $article = $this->articleService->changeStatus($article, 'archived');

        return redirect()->route('articles.show', $article)->with('success', 'Статья успешно архивирована!');
    }

    public function publish(Article $article)
    {
        $article = $this->articleService->changeStatus($article, 'published');

        return redirect()->route('articles.show', $article)->with('success', 'Статья успешно опубликована!');
    }

    public function destroy(Article $article)
    {
        $this->articleService->deleteArticle($article);

        return redirect()->route('articles.index')->with('success', 'Статья успешно удалена!');
    }
}
