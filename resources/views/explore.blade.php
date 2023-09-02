@extends('main')

<div class="container-fluid min-vh-100 d-sm-flex flex-column m-0 p-0" id="explore">
        <div class="flex-item row" style="min-height:20vh;">
            <div class="col-4 border align-self-center bg-black" style="min-height:5px;"></div>
            <p class="col-4 fs-1 align-self-center text-center titles">
                GET IN TOUCH
            </p>
            <div class="col-4 border align-self-center bg-black" style="min-height:5px;"></div>
        </div>
        <div class="container=fluid row" style="min-height:70vh;">
            <div class="col-6 overflow-y-hidden" style="min-height:100%;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d831.0448540876305!2d110.37418514495661!3d-7.77520809808002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a594831b5c1ab%3A0x1bfb10598dd65270!2sGedung%20Herman%20Yohannes%20Sekolah%20Vokasi%20UGM!5e0!3m2!1sid!2sid!4v1683389617292!5m2!1sid!2sid"
                 style="border:0; width:100%; height:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-6 h-100">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name">
                  </div>
                <div class="mb-3">
                    <label for="emailAddress" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="emailAddress" placeholder="Email">
                  </div>
                  <div class="mb-3">
                    <label for="messages" class="form-label">Messages</label>
                    <textarea class="form-control" id="messages" rows="3" placeholder="Write your messages here..."></textarea>
                  </div>
                <button type="button" class="btn btn-primary btn-lg">SEND</button>
            </div>
        </div>
        <footer class="container-fluid m-0 p-0 row" style="min-height: 10vh; background-color:#1768AC;">
            <div class="col-6">
                <div class="navbar">
                    <a class="navbar-brand" href="#">
                    <img src="src/hellomalove-removebg-preview (2).png" alt="Logo" class="d-inline-block text-center rounded-circle img-fluid" style="max-height:80px;">
                    <span class="text-light fw-bold">Ocean One</span>
                  </a>  
                </div>

            </div>
            <div class="col-6 d-sm-flex">
                <ul class="navbar nav-pills flex-fill nav-fill justify-content-around align-content-center">
                    <li>
                        <a class="nav-items nav-link text-light navbar-brand fw-bold" href="#">Newsletter</a>
                    </li>
                    <li>
                        <a class="nav-items nav-link text-light navbar-brand fw-bold" href="#teleportToProjects">Privacy Policy</a>
                    </li>
                    <li>
                        <a class="nav-items nav-link text-light navbar-brand fw-bold" href="#explore">FAQs</a>
                    </li>
                </ul>
            </div>
        </footer>
    </div>