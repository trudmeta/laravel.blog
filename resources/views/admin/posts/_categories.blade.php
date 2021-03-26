@foreach ($categories as $category)
    <option value="{{ $category->id ?? '' }}"
        @isset ($article->id)

            @foreach($article->categories as $category_article)
                @if($category->id == $category_article->id)
                selected
                @endif
            @endforeach

        @endisset
    >
        {{ $delimiter ?? '' }}{{ $category->title ?? '' }}
    </option>

    @isset ($category->children)
        @include('admin.posts._categories', [
            'categories' => $category->children,
            'delimiter' => ' - ' . $delimiter
        ])
    @endisset

@endforeach
