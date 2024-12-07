<x-layout>
  <x-navbar/>
  @if($is_null)
    <div class = "d-flex justify-content-center align-items-center" style = "background-color: #43553D;height:93vh;font-family:&quot;Inter&quot;, serif;">
      <div style = "background-color: white; min-height: 35vh;min-width: 30vw;border-radius: 12px;padding:1rem;">
        <h5 style = "display:block;text-align:center;font-weight: bold;">Complete Your Personal Information</h5><br>
        <form method = "POST" action = "{{ route('complete') }}">
          @csrf
          @if(auth()->user()->role == "farmer")
            <div class="mb-3" style = "font-size: 14px;">
              <label for="userLocation" class="form-label">Location</label>
              <input type="text" class="form-control" id="userLocation" name="location" aria-describedby="locationHelp" required placeholder = "Enter name of City">
              <br>
              <label for="CropTypesProduced" class="form-label">Crop Types Produced</label>
              <input type="text" class="form-control" id="CropTypesProduced" name="CropTypesProduced" required>
              <br>
              <div class="mb-3">
                <label for="DayOfWeek" class="form-label">Select Day of the Week</label>
                <select class="form-select" id="DayOfWeek" name="DayOfWeek" required>
                  <option value="" disabled selected>Select a day</option>
                  <option value="Monday">Monday</option>
                  <option value="Tuesday">Tuesday</option>
                  <option value="Wednesday">Wednesday</option>
                  <option value="Thursday">Thursday</option>
                  <option value="Friday">Friday</option>
                  <option value="Saturday">Saturday</option>
                  <option value="Sunday">Sunday</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="AverageCropAmount" class="form-label">Average Crop Amount</label>
                <input type="number" step="0.01" class="form-control" id="AverageCropAmount" name="AverageCropAmount" required placeholder="Enter average crop amount">
              </div>
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn" style = "width: 35%;background-color: black;color:white;border-radius: 8px;">Submit</button>
              </div>
            </div>
          @elseif(auth()->user()->role == "compost_producer")
            <div class="mb-3" style = "font-size: 14px;">
                <label for="userLocation" class="form-label">Location</label>
                <input type="text" class="form-control" id="userLocation" name="location" aria-describedby="locationHelp" required placeholder = "Enter name of City">
                <br>
                <label for="CompostTypesProduced" class="form-label">Crop Types Produced</label>
                <input type="text" class="form-control" id="CompostTypesProduced" name="CompostTypesProduced" required>
                <br>
                <div class="mb-3">
                  <label for="Average" class="form-label">Average Compost Amount per Term</label>
                  <input type="number" step="0.01" class="form-control" id="Average" name="Average" required placeholder="Enter average crop amount">
                </div>
                <div class="mb-3">
                  <label for="capacity" class="form-label">Waste Processing Capacity</label>
                  <input type="number" step="0.01" class="form-control" id="capacity" name="capacity" required placeholder="Enter average crop amount">
                </div>
                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn" style = "width: 35%;background-color: black;color:white;border-radius: 8px;">Submit</button>
                </div>
              </div>
          @elseif(auth()->user()->role == "restaurant_owner")
            <div class="mb-3" style = "font-size: 14px;">
                <label for="userLocation" class="form-label">Location</label>
                <input type="text" class="form-control" id="userLocation" name="location" aria-describedby="locationHelp" required placeholder = "Enter name of City">
                <br>
                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn" style = "width: 35%;background-color: black;color:white;border-radius: 8px;">Submit</button>
                </div>
            </div>
          @endif  
        </form>
      </div>
    </div>
    <div style = "position: absolute;bottom:0%;right:0;">
        @auth
        <form method="POST" action="{{ route('logout') }}" class="inline-block" style = "padding: 1rem;">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
        @endauth
      </div>
  @else
  <div style = "background-color: #43553D;width: 100vw;min-height:93vh;position:relative;overflow:hidden;font-family:&quot;Inter&quot;, serif;">
    <div style = "background-color: white;width: 90vw;height:90vh;position:absolute;right:0;bottom:0;border-radius: 12px 0 0 0;padding:1rem">
      <div style = "height:82vh;width:78vw;position:absolute;bottom:0;right:0;">
        <div class = "d-flex flex-column" id = "box-top">
          <span style = "font-size: 36px;font-weight:700;">
            {{ auth()->user()->name}}
          </span>
          <div class = "d-flex flex-row ">
            <div>
              <span style = "font-size:18px;font-weight:500">
                {{auth()->user()->role}}
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
                    Rp. {{$total}}
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
                <ul class="list-group list-group-flush" style="height: 100%; list-style: none;">
                  @if($data->isEmpty())
                    <p>No Completed transactions found.</p>
                  @else
                    <ul class="list-group list-group-flush" style="height: 100%; list-style: none;">
                      @foreach($data as $transaction)
                          <li class="list-group-item" style = "height: 6vh;">
                            <div class="row text-left">
                                @if($transaction->TransactionType == "Earned")
                                  <div class="col-3">+ {{ $transaction->Points }}</div>
                                  <div class="col-3" style = "color: #7B986A;font-weight: 500;">Point {{$transaction->TransactionType}}</div>
                                @elseif ($transaction->TransactionType == "Redeemed")
                                  <div class="col-3">- {{ $transaction->Points }}</div>
                                  <div class="col-3" style = "color: #BC0000;font-weight: 500;">Point {{$transaction->TransactionType}}</div>
                                @endif
                                <div class="col-3">{{$transaction->Date}}</div>
                                <div class="col-3">{{$transaction->Status}}</div>
                              </div>
                          </li>
                      @endforeach
                    </ul>
                  @endif
                  </ul>
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
                <div class="container" style="margin-bottom: 2rem;">
                  <div class="text-left mb-3">
                    <span class="fw-medium fs-5">Total Transaction: <span>10</span></span>
                  </div>
                  <div class="d-flex flex-column gap-2">
                    <div class="d-flex align-items-center">
                      <span class="fw-bold text-success fs-5">&centerdot;</span>
                      <span class="text-black fw-normal fs-6 ms-1">Done</span>
                      <span class="text-black fw-normal fs-6 ms-auto">3/10</span>
                    </div>
                    <div class="d-flex align-items-center">
                      <span class="fw-bold text-warning fs-5">&centerdot;</span>
                      <span class="text-black fw-normal fs-6 ms-1">In Progress</span>
                      <span class="text-black fw-normal fs-6 ms-auto">4/10</span>
                    </div>
                    <div class="d-flex align-items-center">
                      <span class="fw-bold text-danger fs-5">&centerdot;</span>
                      <span class="text-black fw-normal fs-6 ms-1">Cancelled</span>
                      <span class="text-black fw-normal fs-6 ms-auto">4/10</span>
                    </div>
                  </div>
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
      <img src="{{ asset('images/account-picture-placeholder.png') }}" style="border-radius:10px;width: 15vw;min-width:100px;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.17);"/>
      <div class="ml-10 flex items-baseline space-x-4">
        @auth
        <form method="POST" action="{{ route('logout') }}" class="d-flex justify-content-end">
          @csrf
          <button type="submit" class="btn btn-danger mt-2">Logout</button>
        </form>
        @endauth
      </div>
    </div>
  </div>
  @endif

  <style>
    ::-webkit-scrollbar {
      width: 8px;
    }
    ::-webkit-scrollbar-thumb {
      background-color: #888;
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background-color: #555;
    }
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
  </style>
</x-layout>