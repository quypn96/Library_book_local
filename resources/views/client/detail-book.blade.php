@extends('layouts.main-client')
@section('title', $book->title)
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="single-products mt-2">
                        <img src="{{ asset('storage/' . $book->image) }}" width="250" alt="">
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li>
                                @include('commons.client.like', ['book' => $book])
                            </li>
                            <li>
                                @include('commons.client.follow', ['book' => $book])
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <h2>{{ $book->title }}</h2>
                    <p>
                        <span><b>Author: </b></span>
                        @foreach ($book->authors as $author)
                            <span>{{ $author->name . ', ' }}</span>
                        @endforeach
                    </p>
                    <p>
                        <span><b>Publisher: </b></span>
                        <span>{{ $book->publisher->name }}</span>
                    </p>

                    <h4>{!! $book->description !!}</h4>

                </div>
            </div>
            <div class="row">
                <p>{!! $book->content !!}</p>
            </div>
            <div class="row">
                <div class="row bootstrap snippets">
                    <div class="col-md-8 col-md-offset-2 col-sm-12">
                        <div class="comment-wrapper">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Comment panel
                                </div>
                                <div class="panel-body">
                                    <textarea class="form-control" name="content" placeholder="write a comment..." rows="3"></textarea>
                                    <br>
                                    <button type="button" data-id="{{ $book->id }}" class="btn btn-info pull-right comment">Comment</button>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <ul class="media-list">
                                        @foreach ($book->comments as $comment)
                                            <li class="media comments">
                                                <a href="#" class="pull-left">
                                                    <img src="{{ asset('storage/' . $comment->user->avatar) }}" alt="" class="img-circle">
                                                </a>
                                                <div class="media-body">
                                                    <p>
                                                        <span class="text-muted pull-right">
                                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                        </span>
                                                    </p>
                                                    <strong class="text-success">{{ $comment->user->name }}</strong>
                                                    <p>
                                                        {{ $comment->content }}
                                                    </p>
                                                    @if (Auth::check() && Auth::user()->id != $comment->user->id)
                                                        <a href="javascript:void(0)"  data-username="{{ $comment->user->name }}" class="text-success reply-tag" title="">
                                                            <span class="text-muted pull-right">
                                                                <small class="text-muted">reply</small>
                                                            </span>
                                                        </a>
                                                    @endif
                                                </div>
                                                <ul class="cmt">
                                                @foreach ($comment->comments as $c)
                                                    <li class="media comment-reply">
                                                        <a href="#" class="pull-left">
                                                            <img src="{{ asset('storage/' . $c->user->avatar) }}" alt="" class="img-circle">
                                                        </a>
                                                        <div class="media-body">
                                                            <p>
                                                                <span class="text-muted pull-right">
                                                                    <small class="text-muted">{{ $c->created_at->diffForHumans() }}</small>
                                                                </span>
                                                            </p>
                                                            <strong class="text-success">{{ $c->user->name }}</strong>
                                                            <p>
                                                                {{ $c->content }}
                                                            </p>
                                                            @if (Auth::check() && Auth::user()->id != $c->user->id)
                                                                <a href="javascript:void(0)" data-username="{{ $c->user->name }}" class="text-success reply-tag" title="">
                                                                    <span class="text-muted pull-right">
                                                                        <small class="text-muted">reply</small>
                                                                    </span>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </li>
                                                @endforeach
                                                </ul>
                                                <div class="reply">
                                                    <textarea class="form-control text-reply" name="content" placeholder="write a comment..." rows="2"></textarea>
                                                    <button type="button" data-id="{{ $book->id }}" data-parent="{{ $comment->id }}" class="btn btn-succses reply-submit">Reply</button>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
