<x-layout>
    <x-navbar/>
    <div class = "d-flex flex-column justify-content-center align-items-center gap-4" 
    style = "padding: 1rem">
        <div class = "d-flex flex-column justify-content-center align-items-center">
            <div style = "background-color: #C6CE9D;width: 85vw;height: 40rem;border-radius:12px;color:white;margin:1rem;padding:2rem;">
                <h1 style = "font-weight:bold;">LOGO</h1>
                <span>Hello im under water please help me</span>
            </div>
        </div>
        <span style = "width: 85vw;font-weight:bold;font-size: 24px;">Work Together with Us</span>
        <div class = "d-flex justify-content-between" style = "width: 85vw;">
                <a href = "/restaurant" style="text-decoration: none;">
                    <div class="card d-flex justify-content-center align-items-center" 
                    style="width: 23rem;height: 30rem;color:white;background-color:#43553D;border-radius:12px;">
                        <img src = "{{ asset('images/home-restaurantLogo.png') }}" 
                            class="d-flex justify-content-center align-items-center" alt="...">
                        <span style = "padding: 1rem;font-size: 22px;font-weight:700;">Restaurant</span>
                    </div>
                </a>
                <a href = "/restaurant" style="text-decoration: none;">
                    <div class="card d-flex justify-content-center align-items-center" 
                    style="width: 23rem;height: 30rem;color:white;background-color:#43553D;border-radius:12px;">
                        <img src = "{{ asset('images/home-compostLogo.png') }}" 
                            class="d-flex justify-content-center align-items-center" alt="...">
                        <span style = "padding: 1rem;font-size: 22px;font-weight:700;">
                            Compost Producer
                        </span>
                    </div>
                </a>
                <a href = "/restaurant" style="text-decoration: none;">
                    <div class="card d-flex justify-content-center align-items-center" 
                    style="width: 23rem;height: 30rem;color:white;background-color:#43553D;border-radius:12px;">
                        <img src = "{{ asset('images/home-farmLogo.png') }}" 
                            class="d-flex justify-content-center align-items-center" alt="...">
                        <span style = "padding: 1rem;font-size: 22px;font-weight:700;">
                            Restaurant
                        </span>
                    </div>
                </a>
            </div>
    </div>
</x-layout>
