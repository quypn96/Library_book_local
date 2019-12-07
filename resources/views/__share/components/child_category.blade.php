<ul class="">
    <li class="list-group-item">
        <a href="javascript:void(0)" data-cate="{{ $child_category->id }}" title="">
            {{ $child_category->name }}
        </a>
    </li>
    @if ($child_category->categories)
            @foreach ($child_category->categories as $childCategory)
                @include('__share.components.child_category', ['child_category' => $childCategory])
            @endforeach
    @endif
</ul>
