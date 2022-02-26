<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('getOrders') }}"> <img alt="image" src="{{URL::to('images/logo.png')}}" class="header-logo" /> <span
                class="logo-name">Poké Chef</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Food</li>
            <li class="dropdown">
              <a href="/admin/orders" class="nav-link"><i class="material-icons">restaurant_menu</i><span>Food Orders</span></a>
            </li>
            <li class="dropdown">
              <a href="/admin/newpost" class="nav-link"><i class="material-icons">add_circle</i><span>New Plate</span></a>
            </li>
           <li class="dropdown">
              <a href="/admin/postslist" class="nav-link"><i class="material-icons">list</i><span>Plates List</span></a>
            </li>
            <li class="dropdown">
              <a href="/admin/bowlview" class="nav-link"><i class="material-icons">view_week</i><span>Bowl Composé</span></a>
            </li>
           

            <li class="menu-header">Specials</li>
            <li class="dropdown">
              <a href="/admin/newspecial" class="nav-link"><i class="material-icons">add_circle</i><span>New Special</span></a>
            </li>
           <li class="dropdown">
              <a href="/admin/specialslist" class="nav-link"><i class="material-icons">list</i><span>Specials List</span></a>
            </li>

            <li class="menu-header">Drinks</li>
            <li class="dropdown">
              <a href="/admin/newdrink" class="nav-link"><i class="material-icons">add_circle</i><span>New Drink</span></a>
            </li>
           <li class="dropdown">
              <a href="/admin/drinkslist" class="nav-link"><i class="material-icons">list</i><span>Drink List</span></a>
            </li>

            <li class="menu-header">Legumes</li>
            <li class="dropdown">
              <a href="/admin/newlegume" class="nav-link"><i class="material-icons">add_circle</i><span>New Legume</span></a>
            </li>
           <li class="dropdown">
              <a href="/admin/legumeslist" class="nav-link"><i class="material-icons">list</i><span>Legume List</span></a>
            </li>

            <li class="menu-header">Desserts</li>
            <li class="dropdown">
              <a href="/admin/newdessert" class="nav-link"><i class="material-icons">add_circle</i><span>New Dessert</span></a>
            </li>
           <li class="dropdown">
              <a href="/admin/dessertslist" class="nav-link"><i class="material-icons">list</i><span>Dessert List</span></a>
            </li>

            <li class="menu-header">Live</li>

            <li><a class="nav-link" href="/admin/live"><i class="material-icons">live_tv</i><span>Live</span></a></li>
            

            <li class="menu-header">Management</li>
           
            <li><a class="nav-link" href="/admin/employeelist"><i class="material-icons">group</i><span>Employee List</span></a></li>
            <li><a class="nav-link" href="/admin/shifts"><i class="material-icons">date_range</i><span>Work Schedule</span></a></li>

            <li class="menu-header">Achive</li>
            <li><a class="nav-link" href="/admin/records"><i class="material-icons">archive</i><span>Archive</span></a></li>


            
          </ul>
        </aside>
      </div>