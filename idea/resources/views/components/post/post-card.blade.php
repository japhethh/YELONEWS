@props(['post'])
<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
<div {{ $attributes }}>
    <a wire:navigate  href="{{ route('posts.show',$post->slug) }}">
        <div>
            <img class="w-full rounded-xl" src="{{ $post->getThumbnailUrl() }}">
        </div>
    </a>
    <div class="mt-3 w-full">
        <div class="flex items-center mb-2 gap-x-3">
            @if ($category = $post->categories->first())
            <x-post.category-badge :category="$category"/>
            @endif

            <p class="text-gray-500 text-sm">{{ $post->published_at }}</p>
        </div>
        <a href="{{ route('posts.show',$post->slug) }}"  class="text-xl font-bold text-gray-900">{{ $post->title }}</a>
    </div>

</div>
