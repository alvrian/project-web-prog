<x-layout>
  <x-navbar/>
  <div style = "background-color: #43553D;width: 100vw;min-height:93vh;position:relative;overflow:hidden;font-family:&quot;Inter&quot;, serif;">
    <div style = "background-color: white;width: 90vw;height:90vh;position:absolute;right:0;bottom:0;border-radius: 12px 0 0 0;">
        <div class =  "d-flex flex-row justify-content-between" style = "height: 100%;width: 90vw;">
            <div style = "width: 40%;padding:2rem;position: relative;">
                <a href = "/account" style = "text-decoration: none;color: black;">< back</a>
                <span style = "position: absolute;top:47%;font-size: 24px;font-weight: 600;color:#43553D;left: 15%;">Your Points</span>
                <span style = "position: absolute;top:52%;font-size: 24px;font-weight: 400;left: 15%;">Rp. {{$total}}</span>
            </div><br>
            <div  style = "width: 100%;padding:2rem;background-color: #F5F5F5;">
                <span style = "font-size: 22px;font-weight: 600;display:block">Transactions</span><br>
                <span style = "font-size: 18px;font-weight: 600;">Pending Transactions</span>
                <div style = "background-color: white;width: 100%;height: 20%;overflow-x: hidden;overflow-y: auto;border-radius: 12px;padding: 0 1rem;margin-top:10px;">
                  <ul class="list-group list-group-flush" style="height: 100%; list-style: none;">
                  @if($pending->isEmpty())
                    <p>No Completed transactions found.</p>
                  @else
                    <ul class="list-group list-group-flush" style="height: 100%; list-style: none;">
                      @foreach($pending as $transaction)
                          <li class="list-group-item" style = "height: 6vh;">
                            @if($transaction->TransactionType == "Earned")
                            <div class="row text-left">
                                <div class="col-3">+ {{ $transaction->Points }}</div>
                                <div class="col-3" style = "color: #7B986A;font-weight: 500;">Earned</div>
                                <div class="col-3">{{$transaction->Date}}</div>
                                <div class="col-3">{{$transaction->Status}}</div>
                              </div>
                            @elseif($transaction->TransactionType == "Redeemed")
                            <div class="row text-left">
                              <div class="col-3">+ {{ $transaction->Points }}</div>
                              <div class="col-3" style = "color: #BC0000;font-weight: 500;">Redeemed</div>
                              <div class="col-3">{{$transaction->Date}}</div>
                              <div class="col-3">{{$transaction->Status}}</div>
                            </div>
                            @endif
                          </li>
                      @endforeach
                    </ul>
                  @endif
                  </ul>
                </div><br>
                <span style = "font-size: 18px;font-weight: 600;">Completed Transactions</span>
                <div style = "background-color: white;width: 100%;height: 60%;overflow-x: hidden;overflow-y: auto;border-radius: 12px;padding: 0 1rem;margin-top: 10px;">
                  @if($pending->isEmpty())
                    <p>No Completed transactions found.</p>
                  @else
                  <ul class="list-group list-group-flush" style="height: 100%; list-style: none;">
                    @foreach($completed as $transaction)
                        <li class="list-group-item" style = "height: 6vh;">
                          @if($transaction->TransactionType == "Earned")
                            <div class="row text-left">
                              <div class="col-3">+ {{ $transaction->Points }}</div>
                              <div class="col-3" style = "color: #7B986A;font-weight: 500;">Earned</div>
                              <div class="col-3">{{$transaction->Date}}</div>
                              <div class="col-3">{{$transaction->Status}}</div>
                            </div>
                          @elseif($transaction->TransactionType == "Redeemed")
                              <div class="row text-left">
                                <div class="col-3">+ {{ $transaction->Points }}</div>
                                <div class="col-3" style = "color: #BC0000;font-weight: 500;">Redeemed</div>
                                <div class="col-3">{{$transaction->Date}}</div>
                                <div class="col-3">{{$transaction->Status}}</div>
                              </div>
                          @endif
                        </li>
                    @endforeach
                  </ul>
                  @endif
                </div>
            </div>
        </div>
    </div>
  </div>
</x-layout>