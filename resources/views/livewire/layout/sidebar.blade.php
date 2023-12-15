<div id="primary-navigation-sidebar">
    <nav class="p-6 mt-0 w-full"> 
        <div class="container mx-auto flex flex-col items-start">
            <div class="text-white font-extrabold mb-4">
                <a class="text-white no-underline hover:text-white hover:no-underline" href="#">
                    <span class="text-2xl pl-0">voxtorrent</span>
                </a>
            </div>
            <div class="mb-4 p-0">
                <a href="/create" class="inline-flex items-center justify-center py-4 px-6 border border-transparent text-base font-bold rounded-md text-white bg-orange-600 hover:bg-red-600">
                    <i class="fa-regular fa-pen-to-square mr-2"></i> create
                </a>
            </div>
            <ul class="list-reset flex flex-col justify-between flex-1 items-start dark:text-white">
                <li class="mb-3 flex items-center">
                    <i class="fas fa-home mr-2"></i>
                    <a class="inline-block py-2 px-4 text-white no-underline" href="{{ route('latest') }}">latest</a>
                </li>
                <li class="mb-3 flex items-center">
                    <i class="fas fa-fire mr-2"></i>
                    <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4" href="#">uprising</a>
                </li>
                <li class="mb-3 flex items-center">
                    <i class="fas fa-bookmark mr-2"></i>
                    <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4" href="#">bookmarks</a>
                </li>
                <li class="mb-3 flex items-center">
                    <i class="fas fa-hashtag mr-2"></i>
                    <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4" href="#">hashtags</a>
                </li>
            </ul>
        </div>
    </nav> 
</div>