<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white rounded-[32px] shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-900">Select Categories</h2>
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="space-y-4">
                    @foreach($categories as $category)
                        <div>
                            <input type="checkbox" id="category_{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                            <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    @endforeach
                    <div>
                        <button type="submit" class="w-full px-4 py-2 font-semibold text-white rounded-[32px]" style="background-color: #FE793D;">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
