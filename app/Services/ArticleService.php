<?php

namespace App\Services;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    public function createArticle(Request $request): Article
    {
        $image_blob = null;
        $image_mime = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $image_blob = base64_encode(file_get_contents($image->getRealPath()));
            $image_mime = $image->getClientMimeType();
        }

        $article = new Article();
        $article->user_id = Auth::id();
        $article->title = $request->input('title');
        $article->excerpt = $request->input('excerpt');
        $article->content = $request->input('body');
        $article->category_id = $request->input('category_id');
        $article->status = $request->input('status');
        $article->image_blob = $image_blob;
        $article->image_mime = $image_mime;
        $article->save();

        return $article;
    }

    public function updateArticle(Request $request, Article $article): Article
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $image_blob = base64_encode(file_get_contents($image->getRealPath()));
            $image_mime = $image->getClientMimeType();
            $article->image_blob = $image_blob;
            $article->image_mime = $image_mime;
        }

        $article->title = $request->input('title');
        $article->excerpt = $request->input('excerpt');
        $article->content = $request->input('body');
        $article->category_id = $request->input('category_id');
        $article->status = $request->input('status');
        $article->save();

        return $article;
    }

    public function changeStatus(Article $article, string $status): Article
    {
        $article->status = $status;
        $article->save();

        return $article;
    }

    public function deleteArticle(Article $article): void
    {
        $article->delete();
    }

    public function getArticles($perPage)
    {
        $query = Article::query();
        $totalItems = $query->count();
        $articles = $query
            ->with('user', 'category')
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage);

        return compact('articles', 'totalItems');
    }

    public function getUserArticles(User $user, string $status = null, int $perPage = 10)
    {
        $query = Article::query()->where('user_id', $user->id);

        if ($status) {
            $query->where('status', $status);
        }

        return $query->orderBy('updated_at', 'desc')->paginate($perPage);
    }

    public function countUserArticles(User $user, string $status = null): int
    {
        $query = Article::query()->where('user_id', $user->id);

        if ($status) {
            $query->where('status', $status);
        }

        return $query->count();
    }
}
