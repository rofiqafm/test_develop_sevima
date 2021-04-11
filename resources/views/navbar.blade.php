<div class="container-fluid p-0">
   <nav class="navbar navbar-expand navbar-light bg-light">
      <div class="container">
         <a class="navbar-brand col-sm-4" href="{{ route('home') }}">AppInsta</a>
         <ul class="navbar-nav ml-auto">

            <!-- Pengguna -->
            <li class="nav-item dropdown" >

               <a class="nav-link" data-toggle="dropdown" href="#" >
                  @if (\Auth::user()->avatar == 'NO IMAGE')
                     <img class="img-circle" src="{{ asset('img/avatar.png') }}" width="30px" height="30px" alt="User Avatar">
                     
                  @else
                     <img class="img-circle" src="{{ asset('storage/' . \Auth::user()->avatar) }}" width="30px" height="30px" alt="User Avatar">                  
                  @endif
               </a>
               <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <div class="card card-widget widget-user" style="margin-bottom: 0px">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-info">
                     <h5>{{ \Auth::user()->username }}</h5>
                  </div>
                  <div class="widget-user-image">
                     @if (\Auth::user()->avatar == 'NO IMAGE')
                        <img class="img-circle" src="{{ asset('img/avatar.png') }}" width="70px" height="70px" alt="User Avatar">
                        
                     @else
                        <img class="img-circle elevation-2" src="{{ asset('storage/' . \Auth::user()->avatar) }}" style="height: 100px; width: 100px" alt="User Avatar">
                        
                     @endif
                   </div>
                  <div class="card-footer">
                     <div class="row">
                        <div class="col-md-12 mt-2">
                           
                           <a href="#" class="btn btn-sm btn-default btn-block border-0 text-left">Profile</a>
                           <hr>
                           <form action="{{ route('logout') }}" method="post">
                              @csrf
                              <input type="submit" class="btn btn-sm btn-default btn-block border-0 text-left" value="Logout">
                           </form>
                        </div>
                        
                     </div>
                        <!-- /.col -->
                        
                  </div>
                     <!-- /.row -->
                  </div>
               </div>
            </li>
         </ul>
      </div>
   </nav>
</div>