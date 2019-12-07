{{-- @if (Auth::check())
    @if (Helper::checkUserIsLikeBook($book))
        <a href="javascript:void(0)" class="follow" data-id="{{ $book->id }}" data-type="0">
            {{ trans('client/home-page.unfollow') }}
        </a>
    @else
        <a href="javascript:void(0)" class="follow" data-id="{{ $book->id }}" data-type="1">
            {{ trans('client/home-page.follow') }}
        </a>
    @endif
@endif
 --}}
