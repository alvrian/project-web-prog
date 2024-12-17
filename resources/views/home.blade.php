<x-layout>
  <x-navbar />
  <div class="d-flex flex-column justify-content-center align-items-center gap-4"
    style="padding: 1rem;font-family:&quot;Inter&quot;, serif;"">
        <div class = " d-flex flex-column justify-content-center align-items-center"
    style="background-color: #838383;border-radius:12px;width: 85vw;height: 38rem;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);">
    <div class="carousel carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div
            style="background-color: #43553D;width: 85vw;height: 38rem;border-radius:12px;color:white;margin:1rem;padding:2rem;position: relative">
            <div style="position: absolute; bottom: 40%;left: 5%">
              <h1 style="font-family: &quot;Lexend&quot;,sans-serif;font-weight:600;font-size: 54px;">FarmByte: </h1>
              <h1 style="font-family: &quot;Lexend&quot;,sans-serif;font-weight:600;font-size: 54px;">Cultivating
                Connections,</h1>
              <h1 style="font-family: &quot;Lexend&quot;,sans-serif;font-weight:600;font-size: 54px;">Growing
                Sustainability.</h1>
            </div>
            <img src="{{ asset('images/farmbyte-title.png') }}" alt="FARMByte"
              style="position: absolute;right: 5%; bottom: 5%;" />
          </div>
        </div>
        <div class="carousel-item" style="font-family: &quot;Lexend&quot;,sans-serif;">
          <div style="background-color: #E9F0E4;width: 85vw;height: 38rem;border-radius:12px;margin:1rem;padding:2rem;">
            <img src="{{ asset('images/corn-gray.png') }}" alt="loading . . ."
              style="position: absolute;width: 25px;right: 3.5%;top: 15%;">
            <h1 style="font-size: 60px;font-weight:600;border-bottom: 4px solid black;display: block;">Explore Now</h1>
            <span style="font-size: 22px">
              From the fields to your table, our locally sourced products guarantee quality,
              freshness, and flavor you can trust. Discover the taste of freshness! At FarmByte, we bring you products
              sourced directly from local farms, ensuring every bite supports your community.
            </span>
            <img src={{ asset('images/farmByte-gray.png') }} style="position: absolute;bottom: 5%;left: 3.5%;">
            @if(auth()->user())
            <a href="#">
              <button id="home-button-explore"
                style="background-color: #D9D9D9;font-size: 18px;font-weight: 400;position: absolute;right: 3.5%;bottom: 5%;padding:6px 2rem;border-radius: 8px;border: none;">
                Explore
              </button>
            </a>
            @else
            <a href="/register">
              <button id="home-button-explore"
                style="background-color: #D9D9D9;font-size: 18px;font-weight: 400;position: absolute;right: 3.5%;bottom: 5%;padding:6px 2rem;border-radius: 8px;border: none;">
                Register Now
              </button>
            </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <span style="width: 85vw;font-weight:bold;font-size: 24px;">What is FarmByte ?</span>
  <div class="card d-flex"
    style="width:85vw;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);background-color:#F0EEEF;border: none;height: 100%;">
    <div class="d-flex flex-row"">
      <div class=" card-body" style="flex: 1;color: #3C4B33;">
      Welcome to FarmByte, where we bridge the gap between farmers, compost producers, and restaurants to create a
      sustainable and mutually beneficial ecosystem. Our platform fosters collaboration, enabling farmers to supply
      fresh produce, compost producers to contribute eco-friendly solutions, and restaurants to source high-quality
      ingredients directly.
    </div>
    <div class="card-body d-flex flex-column justify-content-center dropend" style="flex:1;">
      <h4 style="font-size: 28px;font-weight:bold;color: #3C4B33;margin-bottom:1rem;">About Us</h4>
      <a href="/aboutUs"
        style="text-decoration: none;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);border-radius: 12px;">
        <button type="button" class="btn d-flex dropdown-toggle justify-content-between align-items-center"
          style="color:white;height:10vh;font-weight:500;font-size:18px;background-color: #C7D6E3;width:100%;border-radius: 12px;">
          Read More
        </button>
      </a>
    </div>
  </div>
  @if(auth()->user() === null)
  <span style="font-size: 22px;font-weight: 600;margin: 0 1rem;">What are You Waiting For?</span>
  <a href = "/register" style = "text-decoration: none;">
    <div class="dropend" style = "margin: 1rem;">
      <button type="button" class="btn d-flex dropdown-toggle justify-content-between align-items-center"
        style="color:white;height:10vh;font-weight:500;font-size:18px;background-color:rgb(237, 206, 114);width:100%;border-radius: 12px;">
        Register Now
      </button>
    </div>
  </a>
  @endif
  </div>
  @if(auth()->user())
    <span style="width: 85vw;font-weight:bold;font-size: 24px;">Work Together with Us</span>
    <div class="row" style="width: 85vw;height: 30rem;">
      @if(auth()->user()->role == "restaurant_owner")
      <a href="{{ route('restaurant.index') }}" style="text-decoration: none;">
        <div class="card d-flex justify-content-center align-items-center"
        style="width: 25vw;height: 30rem;color:white;background-color:#43553D;border-radius:12px;max-width: 400px;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);">
        <img src="{{ asset('images/home-restaurantLogo.png') }}"
          class="d-flex justify-content-center align-items-center" alt="...">
        <span style="padding: 1rem;font-size: 22px;font-weight:700;">
          Restaurant
        </span>
        </div>
      </a>
      @elseif(auth()->user()->role == "compost_producer")
      <div class = "col-4" style = "height: 100%;">
        <a href="/compost-producer" style="text-decoration: none;">
          <div class="card d-flex justify-content-center align-items-center"
          style="height: 100%;color:white;background-color:#43553D;border-radius:12px;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);">
          <img src="{{ asset('images/home-compostLogo.png') }}" class="d-flex justify-content-center align-items-center"
            alt="...">
          <span style="padding: 1rem;font-size: 22px;font-weight:700;text-align: center;">
            Compost Producer
          </span>
          </div>
        </a>
      </div>
      <div class="col-8" style="padding: 0 1rem; height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <span style="font-size: 22px; font-weight: 600; display: block;">Welcome, </span>
          <span style="font-size: 24px; font-weight: 600; display: block;">{{ auth()->user()->name }}</span>
          <span style="font-size: 18px; color: rgba(60, 60, 60, 0.81); display: block;">{{ auth()->user()->email }}</span>
        </div>
        <div class="row" style="position: relative;box-shadow: 5px 7px 8px 0px rgba(163, 163, 163, 0.17); padding: 3rem 1rem ;border: 2px solid #b8b8b8;border-radius: 12px;margin-left: 1px;">
          <span style = "position: absolute;top: 5%;font-size: 24px;font-weight: 600;">Quick Action</span>
          <div class="col" style = "border: 2px solid #b8b8b8;padding: 1rem;border-radius: 12px;margin: 20px;" id = "box-quick">
            <a href = "/account" style = "text-decoration:none;color: black;">
            <div class = "d-flex flex-column justify-content-center align-items-center">
                <img  src = "{{ asset('images/account-quick.png') }}" style = "height: 100px;margin: 1rem;">
                <span>account</span>
            </div>
            </a>
          </div>
          <div class="col" style="padding: 1rem;border: 2px solid #b8b8b8;border-radius: 12px;margin: 20px;" id = "box-quick">
            <a href = "/compost-producer/composts" style = "text-decoration:none;color: black;">
            <div class = "d-flex flex-column justify-content-center align-items-center">
              <img  src = "{{ asset('images/catalog-quick.png') }}" style = "height: 100px;margin: 1rem;">
              <span>My Catalog</span>
            </div>
            </a>
          </div>
          <div class="col" style="padding: 1rem;border: 2px solid #b8b8b8;border-radius: 12px;margin: 20px;" id = "box-quick">
          <a href = "/compost-producer" style = "text-decoration:none;color: black;">
          <div class = "d-flex flex-column justify-content-center align-items-center">
              <img  src = "{{ asset('images/portal-quick.png') }}" style = "height: 100px;margin: 1rem;">
              <span>Portal</span>
            </div>
          </div>
          </a>
        </div>
      </div>
      @elseif(auth()->user()->role == "farmer")
      <a href="/farmer" style="text-decoration: none;">
        <div class="card d-flex justify-content-center align-items-center"
        style="width: 25vw;height: 30rem;color:white;background-color:#43553D;border-radius:12px;max-width: 400px;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);">
        <img src="{{ asset('images/home-farmLogo.png') }}" class="d-flex justify-content-center align-items-center"
          alt="...">
        <span style="padding: 1rem;font-size: 22px;font-weight:700;">
          Farmer
        </span>
        </div>
      </a>
      @endif
    </div>
  @endif
  <div style = "padding: 1rem;">
      <img src = {{ asset('images/dino.png') }} style = "width: 20px;position: absolute;right: 2%;">
    </div>
  </div>
  <style>
  #box-quick {
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
  }#box-quick:hover {
    background-color:rgba(216, 216, 216, 0.16);
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
  }
  </style>
</x-layout>