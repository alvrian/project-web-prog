<div>
  <nav 
    class="navbar navbar-expand-lg" 
    style="height: 7vh; background-color: 
      @auth
        {{
          auth()->user()->role == 'restaurant_owner' ? '#ffcc00' :
          (auth()->user()->role == 'farmer' ? '#98FB98' :
          (auth()->user()->role == 'compost_producer' ? '#D3D3D3' : '#ADD8E6'))
        }}
      @else
        '#f8f9fa' <!-- Default color for guests -->
      @endauth;">
    <div class="container-fluid d-flex justify-content-between align-items-center">

      <div class="d-flex align-items-center">
        <a class="navbar-brand" href="/" style="font-weight: bold; font-size: 24px; margin-right: 10px;">
          FarmByte
        </a>
        @auth
          <span class="text-muted" style="font-size: 14px; font-weight: 600;">
            {{ match(auth()->user()->role) {
                'restaurant_owner' => 'Restaurant Owner Portal',
                'farmer' => 'Farmer Portal',
                'compost_producer' => 'Compost Producer Portal',
                default => '',
            } }}
          </span>
        @endauth
      </div>

      <div class="d-flex align-items-center">
        @auth
          <span class="navbar-text text-muted me-3" style="font-size: 14px;">
            Welcome, <strong>{{ auth()->user()->name }}</strong>!
          </span>
        @else
          <span class="navbar-text text-muted me-3" style="font-size: 14px;">
            Welcome, Guest!
          </span>
        @endauth
        <a href="/account">
          <img 
            src="{{ asset('images/accountLogo.png') }}" 
            alt="Account Logo" 
            style="max-width: 20px;" 
          />
        </a>
      </div>
    </div>
  </nav>  
</div>
