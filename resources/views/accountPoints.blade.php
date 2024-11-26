<x-layout>
  <x-navbar/>
  <div style = "background-color: #43553D;width: 100vw;min-height:93vh;position:relative;overflow:hidden;font-family:&quot;Inter&quot;, serif;">
    <div style = "background-color: white;width: 90vw;height:90vh;position:absolute;right:0;bottom:0;border-radius: 12px 0 0 0;">
        <div class =  "d-flex flex-row justify-content-between" style = "height: 100%;width: 90vw;">
            <div style = "width: 40%;padding:2rem;position: relative;">
                <span style = "position: absolute;top:47%;font-size: 24px;font-weight: 600;color:#43553D;left: 15%;">Your Points</span>
                <span style = "position: absolute;top:52%;font-size: 24px;font-weight: 400;left: 15%;">Rp. 8.888.888,00</span>
            </div><br>
            <div  style = "width: 100%;padding:2rem;background-color: #F5F5F5;">
                <span style = "font-size: 22px;font-weight: 600;">Transaction</span>
                <div style = "background-color: red;width: 100%;height: 100%;overflow-x: hidden;overflow-y: auto;border-radius: 12px;margin-top: 1rem;">
                  <ul class="list-group list-group-flush" style="height: 100%; list-style: none;">
                    @for ($i = 1; $i <= 20; $i++)
                      <li class="list-group-item">Item {{ $i }}</li>
                    @endfor
                  </ul>
                </div>
            </div>
        </div>
    </div>
  </div>
</x-layout>