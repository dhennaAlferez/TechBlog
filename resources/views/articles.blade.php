<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Dhenna Alferez" />
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('laravel.ico') }}" />
    <x-feed-links />
</head>
<body class="font-sans antialiased cursor-default">
<div class="min-h-screen bg-gray-100">
@include('layouts.navigation-user')

<!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="py-6">
            <nav aria-label="Breadcrumb">
                <ol role="list" class="max-w-2xl mx-auto px-4 flex items-center space-x-2 sm:px-6 lg:max-w-7xl lg:px-8">
                    <li>
                        <div class="flex items-center">
                            <x-bread-link :href="route('articles')" :active="request()->routeIs('articles')">
                                Blog
                            </x-bread-link>
                            @if(request('tagSlug') || request('categorySlug'))
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-5 text-gray-300">
                                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                            </svg>
                            @endif
                        </div>
                    </li>
                    @if(request('tagSlug'))
                    <li>
                        <div class="flex items-center">
                            <x-bread-link :href="route('tag.articles',[request('tagSlug')->slug])" :active="request()->routeIs('tag.articles')">
                                {{ request('tagSlug')->title }}
                            </x-bread-link>
                        </div>
                    </li>
                    @elseif(request('categorySlug'))
                        <li>
                            <div class="flex items-center">
                                <x-bread-link :href="route('category.articles',[request('categorySlug')->slug])" :active="request()->routeIs('category.articles')">
                                    {{ request('categorySlug')->title }}
                                </x-bread-link>
                            </div>
                        </li>
                    @endif
                </ol>
            </nav>
        </div>
    </header>

    <!-- Page Content -->
    <main>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-4 py-6">

                <h1 class="text-2xl font-extrabold tracking-tight text-indigo-800">News & Articles</h1>

                    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:gap-x-8">

                        @foreach($articles as $article)
                            <div class="bg-white shadow-sm border border-gray-80 border-opacity-60 h-full flex flex-col">
                                <a href="{{ route('article.single',[$article->slug]) }}">
                                    <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 overflow-hidden lg:h-80 lg:aspect-none">
                                        <img src="{{ $article->images['thumb'] }}" alt="{{ $article->title }}" class="w-full h-full object-center transform transition duration-200 hover:scale-105 object-cover lg:w-full lg:h-full">
                                    </div>
                                </a>
                                <div class="mt-2 p-3 flex flex-col flex-1">
                                    <a href="{{ route('article.single',[$article->slug]) }}">
                                        <h1 class="text-lg font-bold text-gray-800 hover:text-indigo-800 duration-200 transition">{{ $article->title }}</h1>
                                    </a>
                                    <div class="flex flex-col flex-grow">
                                        <p class="my-2 text-gray-600 text-sm font-normal overflow-hidden leading-6">{{ $article->description }}</p>
                                    </div>
                                    @if( $article->categories)
                                        <div class="mt-5 mb-2 cursor-default">
                                            @foreach( $article->categories as $cate)
                                                <a class="decoration-0" href="{{ route('category.articles',$cate->slug) }}"><span class="text-xs inline-block py-1 pr-2 text-center whitespace-nowrap duration-200 transition align-baseline hover:text-indigo-800">{{ $cate->title }}</span></a>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if( $article->tags)
                                        <div class="mb-2 cursor-default">
                                            @foreach( $article->tags as $tag)
                                                <a class="decoration-0" href="{{ route('tag.articles',$tag->slug) }}"><span class="text-xs inline-block py-1 px-2 text-center whitespace-nowrap duration-200 transition align-baseline bg-gray-100 hover:bg-gray-200 text-gray-900 rounded">#{{ $tag->slug }}</span></a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                </div>
                <!-- Pagination -->
                <div class="mt-5">
                    {!! $articles->render() !!}
                </div>

            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8 px-4 py-6 divide-gray-300 divide-y">
                <div class="cursor-default">
                    <h3 class="mb-4 text-lg font-extrabold tracking-tight text-indigo-800">Latest Categories</h3>
                    @foreach($categories as $category)
                        <a class="decoration-0" href="{{ route('category.articles',$category->slug) }}"><span class="text-xs inline-block pb-1 pr-2 text-center whitespace-nowrap duration-200 transition align-baseline hover:text-indigo-800">{{ $category->title }}</span></a>
                    @endforeach
                </div>
                <div class="mt-6 pt-6 cursor-default">
                    <h3 class="mb-4 text-lg font-extrabold tracking-tight text-indigo-800">Latest Tags</h3>
                    @foreach($tags as $tag)
                        <a class="decoration-0" href="{{ route('tag.articles',$tag->slug) }}"><span class="text-xs inline-block py-1 px-2 text-center whitespace-nowrap duration-200 transition align-baseline bg-gray-100 hover:bg-gray-200 text-gray-900 rounded">#{{ $tag->slug }}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </main>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('scripts')
    <footer class="p-4 bg-white shadow md:flex md:items-center md:justify-between md:p-6">
<span class="text-sm text-gray-500 sm:text-center">© 2023 Made With <a href="https://laravel.com" target="_blank" class="hover:text-red-600 duration-200 transition">Tech Blog </a><span class="text-xs">v{{ Illuminate\Foundation\Application::VERSION }}</span> . All Rights Reserved.
</span>
    <ul class="flex flex-wrap items-center mt-3 text-sm text-gray-500 sm:mt-0">
        <li>
            <a href="/sitemap" target="_blank" class="mr-4 hover:underline md:mr-6 hover:text-indigo-800 duration-200 transition">Sitemap</a>
        </li>
        <li>
            <a href="/feed" target="_blank" class="mr-4 hover:underline md:mr-6 hover:text-indigo-800 duration-200 transition">Feed</a>
        </li>
    </ul>
</footer>
    </body>
</html>
