<?php

namespace App\Http\Requests\Post;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string'],
            'published_at' => ['required'],
            'category' => ['required'],
            'tags' => ['required'],
        ];
    }

    public function updatePost($post)
    {
        $post->title = $this->title;
        $post->excerpt = $this->excerpt;
        $post->published_at = Carbon::createFromFormat('d/m/Y',$this->published_at);
        $post->user_id = auth()->id();
        $post->category_id = $this->category;
        $post->save();
        $post->generateSlug();
        $post->tags()->sync($this->tags);
        return $post;
    }
}
