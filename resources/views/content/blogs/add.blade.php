<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <form action="{{ route('blog.blog-create.store') }}" method="post">
            @csrf
            <div class="grid gap-4 sm:grid-cols-1 sm:gap-1">
                <div class="sm:col-span-2">
                    <label for="title"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                    <input type="text" name="title" id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Title" required="">
                </div>
                <div class="sm:col-span-2">
                    <label for="slug"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                    <input type="text" name="slug" id="slug"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Slug" required="" readonly>
                </div>
                <div>
                    <label for="category"
                        class="block mb-3 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                    <div class="flex gap-4">
                        @foreach ($categories as $category)
                            <div class="flex items-center flex-wrap mb-4">
                                <input id="{{ $category->id }}" type="checkbox" name="categories[]"
                                    value="{{ $category->id }}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="{{ $category->id }}"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="content"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                    <textarea id="content" name="content" rows="8"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Your description here"></textarea>
                </div>
            </div>
            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Add Blog
            </button>
        </form>
    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/blog/blogs/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })
    </script>
</x-layout>
