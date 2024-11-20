<x-layout>
    <x-navbar/>
    <div class = "d-flex flex-column justify-content-center align-items-center gap-4" 
    style = "padding: 1rem">
        <div class = "d-flex flex-column justify-content-center align-items-center" style = "background-color: #838383;border-radius:12px;width: 85vw;height: 40rem;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);">
            <div id="carouselExampleSlidesOnly" class="carousel carousel-fade" data-bs-ride="carousel" >
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div style = "background-color: #C6CE9D;width: 85vw;height: 40rem;border-radius:12px;color:white;margin:1rem;padding:2rem;">
                            <h1 style = "font-weight:bold;">LOGO</h1>
                            <h2>Rencananya Carousel</h2>
                            <span>Hello im under water please help me</span>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div style = "background-color: #43553D;width: 85vw;height: 40rem;border-radius:12px;color:white;margin:1rem;padding:2rem;">
                            <!-- <img src="..." class="d-block w-100" alt="..."> -->
                            <h1 style = "font-weight:bold;">LOGO</h1>
                            <h2>Rencananya Carousel</h2>
                            <span>Hello im under water please help me</span>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div style = "background-color: #F1C0AF;width: 85vw;height: 40rem;border-radius:12px;color:white;margin:1rem;padding:2rem;">
                            <!-- <img src="..." class="d-block w-100" alt="..."> -->
                            <h1 style = "font-weight:bold;">LOGO</h1>
                            <h2>Rencananya Carousel</h2>
                            <span>Hello im under water please help me</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-group dropend" >
            <a href = "/market" style = "text-decoration: none;width:85vw;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);" >
                <button type = "button" class = "btn d-flex dropdown-toggle justify-content-between align-items-center" style = "color:white;height:6vh;font-weight:500;font-size:18px;background-color: #EBCF7B;width:100%;">
                    Go to market Place
                </button>
            </a>
        </div>
        <span style = "width: 85vw;font-weight:bold;font-size: 24px;">Work Together with Us</span>
        <div class = "d-flex justify-content-between " style = "width: 85vw;">
                <a href = "/restaurant" style="text-decoration: none;">
                    <div class="card d-flex justify-content-center align-items-center" 
                    style="width: 25vw;height: 30rem;color:white;background-color:#43553D;border-radius:12px;max-width: 400px;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);">
                        <img src = "{{ asset('images/home-restaurantLogo.png') }}" 
                            class="d-flex justify-content-center align-items-center" alt="...">
                        <span style = "padding: 1rem;font-size: 22px;font-weight:700;">
                            Restaurant
                        </span>
                    </div>
                </a>
                <a href = "/compost" style="text-decoration: none;">
                    <div class="card d-flex justify-content-center align-items-center" 
                    style="width: 25vw;height: 30rem;color:white;background-color:#43553D;border-radius:12px;max-width: 400px;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);">
                        <img src = "{{ asset('images/home-compostLogo.png') }}" 
                            class="d-flex justify-content-center align-items-center" alt="...">
                        <span style = "padding: 1rem;font-size: 22px;font-weight:700;text-align: center;">
                            Compost Producer
                        </span>
                    </div>
                </a>
                <a href = "/farmer" style="text-decoration: none;">
                    <div class="card d-flex justify-content-center align-items-center" 
                    style="width: 25vw;height: 30rem;color:white;background-color:#43553D;border-radius:12px;max-width: 400px;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);">
                        <img src = "{{ asset('images/home-farmLogo.png') }}" 
                            class="d-flex justify-content-center align-items-center" alt="...">
                        <span style = "padding: 1rem;font-size: 22px;font-weight:700;">
                            Farmer
                        </span>
                    </div>
                </a>
            </div>
    </div>
</x-layout>
