@props(['title' => 'Find Your Dream Job'])

<section class="hero relative bg-cover bg-center bg-no-repeat h-72 flex items-center">
    <div class="overlay"></div>
    <div class="container mx-auto text-center z-10">
        <h2 class="text-5xl text-white font-bold mb-8">{{ $title }}</h2>
        <x-search /> 
    </div>
</section>