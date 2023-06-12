@extends('layouts.master')

@section('content')
    <main id="main">
        <x-hero 
            title="Our Largest Free Photo Communities" 
            description="Sharing your photos is a form of caring for our community." 
            image="img/hero-bg-1.jpg" />
        
        <!-- Show List Photo Section -->
        <x-photoList 
            :tags="$tags" 
            :photos="$photos" />

        <!-- Show Modal -->
        <x-modal.signin 
            title="Sign In" />
        <x-modal.signup 
            title="Sign Up" />
    </main>

@endsection