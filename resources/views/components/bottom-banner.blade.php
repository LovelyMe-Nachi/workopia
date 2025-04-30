@props([
    'heading' => 'Looking to hire?',
    'subHeading' => 'Post your job listing now and find the perfect candidate.'
])

<section class="container mx-auto my-6">
    <div class="bg-blue-800 text-white rounded p-4 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold">{{ $heading }}</h2>
            <p class="text-gray-200 text-lg mt-2">
                {{ $subHeading }}
            </p>
        </div>
        {{-- <x-button-link $url="/jobs/create" icon="edit">Create Job</x-button-link> --}}
        <x-button-link url="/jobs/create" icon="edit" type="button">
            Create Job
        </x-button-link>
    </div>
</section>