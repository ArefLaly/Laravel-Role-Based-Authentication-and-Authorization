@extends('layouts.app')
@section('content')

    <section class="section about-section gray-bg pt-5" id="about">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-lg-6">
                    <div class="about-text go-to">
                        <h6 class="dark-color">About Me</h6>

                        <h3 class="dark-color">Mohammad Arif Laly</h3>
                        <h6 class="theme-color lead">FullStack Developer(.NET & Laravel & React.js)</h6>
                        <p>I am <mark>Mohammad Arif Laly</mark> and I'm a young fullStack developer with almost 1+ years of
                            experience in the field. Right now, I am working as a senior full sack developer.
                            <br>
                            If you are looking for excellent work at a very reasonable price, then please contact me.
                            I believe that high quality and customer satisfaction are the most important factors for
                            success.
                            So, feel free to contact me for discussing your needs and objectives.


                        </p>
                        <div class="row about-list">
                            <div class="col-md-6">
                                <div class="media">
                                    <label> <i class="fa fa-calendar"></i> Birthday</label>
                                    <p>26th june 1999</p>
                                </div>
                                <div class="media">
                                    <label> <i class="fa fa-location-arrow"></i> Residence</label>
                                    <p>Kabul,Afghanistan</p>
                                </div>
                                <div class="media">
                                    <label> <i class="fa fa-map"></i> Address</label>
                                    <p>Kabul, Afghanistan</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="media">
                                    <label> <i class="fa fa-mail-bulk"></i> E-mail</label>
                                    <p>aref.laly1397@gmail.com</p>
                                </div>
                                <div class="media">
                                    <label> <i class="fa fa-phone"></i> Phone & whatsapp</label>
                                    <p>0093-784-970-037</p>
                                </div>
                                <div class="media">
                                    <label><i class="fa fa-network-wired"></i> Freelance</label>
                                    <p>Available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-avatar p-2  d-grid" style="overflow: hidden; max-height: 400px;">

                        <img src="{{ asset('includes/img/me.jpg') }}" class="m-auto rounded" style="height:400px;" title=""
                            alt="">
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="col-lg-6 mx-auto">
                <div class="d-grid gap-2">
                    <a type="button" href="{{ route('login') }}"
                        class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Login || start app</a>
                </div>
            </div>

        </div>

    </section>

@stop
