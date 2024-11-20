
<div class="navbar">
    <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>
    <ul class="nav-links">
        <li >
            <a href="{{route('courrier.index')}}" @if(request()->is('courrier')) style="color:green" @endif>Historique</a>
        </li>
        <li >
            <a href="{{route('courrier.create')}}" @if(request()->is('courrier/create')) style="color:green" @endif>Ajouter un nouveau courrier</a>
        </li>
        <li >
            <a href="{{route('courrier.corbeille')}}" @if(request()->is('courrier/corbeille')) style="color:green" @endif><i class="fas fa-trash-alt"></i> Corbeille </a>
        </li>
        <li >
            @if (Auth::check())
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-button">
            <i class="fas fa-sign-out-alt"></i> <!-- Font Awesome sign-out icon -->
        </button>
    </form>
@endif
        </li>
    </ul>
    
</div>

<style>
  .navbar {
    display: flex;
    align-items: center; /* Vertical alignment */
    justify-content: space-between; /* Distribute items horizontally */
    padding: 10px 20px; /* Example padding */
    background-color: white; /* Example background color */
    color: purple; /* Example text color */
    
}

.logo-container {
    /* Adjust width as needed */
}

.logo {
    width: 220px; /* Adjust width of logo */
    height: auto; /* Maintain aspect ratio */
}

.nav-links {
    display: flex;
    list-style-type: none; /* Remove default list styles */
    padding: 0;
    margin: 0;
}

.nav-links li {
    margin-right: 20px; /* Example spacing between links */
}

.nav-links li a {
    color: purple; /* Example link text color */
    text-decoration: none;
    font-family: Arial, sans-serif;
    font-size: 16px ;
    width:120px;
    font-weight: inherit
}

.nav-links li a:hover {
    
    color:green; 
   /* Example hover effect */
}
.nav-links li button {
        text-decoration: none;
        color: purple;
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size:20px;
        width: 200px
    }


.nav-links li button:hover {
    color: green;
   /* Change text color to green on hover */
}
</style>