@section('scripts')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('body' ,{
            filebrowserUploadUrl : "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserImageUploadUrl :  "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}"
        });
        $('#categories').select2({});
        $('#tags').select2({});
    </script>
@endsection

<x-app-admin-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Article
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" autocomplete="given-title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('title')
                            <div class="text-red-600 text-sm pt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="2" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" ></textarea>
                            </div>
                            @error('description')
                            <div class="text-red-600 text-sm pt-2">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="mt-3">
                            <label for="categories" class="mb-1 block text-sm font-medium text-gray-700">Categories</label>
                            <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="categories[]" id="categories" multiple>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('categories')
                            <div class="text-red-600 text-sm pt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="body" class="block text-sm font-medium text-gray-700">
                                Body
                            </label>
                            <div class="mt-1">
                                <textarea id="body" name="body" rows="8" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" ></textarea>
                            </div>
                            @error('body')
                            <div class="text-red-600 text-sm pt-2">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="mt-3">
                            <label for="tags" class="mb-1 block text-sm font-medium text-gray-700">Tags</label>
                            <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="tags[]" id="tags" multiple>
                                @foreach(\App\Models\Tag::all() as $tag)
                                    <option value="{{ $tag->id }}">#{{ $tag->slug }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                            <div class="text-red-600 text-sm pt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label class="block">
                                <span class="sr-only">Choose Image</span>
                                <input type="file" name="images" id="images" class="block focus:outline-none w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                            </label>
                            @error('images')
                            <div class="text-red-600 text-sm pt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <x-button >
                                Save
                            </x-button>
                        </div>


                    </form>



                </div>
            </div>
        </div>
    </div>
</x-app-admin-layout>
