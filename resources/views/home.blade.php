@extends('layouts.app')

@section('content')
<div class="container">

    <header>
        <div class="container" id="maincontent" tabindex="-1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-text">
                        <h1 class="name">Daigou Australia Group</h1>
                        <hr class="star-light">
                        <span class="skills">Lorem ipsum - nullam aliquam - Lorem ipsum</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="Categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Categories</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">


                @foreach ($categories as $category)

                <div class="col-sm-4 col-md-3 portfolio-item">
                    <a href="{{ URL('/products/category/'.$category->id )}}" class="portfolio-link" >

                        <img src="{{'img/portfolio/category'.$category->id.'.png'}}" class="img-responsive" alt="Slice of cake">
                    </a>
                    <div class="cat-name" >
                        {{$category->name}}

                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </section>
</div>
@endsection
