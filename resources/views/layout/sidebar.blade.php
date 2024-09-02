<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="{{asset('vendor/src/assets/images/faces/face1.jpg')}}" alt="profile" />
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{Auth::user()->name}}</span>
            <span class="text-secondary text-small">
              @if(Auth::user()->role == 1)
                Admin
              @elseif(Auth::user()->role == 2)
                Pegawai
              @else
                Unknown
              @endif
          </span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
        <hr>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
        <hr>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.form')}}">
          <span class="menu-title">Form</span>
          <i class="mdi mdi-form-select menu-icon"></i>
        </a>
        <hr>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.user')}}">
          <span class="menu-title">User</span>
          <i class="mdi mdi-account menu-icon"></i>
        </a>
        <hr>
      </li>
      @php
        use App\Models\FormsModel;
        use App\Models\KateFormsModel;
        $kategori = KateFormsModel::all();
        // $data = FormsModel::where('active', 1)->get();

      @endphp
      @foreach ($kategori as $kategori)
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#{{$kategori->kategori}}" aria-expanded="false" aria-controls="{{$kategori->kategori}}">
          <span class="menu-title">{{$kategori->kategori}}</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-{{$kategori->kategori}} menu-icon"></i>
        </a>
        <div class="collapse" id="{{$kategori->kategori}}">
          <ul class="nav flex-column sub-menu">
            @php
              $data = FormsModel::where('kategori', $kategori->id)->
              where('active',1)->get();
            @endphp
            @foreach ($data as $forms)
              
            <li class="nav-item">
              <a class="nav-link" href="/admin/form/{{$forms->id}}">{{$forms->nama}}</a>
            </li>
            @endforeach

            
          </ul>
        </div>
      </li>
      @endforeach

      
    </ul>
  </nav>