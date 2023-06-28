@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 mb-4 bg-light rounded-3">
    <div class="container py-5">

        <h1 class="display-2 fw-bold">
            Federico Airoldi 
        </h1>
        <h2 class="display-5 fw-bold">
            Personal Portfolio 
        </h2>

        <p class="col-md-8 fs-4">Explore my full-stack development portfolio: a professional overview of the projects I have completed</p>
        
    </div>
</div>

<div class="content">
    <div class="container">



        {{-- PROJECT --}}
        <div class="col-12 JobContainer mb-5">

            <div class="cardjob col-12">

                
                <h2 class="display-5 fw-bold">
                    My Projects
                </h2>
            	<h2 class="fw-bold">Guarda i miei progetti <a href="{{ route('projects.index') }}" class="text-decoration-none ">qui</a></h2>

                @auth
                    <h4 class="mt-2"><a href="{{ route('admin.projects.create') }}" class="text-decoration-none fw-bold">Aggiungi progetto</a></h4>
                @endauth


            </div>

        </div>





        {{-- Job Profile --}}
        <div class="col-12 JobContainer">

            <div class="cardjob col-12">

                <h2 class="display-5 fw-bold">
                    Professional Profile
                </h2>
                <h2 class="display-7 fw-bold">
                    Executive Summary
                </h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis explicabo modi quod, fugiat necessitatibus, nobis magni, nemo sit ex asperiores architecto natus quidem accusamus dolor totam assumenda minima consequatur eveniet.</p>
                <h2 class="display-7 fw-bold">
                    Work Experience
                </h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis explicabo modi quod, fugiat necessitatibus, nobis magni, nemo sit ex asperiores architecto natus quidem accusamus dolor totam assumenda minima consequatur eveniet.</p>
                <h2 class="display-7 fw-bold">
                    Education
                </h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis explicabo modi quod, fugiat necessitatibus, nobis magni, nemo sit ex asperiores architecto natus quidem accusamus dolor totam assumenda minima consequatur eveniet.</p>
                <h2 class="display-7 fw-bold">
                    Contact
                </h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis explicabo modi quod, fugiat necessitatibus, nobis magni, nemo sit ex asperiores architecto natus quidem accusamus dolor totam assumenda minima consequatur eveniet.</p>
                
            </div>

        </div>



      
    </div>
</div>
@endsection