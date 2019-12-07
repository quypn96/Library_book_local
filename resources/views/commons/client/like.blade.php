@if (Auth::check())
    @if (Helper::checkUserIsLikeBook($book))
        <a href="javascript:void(0)" class="like" data-id="{{ $book->id }}" data-type="0">
            {{ trans('client/home-page.unlike') }}
        </a>
    @else
        <a href="javascript:void(0)" class="like" data-id="{{ $book->id }}" data-type="1">
            {{ trans('client/home-page.like') }}
        </a>
    @endif
@endif
