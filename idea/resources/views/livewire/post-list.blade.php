{{-- Because she competes with no one, no one can compete with her. --}}
<div id="posts" class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="text-gray-600">
            @if($this->activeCategory || $search)
            <button class="gray-500 text-xs mr-3" wire:click="clearFilters()">X</button>
            @endif
            @if($this->activeCategory)
            <x-badge wire:navigate href="{{ route('posts.index',['category' => $this->activeCategory->slug]) }}"
                :textColor="$this->activeCategory->text_color" :bgColor=" $this->activeCategory->bg_color">
                {{ $this->activeCategory->title }}
            </x-badge>
            @endif

            @if ($search)
            <span class="ml-3">
                containing : <strong>{{ $search }}</strong>
            </span>
            @endif

        </div>
        <div id="filter-selector" class="flex items-center space-x-4 font-light ">
            <x-checkbox wire:model.live="popular"/>
            <x-label>Popular</x-label>
            <button class=" {{ $sort === 'desc'? 'text-gray-900 border-b bord r-gray-700': 'text-gray-500'}} py-4"
                wire:click="setSort('desc')">Latest</button>
            <button class="  {{ $sort === 'asc'? 'text-gray-900 border-b border-gray-700': 'text-gray-500'}} py-4 "
                wire:click="setSort('asc')">Oldest</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $post)
        <x-post.post-item wire:key="{{ $post->id }}" :post="$post" />
        @endforeach
    </div>
    <div class="my-3">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
</div>
