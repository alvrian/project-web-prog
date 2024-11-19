<x-layout>
  <x-navbar/>
  <div style = "background-color: #43553D;width: 100vw;min-height:93vh;position:relative;overflow:hidden;">
    <div style = "background-color: white;width: 90vw;height:90vh;position:absolute;right:0;bottom:0;border-radius: 12px 0 0 0;padding:1rem">
      <div style = "height:82vh;width:78vw;position:absolute;bottom:0;right:0;">
        <div class = "d-flex flex-column" id = "box-top">
          <span style = "font-size: 36px;font-weight:700;">
            PT. Cahaya Wijaya
          </span>
          <div class = "d-flex flex-row ">
            <div>
              <span style = "font-size:18px;font-weight:500">
                Compost Producer
              </span>
              <span style="display: flex;align-items: center; gap: 5px;font-size:18px">
                <img src="{{ asset('images/star.png') }}" style="width: 18px; height: 18px;" alt="Star"/> 
                3/5
              </span>
            </div>
            <div style = "margin-left:20vw;font-weight:700">
            <span style = "font-size:18px;">
                  Your Points
              </span>
              <span style="display: flex; align-items: center; gap: 5px;font-size:18px;">
                  Rp. 1.000.000, 00
              </span>
            </div>
          </div>
        </div>
        <div 
          class = "d-flex justify-content-end"
          style = "background-color:#F5F5F5;width:78vw;height:80vh;margin-top:2rem;border-radius: 15px 0 0 0;padding-top:1rem;"
          id = "box-bottom">
          <div id="box-bottom-left">
            <span style="font-size: 18px; font-weight: 500;">
              Recent Activities
            </span>
            <div style="background-color: white; width: 48vw; height: 80vh; border-radius: 15px 0 0 0; margin-top: 0.5rem; padding: 0.25rem 1rem; overflow-y: auto;">
              <ul class="list-group list-group-flush" style="height: 60vh; list-style: none;">
              @for ($i = 1; $i <= 20; $i++)
                <li class="list-group-item">Item {{ $i }}</li>
              @endfor
              <!-- buat nge push yang bawah -->
              @for ($i = 1; $i <= 10; $i++)
                <li class="list-group-item"></li>
              @endfor
            </div>
          </div>
            <div id = "box-bottom-right">
              <span style = "margin-left: 0.5rem;font-size:18px;font-weight:500;margin-bottom:1rem;">
                Summary
              </span>
              <div style = "background-color:white;width:27vw;height:80vh;margin-left:0.5rem;margin-top:0.5rem;padding:1rem;">
                aaaaaaaaaaaa
              </div>
            </div>
        </div>
      </div>
    </div>
    <div style="position: absolute;left:4%;top:15%">
      <img src="{{ asset('images/account-picture-placeholder.png') }}" 
        style="border-radius:10px;width: 15vw;min-width:100px" 
      />
    </div>
  </div>
</x-layout>