@extends('main')

<body>
    <div class="container-fluid min-vh-100 d-sm-flex flex-column p-0 m-0">
        <div class="container-fluid position-absolute min-vh-100 text-sm-center d-sm-flex flex-column justify-content-sm-center gap-3 z-1 text-light fw-semibold
                    titles">
            <div class="fs-1">
                Ocean One
            </div>
            <div class="fs-3 ">
                Join the Ocean One: <br>
                Protect and Preserve Our Ocean's Future
            </div>
            <div class="p-3">
                <button type="button" class="btn btn-primary btn-lg">
                    Join Us
                </button>
            </div>
        </div>
        <div class="container-fluid position-absolute object-fit-fill zn-1 p-0"id="bg-1" style="max-height: 100%; overflow:hidden;">
            <video class="object-fit-scale" autoplay loop muted id="vod"> 
                <source src="video/fishes.mp4" type="video/mp4">
            </video>
        </div>
    </div>
</body>