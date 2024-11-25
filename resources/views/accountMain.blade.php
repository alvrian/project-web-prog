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
                <span style="display: flex; align-items: center; gap: 5px;font-size:18px;color:black;">
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
                <li class="list-group-item" style = "border:none;"></li>
              @endfor
            </div>
          </div>
            <div id = "box-bottom-right">
              <span style = "margin-left: 0.5rem;font-size:18px;font-weight:500;margin-bottom:1rem;">
                Summary
              </span>
              <div style = "background-color:white;width:27vw;height:80vh;margin-left:0.5rem;margin-top:0.5rem;padding:2rem" class = "dropend">
                <span style = "font-weight:500;font-size:18px;">Progress Bar</span>
                <div class="progress-stacked" style = "margin-top:2rem;margin-bottom: 2rem;">
                  <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                    <div class="progress-bar bg-success"></div>
                  </div>
                  <div class="progress" role="progressbar" aria-label="Segment two" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                    <div class="progress-bar bg-warning"></div>
                  </div>
                  <div class="progress" role="progressbar" aria-label="Segment three" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                    <div class="progress-bar bg-danger"></div>
                  </div>
                </div>
                <div class = "d-flex flex-column justify-content-center gap-1" style = "margin-bottom:2rem" >
                  <span style = "font-weight:500;font-size:16px;">Total Transaction: <span>10</span></span>
                  <span style = "width: 100%;display:block;color:green;font-weight:900;font-size: 18px;">&centerdot;<span style = "color:black;font-weight:400;font-size:16px;">&emsp;Done&emsp;&emsp;&emsp;&emsp;&ensp;</span><span style = "color:black;font-weight:400;font-size:16px;">3/10</span></span>
                  <span style = "width: 100%;display:block;color:yellow;font-weight:900;font-size: 18px;">&centerdot;<span style = "color:black;font-weight:400;font-size:16px;">&emsp;In Progress&emsp;&emsp;</span><span style = "color:black;font-weight:400;font-size:16px;">4/10</span></span>
                  <span style = "width: 100%;display:block;color:red;font-weight:900;font-size: 18px;">&centerdot;<span style = "color:black;font-weight:400;font-size:16px;">&emsp;Cancelled&emsp;&emsp;&ensp;&nbsp;</span><span style = "color:black;font-weight:400;font-size:16px;">4/10</span></span>
                </div>
                <p class="d-inline-flex gap-1">
                  <a  href = "/account/point">
                  <button class="btn btn-light dropdown-toggle" type="button">
                    View Point Details
                  </button>
                  </a>
                </p>
      </div></div></div></div></div>
    <div style="position: absolute;left:4%;top:15%">
      <img src="{{ asset('images/account-picture-placeholder.png') }}" 
        style="border-radius:10px;width: 15vw;min-width:100px;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);" 
      />
    </div>
  </div>
</x-layout>