@extends('layouts.front')
@section('page_title', 'Teams')
    @push('styles')
    @endpush
@section('meta')
    @include('website.shared.meta')
@endsection
@section('content')

        <!-- Banner -->
        <section class="banner" style="background-image: url(img/banner.jpg);">
            <div class="container">
                <div class="banner-wrap">
                    <h1>Team Page</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Team Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- Banner End -->

        <!-- Team Page -->
        <section class="team-page pt pb">
            <div class="container">
                <div class="row">


                    @foreach($teams as $team)


                    <div class="col-md-4 col-sm-6">
                        <div class="team-wrap">
                            <div class="team-img">
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modals{{$team->id}}"><img src="{{ $team->image}}" alt="images"></a>
                            </div>
                            <div class="team-content">
                                <h3><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modals{{$team->id}}">{{ $team->title}}</a></h3>
                                <span>{{ $team->job_title}}</span>
                                <ul>
                                    <li class="facebook"><a href="{{ $team->facebook }}" target="_blank" ><i class="lab la-facebook-f"></i></a></li>
                                    <li class="whatsapp"><a href="{{ $team->whatsapp }}" target="_blank" ><i class="lab la-whatsapp"></i></a></li>
                                    <li class="twitter"><a href="{{ $team->twitter }}" target="_blank" ><i class="lab la-twitter"></i></a></li>
                                    <li class="youtube"><a href="{{ $team->youtube }}" target="_blank" ><i class="lab la-youtube"></i></a></li>
                                    <li class="linkedin"><a href="{{ $team->linkedin }}" target="_blank" ><i class="lab la-linkedin"></i></a></li>
                                </ul>
                            </div>

                            <div class="modal fade" id="modals{{$team->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLabel">{{ $team->title}}</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="team-details-wrap">
                                                <img src="{{ $team->image}}" alt="images">
                                                <ul class="team-det mt-4">
                                                    <li>
                                                        <b>Name:</b>
                                                        <span>{{ $team->title}}</span>
                                                    </li>
                                                    <li>
                                                        <b>Designation:</b>
                                                        <span>{{ $team->job_title}}</span>
                                                    </li>
                                                    <li>
                                                        <b>Phone:</b>
                                                        <span>{{ $team->phone_number}}</span>
                                                    </li>
                                                    <li>
                                                        <b>Email:</b>
                                                        <span>{{ $team->email}}</span>
                                                    </li>
                                                    <li>
                                                        <b>Address:</b>
                                                        <span>{{ $team->address}}</span>
                                                    </li>
                                                </ul>
                                                <p>
                                                    {!! html_entity_decode($team->description) !!}
                                                </p>
                                                <div class="team-content">
                                                    <ul>
                                                        <li class="facebook"><a href="{{ $team->facebook }}" target="_blank" ><i class="lab la-facebook-f"></i></a></li>
                                                        <li class="whatsapp"><a href="{{ $team->whatsapp }}" target="_blank" ><i class="lab la-whatsapp"></i></a></li>
                                                        <li class="twitter"><a href="{{ $team->twitter }}" target="_blank" ><i class="lab la-twitter"></i></a></li>
                                                        <li class="youtube"><a href="{{ $team->youtube }}" target="_blank" ><i class="lab la-youtube"></i></a></li>
                                                        <li class="linkedin"><a href="{{ $team->linkedin }}" target="_blank" ><i class="lab la-linkedin"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    @endforeach



                    {{-- <div class="col-md-4 col-sm-6">
                        <div class="team-wrap">
                            <div class="team-img">
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modals"><img src="img/team1.jpg" alt="images"></a>
                            </div>
                            <div class="team-content">
                                <h3><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modals">Nectar Digit</a></h3>
                                <span>Web Designer</span>
                                <ul>
                                    <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                    <li class="whatsapp"><a href="#"><i class="lab la-whatsapp"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="lab la-twitter"></i></a></li>
                                    <li class="youtube"><a href="#"><i class="lab la-youtube"></i></a></li>
                                    <li class="linkedin"><a href="#"><i class="lab la-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <div class="modal fade modals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLabel">Nectar Digit</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="team-details-wrap">
                                                <img src="img/team1.jpg" alt="images">
                                                <ul class="team-det">
                                                    <li>
                                                        <b>Name:</b>
                                                        <span>Nectar Digit</span>
                                                    </li>
                                                    <li>
                                                        <b>Designation:</b>
                                                        <span>Web Designer</span>
                                                    </li>
                                                    <li>
                                                        <b>Phone:</b>
                                                        <span>+977 123 456 789</span>
                                                    </li>
                                                    <li>
                                                        <b>Email:</b>
                                                        <span>support@gmail.com</span>
                                                    </li>
                                                    <li>
                                                        <b>Address:</b>
                                                        <span>Kathmandu, Nepal</span>
                                                    </li>
                                                </ul>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                </p>
                                                <div class="team-content">
                                                    <ul>
                                                        <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                                        <li class="whatsapp"><a href="#"><i class="lab la-whatsapp"></i></a></li>
                                                        <li class="twitter"><a href="#"><i class="lab la-twitter"></i></a></li>
                                                        <li class="youtube"><a href="#"><i class="lab la-youtube"></i></a></li>
                                                        <li class="linkedin"><a href="#"><i class="lab la-linkedin"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="team-wrap">
                            <div class="team-img">
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modals"><img src="img/team1.jpg" alt="images"></a>
                            </div>
                            <div class="team-content">
                                <h3><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modals">Nectar Digit</a></h3>
                                <span>Web Designer</span>
                                <ul>
                                    <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                    <li class="whatsapp"><a href="#"><i class="lab la-whatsapp"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="lab la-twitter"></i></a></li>
                                    <li class="youtube"><a href="#"><i class="lab la-youtube"></i></a></li>
                                    <li class="linkedin"><a href="#"><i class="lab la-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <div class="modal fade modals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLabel">Nectar Digit</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="team-details-wrap">
                                                <img src="img/team1.jpg" alt="images">
                                                <ul class="team-det">
                                                    <li>
                                                        <b>Name:</b>
                                                        <span>Nectar Digit</span>
                                                    </li>
                                                    <li>
                                                        <b>Designation:</b>
                                                        <span>Web Designer</span>
                                                    </li>
                                                    <li>
                                                        <b>Phone:</b>
                                                        <span>+977 123 456 789</span>
                                                    </li>
                                                    <li>
                                                        <b>Email:</b>
                                                        <span>support@gmail.com</span>
                                                    </li>
                                                    <li>
                                                        <b>Address:</b>
                                                        <span>Kathmandu, Nepal</span>
                                                    </li>
                                                </ul>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                </p>
                                                <div class="team-content">
                                                    <ul>
                                                        <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                                        <li class="whatsapp"><a href="#"><i class="lab la-whatsapp"></i></a></li>
                                                        <li class="twitter"><a href="#"><i class="lab la-twitter"></i></a></li>
                                                        <li class="youtube"><a href="#"><i class="lab la-youtube"></i></a></li>
                                                        <li class="linkedin"><a href="#"><i class="lab la-linkedin"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="team-wrap">
                            <div class="team-img">
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modals"><img src="img/team1.jpg" alt="images"></a>
                            </div>
                            <div class="team-content">
                                <h3><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modals">Nectar Digit</a></h3>
                                <span>Web Designer</span>
                                <ul>
                                    <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                    <li class="whatsapp"><a href="#"><i class="lab la-whatsapp"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="lab la-twitter"></i></a></li>
                                    <li class="youtube"><a href="#"><i class="lab la-youtube"></i></a></li>
                                    <li class="linkedin"><a href="#"><i class="lab la-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <div class="modal fade modals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLabel">Nectar Digit</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="team-details-wrap">
                                                <img src="img/team1.jpg" alt="images">
                                                <ul class="team-det">
                                                    <li>
                                                        <b>Name:</b>
                                                        <span>Nectar Digit</span>
                                                    </li>
                                                    <li>
                                                        <b>Designation:</b>
                                                        <span>Web Designer</span>
                                                    </li>
                                                    <li>
                                                        <b>Phone:</b>
                                                        <span>+977 123 456 789</span>
                                                    </li>
                                                    <li>
                                                        <b>Email:</b>
                                                        <span>support@gmail.com</span>
                                                    </li>
                                                    <li>
                                                        <b>Address:</b>
                                                        <span>Kathmandu, Nepal</span>
                                                    </li>
                                                </ul>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                </p>
                                                <div class="team-content">
                                                    <ul>
                                                        <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                                        <li class="whatsapp"><a href="#"><i class="lab la-whatsapp"></i></a></li>
                                                        <li class="twitter"><a href="#"><i class="lab la-twitter"></i></a></li>
                                                        <li class="youtube"><a href="#"><i class="lab la-youtube"></i></a></li>
                                                        <li class="linkedin"><a href="#"><i class="lab la-linkedin"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="team-wrap">
                            <div class="team-img">
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modals"><img src="img/team1.jpg" alt="images"></a>
                            </div>
                            <div class="team-content">
                                <h3><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modals">Nectar Digit</a></h3>
                                <span>Web Designer</span>
                                <ul>
                                    <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                    <li class="whatsapp"><a href="#"><i class="lab la-whatsapp"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="lab la-twitter"></i></a></li>
                                    <li class="youtube"><a href="#"><i class="lab la-youtube"></i></a></li>
                                    <li class="linkedin"><a href="#"><i class="lab la-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <div class="modal fade modals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLabel">Nectar Digit</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="team-details-wrap">
                                                <img src="img/team1.jpg" alt="images">
                                                <ul class="team-det">
                                                    <li>
                                                        <b>Name:</b>
                                                        <span>Nectar Digit</span>
                                                    </li>
                                                    <li>
                                                        <b>Designation:</b>
                                                        <span>Web Designer</span>
                                                    </li>
                                                    <li>
                                                        <b>Phone:</b>
                                                        <span>+977 123 456 789</span>
                                                    </li>
                                                    <li>
                                                        <b>Email:</b>
                                                        <span>support@gmail.com</span>
                                                    </li>
                                                    <li>
                                                        <b>Address:</b>
                                                        <span>Kathmandu, Nepal</span>
                                                    </li>
                                                </ul>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                </p>
                                                <div class="team-content">
                                                    <ul>
                                                        <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                                        <li class="whatsapp"><a href="#"><i class="lab la-whatsapp"></i></a></li>
                                                        <li class="twitter"><a href="#"><i class="lab la-twitter"></i></a></li>
                                                        <li class="youtube"><a href="#"><i class="lab la-youtube"></i></a></li>
                                                        <li class="linkedin"><a href="#"><i class="lab la-linkedin"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="team-wrap">
                            <div class="team-img">
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modals"><img src="img/team1.jpg" alt="images"></a>
                            </div>
                            <div class="team-content">
                                <h3><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modals">Nectar Digit</a></h3>
                                <span>Web Designer</span>
                                <ul>
                                    <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                    <li class="whatsapp"><a href="#"><i class="lab la-whatsapp"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="lab la-twitter"></i></a></li>
                                    <li class="youtube"><a href="#"><i class="lab la-youtube"></i></a></li>
                                    <li class="linkedin"><a href="#"><i class="lab la-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <div class="modal fade modals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLabel">Nectar Digit</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="team-details-wrap">
                                                <img src="img/team1.jpg" alt="images">
                                                <ul class="team-det">
                                                    <li>
                                                        <b>Name:</b>
                                                        <span>Nectar Digit</span>
                                                    </li>
                                                    <li>
                                                        <b>Designation:</b>
                                                        <span>Web Designer</span>
                                                    </li>
                                                    <li>
                                                        <b>Phone:</b>
                                                        <span>+977 123 456 789</span>
                                                    </li>
                                                    <li>
                                                        <b>Email:</b>
                                                        <span>support@gmail.com</span>
                                                    </li>
                                                    <li>
                                                        <b>Address:</b>
                                                        <span>Kathmandu, Nepal</span>
                                                    </li>
                                                </ul>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                </p>
                                                <div class="team-content">
                                                    <ul>
                                                        <li class="facebook"><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                                        <li class="whatsapp"><a href="#"><i class="lab la-whatsapp"></i></a></li>
                                                        <li class="twitter"><a href="#"><i class="lab la-twitter"></i></a></li>
                                                        <li class="youtube"><a href="#"><i class="lab la-youtube"></i></a></li>
                                                        <li class="linkedin"><a href="#"><i class="lab la-linkedin"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </section>
        <!-- Team Page End -->

@endsection
@push('scripts')
    {{-- scripts here --}}
@endpush
