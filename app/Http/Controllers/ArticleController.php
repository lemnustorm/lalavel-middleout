<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\SearchArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

/**
 * Scope: remember how to work with laravel
 */
class ArticleController extends Controller
{
    public function index(SearchArticleRequest $request) : JsonResponse
    {
        return response()->json(['message' => 'Not found'], 404);
    }

    /**
     * @param CreateArticleRequest $request
     * @return JsonResponse
     */
    public function create(CreateArticleRequest $request) : JsonResponse
    {
        try {
            $article = Article::create($request->validated());

            return response()->json(['message' => "Created", "id" => $article->id], 201);
        } catch (Exception $ex) {
            Log::error("Create article error: " . $ex->getMessage());
            return response()->json(['message' => 'Internal error'], 500);
        }
    }

    /**
     * Instead of comparing properties in the backend i used patch method for update. send only what you want to modify.
     *
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return JsonResponse
     */
    public function update(UpdateArticleRequest $request, Article $article) : JsonResponse
    {
        try {
            $article->update($request->validated());

            return response()->json(['message' => "Updated"], 200);
        } catch (Exception $ex) {
            Log::error("Update article error: " . $ex->getMessage());
            return response()->json(['message' => 'Internal error'], 500);
        }
    }

    /**
     * Strange method but those are the requirements
     *
     * @param Article $article
     * @return JsonResponse
     */
    public function unPublishOrDelete(Article $article) : JsonResponse
    {
        if (is_null($article->published_at)) {
            return $this->delete($article);
        }

        return $this->unPublish($article);
    }

    /**
     * i think this should be the endpoint for delete
     *
     * @param Article $article
     * @return JsonResponse
     */
    protected function delete(Article $article) : JsonResponse
    {
        try {
            $article->delete();

            return response()->json(['message' => "Deleted"], 200);
        } catch (Exception $ex) {
            Log::error("Delete article error: " . $ex->getMessage());
            return response()->json(['message' => 'Internal error'], 500);
        }
    }

    /**
     * I think we should make a different endpoint fdr this or use update
     *
     * @param Article $article
     * @return JsonResponse
     */
    protected function unPublish(Article $article) : JsonResponse
    {
        try {
            $article->update(['published_at' => null]);

            return response()->json(['message' => "Unpublished"], 200);
        } catch (Exception $ex) {
            Log::error("Unpublish article error: " . $ex->getMessage());
            return response()->json(['message' => 'Internal error'], 500);
        }
    }
}
